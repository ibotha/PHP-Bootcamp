<?php
	if ($_GET["search"])
		foreach ($items as $key=>$value)
		{
			if (strstr(strtolower($key), strtolower($_GET["search"])))
				$found[$key] = $value;
		}
	elseif ($_GET["category"])
	{
		foreach ($items as $key=>$value)
		{
			foreach ($value["categories"] as $category)
				if (strstr(strtolower(trim($category)), strtolower(trim($_GET["category"]))))
					$found[$key] = $value;
		}
	}
	else
		$found = $items;
	ksort($found);
?>