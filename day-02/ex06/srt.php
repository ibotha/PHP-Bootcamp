#!/usr/bin/php
<?php

function rep($arg)
{
	global $num, $time;
	$num[] = $arg[1];
	$time[$arg[2]] = $arg[3];
	return ($arg[0]);
}

if ($argc > 1)
{
	$cont = file_get_contents($argv[1]);
	$cont = preg_replace_callback("/([0-9]*\n)([0-9]{2}:[0-9]{2}:[0-9]{2},[0-9]{3} --> [0-9]{2}:[0-9]{2}:[0-9]{2},[0-9]{3}\n)([^0-9]*?)/Usi", rep, $cont);
	ksort($time);
	$i = 0;
	foreach ($time as $key => $value) {
		echo $num[$i++].$key.$value."\n";
	}
}
?>