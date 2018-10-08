<?php
	@mkdir("./store");
	if (!file_exists("./store/items.txt"))
		touch("./store/items.txt");
	if (!file_exists("./store/users.txt"))
		touch("./store/users.txt");
	if (!file_exists("./store/cats.txt"))
		touch("./store/cats.txt");
?>