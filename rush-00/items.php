<?php
	if ($_POST["name"])
		switch ($_POST["action"])
		{
			case "add":
				unset($items[$_POST["og"]]);
				$items[$_POST["name"]] = @array("price"=>$_POST["price"],
												"categories"=>preg_split("/[\t ]+/",trim($_POST["categories"])),
												"imgurl"=>$_POST["imgurl"],
												"stock"=>(int)$_POST["stock"]);
			break;
			case "del":
				unset($items[$_POST["name"]]);
			break;
			default:
				break;
		}
?>