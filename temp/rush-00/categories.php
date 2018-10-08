<?php
	if ($_POST["cat"])
		switch ($_POST["action"])
		{
			case "add":
			{
				unset($cats[$_POST["og"]]);
				$cats[$_POST["cat"]] = $_POST["cat"];
			}
			break;
			case "del":
				unset($cats[$_POST["cat"]]);
			break;
			default:
				break;
		}
?>