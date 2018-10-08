<?php
	if ($_POST["login"] && $_POST["passwd"])
	{
		if (!$users[$_POST["login"]] && strtolower($_POST['rob']) == "no")
		{
			$users[$_POST["login"]] = hash("whirlpool", $_POST["passwd"]);
			$_SESSION["login"] = $_POST["login"];
			$_SESSION["state"] = "main";
		}
		else $errstr .= "Login Taken";
	}
	else
		$errstr .= "Both Fields are Required";
?>