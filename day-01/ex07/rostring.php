#!/usr/bin/php
<?php
$nom = preg_split('/ +/', trim($argv[1], ' '));
array_push($nom, $nom[0]);
$size = count($nom);
if (trim($argv[1], ' '))
	for ($i = 1; $i < $size; $i++)
		echo $nom[$i].(($i == ($size - 1)) ? "\n" : " ");
?>