#!/usr/bin/php
<?php
date_default_timezone_set("Africa/Johannesburg");
$file = fopen("/var/run/utmpx", "r");
while ($in = fread($file, 628))
{
	$content = unpack("a256user/a4id/a32line/ipid/itype/I2time", $in);
	if ($content["type"] == 7)
		$ret[] = $content;
}
fclose($file);
$len = 0;
foreach ($ret as $elem)
	if	(count(substr($elem["user"], 0, strpos($elem["user"], 0))) > $len)
		$len = strlen(substr($elem["user"], 0, strpos($elem["user"], 0)));

$len = $len + 9 - ($len % 9);

foreach ($ret as $elem)
{
	echo str_pad(substr($elem["user"], 0, strpos($elem["user"], 0)), $len);
	echo substr($elem["line"], 0, strpos($elem["line"], 0))."  ";
	echo date("M  j h:i", $elem["time1"])." \n";
}
?>