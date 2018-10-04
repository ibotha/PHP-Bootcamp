#!/usr/bin/php
<?PHP
function calc($arg)
{
	print_r($arg);
	switch ($arg[3])
	{
		case "%":
			return $arg[1] % $arg[5];
			break;
		case "+":
			return $arg[1] + $arg[5];
			break;
		case "-":
			return $arg[1] - $arg[5];
			break;
		case "/":
			return $arg[1] / $arg[5];
			break;
		case "*":
			return $arg[1] * $arg[5];
			break;
		default:
			break;
	}
	return "uhoh";
}

if ($argc != 2)
	echo "Incorrect Parameters\n";
else
{
	$str = trim($argv[1]);
	if (!preg_match("/^([+-]?[0-9]{1,})([\t ]+)?([+-\/%*])([\t ]+)?([+-]?[0-9]{1,})$/", $str))
		echo "Syntax Error\n";
	else
		echo preg_replace_callback("/^([+-]?[0-9]{1,})([\t ]+)?([+-\/%*]{1})([\t ]+)?([+-]?[0-9]{1,})$/", "calc", $str)."\n";
}
?>