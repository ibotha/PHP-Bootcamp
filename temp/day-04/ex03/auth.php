<?php
function auth($login, $passwd)
{
	$data = @unserialize(file_get_contents("../private/passwd"));
	return $data[$login] == hash("Whirlpool", $passwd);
}
?>