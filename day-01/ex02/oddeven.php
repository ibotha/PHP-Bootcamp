#!/usr/bin/php
<?php

while (1)
{
	$stdin = fopen("php://stdin", "r");
	echo "Enter a number: ";
	$input = fgets($stdin);
	if (!$input)
	{
		echo "\n";
		break;
	}
	$input = substr($input, 0, -1);
	if (is_numeric($input))
	{
		echo "The number";
		echo " $input ";
		if ($input % 2)
			echo "is odd\n";
		else
			echo "is even\n";
	}
	else
		echo "'$input' is not a number\n";
}

?>