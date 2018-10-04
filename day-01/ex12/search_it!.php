#!/usr/bin/php
<?php

$search = $argv[1];
unset($argv[1]);
unset($argv[0]);
$nom = [];
foreach ($argv as $av)
{
	$temp = explode(":", $av);
	$nom[$temp[0]] = $temp[1];
}

$ans = $nom[$search];

if ($ans)
	echo "$ans\n";

?>