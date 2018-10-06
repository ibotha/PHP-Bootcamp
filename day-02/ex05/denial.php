#!/usr/bin/php
<?php
function is_valid($str, $lst)
{
	$i = 0;
	foreach ($lst as $value)
	{
		if ($value == $str)
			return ($i);
		$i++;
	}
	return -1;
}


if ($argc > 2)
{
	if (($file = @fopen($argv[1], "r")))
	{
		$top = fgetcsv($file, 0, ";");
		if (($i = is_valid($argv[2], $top)) != -1)
		{
			while ($in = fgetcsv($file, 0, ";"))
			{
				$temp = $top[0];
				($$temp)[$in[$i]] = $in[0];
				$temp = $top[1];
				($$temp)[$in[$i]] = $in[1];
				$temp = $top[2];
				($$temp)[$in[$i]] = $in[2];
				$temp = $top[3];
				($$temp)[$in[$i]] = $in[3];
				$temp = $top[4];
				($$temp)[$in[$i]] = $in[4];
			}
			fclose($file);
			$stdin = fopen("php://stdin", "r");
			while (1)
			{
				echo "Enter your command: ";
				$input = fgets($stdin);
				$input = substr($input, 0, -1);
				if (!$input)
				{
					echo "\n";
					break;
				}
				$input = trim($input, ";").";";
				try
				{
					eval($input);
				}
				catch (ParseError $t)
				{
					echo "Parse error: ", $t->getMessage(), " in ",$t->getFile(), " on line ",  $t->getLine(), PHP_EOL;
				}
			}
		}
	}
}
?>