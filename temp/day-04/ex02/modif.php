<?php
session_start();

function auth($login, $passwd)
{
	global $data;
	return $data[$login] == hash("Whirlpool", $passwd);
}

if ($_POST['submit'] == "OK")
{
	if ($_POST['login'])
	{
		@mkdir("../private");
		if (!file_exists("../private/passwd"))
			touch("../private/passwd");
		$data = @unserialize(file_get_contents("../private/passwd"));
		if (!$data[$_POST['login']] || !(auth($_POST["login"], $_POST["oldpw"])))
			echo "ERROR";
		else
			$data[$_POST["login"]] = hash("Whirlpool", $_POST["newpw"]);
		file_put_contents("../private/passwd", serialize($data));
	}
	else
		echo "ERROR";
}
else
	echo "ERROR";
?>