#!/usr/bin/php
<?php
if ($argc > 1)
{
	unset($argv[0]);
	foreach ($argv as $av)
		foreach (preg_split('/ +/', trim($av, ' ')) as $elem)
			$nom[] = $elem;
	sort($nom);
	foreach ($nom as $elem)
		echo $elem."\n";
}
?>