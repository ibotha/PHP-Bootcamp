<?php
	$errstr = "";
	session_start();
	$users = unserialize(file_get_contents("./store/users.txt"));
	$items = unserialize(file_get_contents("./store/items.txt"));
	$cats = unserialize(file_get_contents("./store/cats.txt"));
	if ($_POST["logout"])
		unset($_SESSION["login"]);
	if ($_GET["state"])
		$_SESSION["state"] = $_GET["state"];
	if ($_POST["state"])
		$_SESSION["state"] = $_POST["state"];
	if ($_GET["menu"])
	$_SESSION["menu"] = $_GET["menu"];
	if ($_POST["action"] == "addtocart" && $_POST["quantity"] > 0 && $_POST["quantity"] <= $items[$_POST["item"]]["stock"])
	{
		if ($_SESSION["cart"][$_POST["item"]])
		{
			$_SESSION["cart"][$_POST["item"]]["stock"] += $_POST["quantity"];
			$_SESSION["no_items"] += $_POST["quantity"];
		}
		else
		{
			$_SESSION["cart"][$_POST["item"]] = $items[$_POST["item"]];
			$_SESSION["cart"][$_POST["item"]]["stock"] = $_POST["quantity"];
			$_SESSION["no_items"] += $_POST["quantity"];
		}
	}
	if ($_POST["action"] == "remove" && $_POST["quantity"] <= $_SESSION["cart"][$_POST["item"]]["stock"] && $_POST["quantity"] > 0)
	{
		$_SESSION["cart"][$_POST["item"]]["stock"] -= $_POST["quantity"];
		if (!$_SESSION["cart"][$_POST["item"]]["stock"])
			unset($_SESSION["cart"][$_POST["item"]]);
		$_SESSION["no_items"] -= $_POST["quantity"];
	}
	if ($_POST["action"] == "checkout")
	{
		$enough = true;
		if (!$_SESSION["login"])
		{
			$errstr .= "Not Logged In<br>";
			$enough = false;
		}
		foreach ($_SESSION["cart"] as $name=>$value)
		{
			if ($value["stock"] > $items[$name]["stock"])
			{
				$enough = false;
				$errstr .= $name.": Not Enough Stock<br>";
			}
		}
		if ($enough)
		{
			foreach ($_SESSION["cart"] as $name=>$value)
			{
				$items[$name]["stock"] -= $value["stock"];
				unset($_SESSION["cart"][$name]);
			}
			$_SESSION["no_items"] = 0;
		}
	}
	switch ($_SESSION["state"])
	{
		case "users":
			include "users.php";
			break;
		case "categories":
			include "categories.php";
			break;
		case "items":
			include "items.php";
			break;
		case "login":
			include "login.php";
			break;
		case "signup":
			include "signup.php";
			break;
		case "search":
			include "search.php";
			break;
		case "cart":
			include "cart.php";
			break;
		default:
			break;
	}
	file_put_contents("./store/users.txt", serialize($users));
	file_put_contents("./store/items.txt", serialize($items));
	file_put_contents("./store/cats.txt", serialize($cats));
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./index.css">
		<title>Takealittle</title>
		<link rel="shortcut icon" href="https://banner2.kisspng.com/20180417/yjq/kisspng-logo-royalty-free-falcon-5ad685e92ca4c4.9973054715240084251829.jpg">
	</head>

	<body>
	<div id="Top">
		<a href="./index.php?menu=<?php if ($_SESSION["menu"] == "show") echo 'hide'; else echo 'show' ?>"><form id="Menu">
		<div class="Bar" style="background-color: transparent;"></div>
		<div class="Bar"></div>
		<div class="Bar"></div>
		<div class="Bar"></div>
		<div class="Bar" style="background-color: transparent;"></div>
		</form></a>
		<div id="HeaderBar">
			<form method="get" action="#" id="searchform">
				<input id="SearchArea" name="search">
				<button type="submit" name="state" value="search">Search</button>
			</form>
			<div id="Cartdiv">
				<a href="?state=cart"><img id="logo" style="border: 0px; margin-right: 5px;" src="https://png2.kisspng.com/20180329/jkq/kisspng-shopping-cart-computer-icons-online-shopping-shopping-cart-5abcc5a31c30c9.3661078115223208031155.png"></a>
				<div id="readout">
				<?php echo (int)$_SESSION["no_items"]; ?>
				</div>
			</div>
			<div id="user_buttons">
				<?php
					if (!$_SESSION["login"])
						echo '<form method="get" action="./index.php">
							<button class="readoutelem" type="submit" name="state" value="signup">Sign up</button>
						</form>
						<form method="get" action="./index.php">
							<button class="readoutelem" type="submit" name="state" value="login">Log in</button>
						</form>';
					else
						echo '<form method="post" action="./index.php">
							<button class="readoutelem" type="submit" name="logout" value="OK">Log out</button>
						</form>'.$_SESSION["login"];
				?>
			</div>
			<span id="Name">Takealittle</span>
			<img src="https://banner2.kisspng.com/20180417/yjq/kisspng-logo-royalty-free-falcon-5ad685e92ca4c4.9973054715240084251829.jpg" id="Logo">
		</div>
	</div>
	<form method="get" action="#" id="SideBar" style="display: <?php if ($_SESSION["menu"] == "show") echo 'flex'; else echo 'none' ?>">
		<button type="submit" class="SideBarItem" name="state" value="main">Home</button>
		<button type="submit" class="SideBarItem" name="state" value="search">Browse</button>
		<button type="submit" class="SideBarItem" name="state" value="admin">Admin</button>
	</form>
	<div id="Feed">
		<?php
			switch ($_SESSION["state"])
			{
				case "admin":
					if (strtolower($_SESSION["login"]) == "admin")
					include "admin.html";
					break;
				case "users":
					include "users.html";
					break;
				case "categories":
					include "categories.html";
					break;
				case "items":
					include "itemsbody.php";
					break;
				case "login":
					include "login.html";
					break;
				case "signup":
					include "signup.html";
					break;
				case "cart":
					include "cartbody.php";
					break;
				default:
					include "landing.html";
					break;
				case "search":
					include "searchbody.php";
					break;
			}
		?>
	</div>
	</body>
</html>