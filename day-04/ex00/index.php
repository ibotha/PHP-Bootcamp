<?php

session_start();
if ($_GET['submit'] == "OK")
{
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}

?>

<!DOCTYPE html>
<html>
<body>
	<form method="get" action="./index.php">
		Username: <input name="login" value="<?php echo $_SESSION['login'] ?>">
		<br />
		Password: <input name="passwd" type="password" value="<?php echo $_SESSION['passwd'] ?>">
		<button type="Submit" name="submit" value="OK">Submit</button>
	</form>
</body>
</html>
sdkjvbsdbvosdovbousdvsdc.com?login=aisbf&passwd=sidbg&submit=OK