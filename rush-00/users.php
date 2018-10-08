<?php
	if ($_POST["login"])
		switch ($_POST["action"])
		{
			case "add":
				unset($users[$_POST["og"]]);
				$users[$_POST["login"]] = hash("Whirlpool", $_POST["passwd"]);
			break;
			case "del":
				unset($users[$_POST["login"]]);
			break;
			default:
				break;
		}
?>