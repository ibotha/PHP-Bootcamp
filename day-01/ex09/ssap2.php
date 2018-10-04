#!/usr/bin/php
<?php

function get_num($elem)
{
	$num = ord($elem);
	if (ctype_digit($elem))
		$num += 255;
	elseif (!ctype_alpha($elem))
		$num += 511;
	return $num;
}

function compare($elem1, $elem2)
{
	$elem1 = strtolower($elem1);
	$elem2 = strtolower($elem2);
	$i = 0;
	while (1)
	{
		if ($elem1[$i] != $elem2[$i])
			return (get_num($elem1[$i]) - get_num($elem2[$i]));
		if (!$elem1[$i] && !$elem2[$i])
			return 0;
		
		$i++;
	}
}

if ($argc > 1)
{
	unset($argv[0]);
	foreach ($argv as $av)
		if (trim($av))
			foreach (preg_split('/ +/', trim($av, ' ')) as $elem)
				$nom[] = $elem;
	usort($nom, "compare");
	foreach ($nom as $elem)
		echo $elem."\n";
}
?>