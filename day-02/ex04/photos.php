#!/usr/bin/php
<?php

$imgs = [];

function rep($arg)
{
	global $imgs;
	$imgs[] = trim($arg[2], "/");
	return $arg[0];
}

function htmlclean($arg)
{
	return ($arg[1]."www.".$arg[3].$arg[4]);
}

if ($argc > 1)
{
	$host = trim($argv[1], "/");
	$host .= "/";
	$name = preg_replace("/(http[s]*:\/\/)/s", "", $host);
	$page = file_get_contents($host);
	$page = preg_replace_callback("/(<img[^>]*src=\")(.*)(\"[^<]*>)/sU", "rep", $page);
	@mkdir($name);
	foreach ($imgs as $img)
	{
		if ($img)
		{
			$fname = explode("/", $img);
			$fname = $name.$fname[count($fname) - 1];
			touch($fname);
			$fp = fopen($fname, 'wb');
			if (preg_match("/(http[s]*:\/\/)/s", $img))
				$ch = curl_init($img);
			else
				$ch = curl_init($host.$img);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
		}
	}
}
?>