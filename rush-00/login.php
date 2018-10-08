<?php
	if ($_POST["login"] && $_POST["passwd"])
	{
		if ($users[$_POST["login"]] && strtolower($_POST['rob']) == "no")
		{
			if ($users[$_POST["login"]] == hash("Whirlpool", $_POST["passwd"]))
				$_SESSION["login"] = $_POST["login"];
			$_SESSION["state"] = "main";
		}
		else
			$errstr .= "User Does Not Exist";
	}
	else
		$errstr .= "Both Fields are Required";
?>