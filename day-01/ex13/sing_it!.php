#!/usr/bin/php
<?php

$nom = ["Why this demo ?"=>"To avoid people noticing this while going over the subject briefly",
		"Why this song ?"=>"Because we're all children inside",
		"really ?"=>"No it's because it's april's fool",
		"really ?"=>"Yeah we really are all children inside"];

$ans = $nom[$argv[1]];
if ($ans)
	echo "$ans\n";
?>