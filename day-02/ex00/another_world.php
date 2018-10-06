#!/usr/bin/php
<?php
if ($argc > 1)
{
	foreach (preg_split('/[\t ]+/', trim($argv[1], '/[\t ]/')) as $elem)
		$nom[] = $elem;
	$bob = "";
	foreach ($nom as $elem)
		$bob = $bob.$elem." ";
	echo trim($bob, ' ')."\n";
}
?>