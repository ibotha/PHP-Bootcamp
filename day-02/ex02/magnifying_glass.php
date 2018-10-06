#!/usr/bin/php
<?php

function replace($array)
{
	return ($array[1].strtoupper($array[2]).$array[3]);
}

function replace_1($array)
{
	return (strtoupper($array[1]).$array[2]);
}

function replace_a($array)
{
	return ($array[1].preg_replace_callback("/([^<>]*)(<[^<>]*>)?/is", "replace_1", $array[2]).$array[3]);
}

$content = @file_get_contents($argv[1]);
if (!$content)
	die();
$content = preg_replace_callback("/(<.*title=\")(.*)(\".*>)/isU", "replace", $content);
$content = preg_replace_callback("/(<a.*>)(.*)(<\/a>)/isU", "replace_a", $content);
print_r($content);
?>