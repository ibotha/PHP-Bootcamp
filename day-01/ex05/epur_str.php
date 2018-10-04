#!/usr/bin/php
<?php

$og = preg_split('/ +/', $argv[1]);
$nom = [];
foreach ($og as $elem)
{
	if ($elem)
		array_push($nom, $elem);
}

$size = count($nom);

if ($argc == 2)
{
	for ($i = 0; $i < $size; $i++)
	{
		echo $nom[$i];
		echo ($i == ($size - 1)) ? "\n" : " ";
	}
}

?>