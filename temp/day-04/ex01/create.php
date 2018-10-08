<?php
session_start();
if ($_POST['submit'] == "OK")
{
	if ($_POST['login'])
	{
		@mkdir("../private");
		if (!file_exists("../private/passwd"))
			touch("../private/passwd");
		$data = @unserialize(file_get_contents("../private/passwd"));
		if (!$data[$_POST['login']])
		{
			$data[$_POST['login']] = hash("Whirlpool", $_POST['passwd']);
			echo "OK";
		}
		else
			echo "ERROR";
		file_put_contents("../private/passwd", serialize($data));
	}
	else
		echo "ERROR";
}
else
	echo "ERROR";
?>