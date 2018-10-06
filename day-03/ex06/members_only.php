<?php
	if ($_SERVER["PHP_AUTH_USER"] == "zaz" && $_SERVER["PHP_AUTH_PW"] == "jaimelespetitsponeys") {
		?>
		<html><body>
		Hello Zaz<br />
		<img src='../img/42.png'>
		</body></html>
		<?php
	} else {
		header("HTTP/1.0 401 Unautorized");
		header('WWW-Authenticate: Basic realm=\'\'Member Area\'\'');
		?>
		<html><body>That area is accessible for members only</body></html>
		<?php
	}
?>
