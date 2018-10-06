#!/usr/bin/php
<?php

$months = ["janvier"=>1,
			"février"=>2,
			"mars"=>3,
			"avril"=>4,
			"mai"=>5,
			"juin"=>6,
			"juillet"=>7,
			"aout"=>8,
			"septembre"=>9,
			"octobre"=>10,
			"novembre"=>11,
			"décembre"=>12];

date_default_timezone_set("Europe/Paris");

if ($argc > 1)
{
	if (preg_match("/\w+ [0-9]{1,2} \w+ [0-9]{1,4} [0-9]{2}:[0-9]{2}:[0-9]{2}/", $argv[1]))
	{
		foreach (preg_split('/\s/', $argv[1]) as $elem)
			$nom[] = $elem;
		$hms = explode(":", $nom[4]);
		$time = mktime($hms[0], $hms[1], $hms[2], $months[lcfirst($nom[2])], $nom[1], $nom[3]);
		echo "$time\n";
	}
	else
		echo "Wrong Format\n";
}
?>