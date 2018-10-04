#!/usr/bin/php
<?php

if ($argc > 1)
{
	$in = fopen("php://stdin", "r");

	while ($input = fgetcsv($in, 0, ";"))
	{
		if (!$fin[$input[0]])
			$fin[$input[0]] = [0, 0, 0];
		if ($input[2] != "moulinette")
		{
			if (is_numeric($input[1]))
			{
				$fin[$input[0]][0] += $input[1];
				$fin[$input[0]][1]++;
			}
		}
		else
			$fin[$input[0]][2] = (int)$input[1];
	}


	foreach ($fin as $key=>$elem)
		if (!$elem[0])
			unset($fin[$key]);

	unset($fin["User"]);
	ksort($fin);

	if ($argv[1] == "moyenne_user" || $argv[1] == "average_user")
		foreach ($fin as $key=>$elem)
			echo "$key: ".$elem[0] / $elem[1]."\n";
	
	if ($argv[1] == "moyenne" || $argv[1] == "average")
	{
		$total = 0;
		$amount =0;
		foreach ($fin as $elem)
		{
			$total += $elem[0];
			$amount += $elem[1];
		}
		echo $total / $amount."\n";
	}

	if ($argv[1] == "escart_moulinette" || $argv[1] == "moulinette_variance")
		foreach ($fin as $key=>$elem)
			echo "$key: ".(($elem[0] / $elem[1]) - $elem[2])."\n";
}
?>