#!/usr/bin/php
<?PHP

if ($argc != 4)
	echo "Incorrect Parameters\n";
else
{
	if (is_numeric(trim($argv[1])))
		$x = (int)trim($argv[1]);
	else
		$x = 0;
	if (is_numeric(trim($argv[3])))
		$y = (int)trim($argv[3]);
	else
		$y = 0;
	$op = trim($argv[2]);
	switch ($op)
	{
		case "%":
			echo $x % $y."\n";
			break;
		case "+":
			echo $x + $y."\n";
			break;
		case "-":
			echo $x - $y."\n";
			break;
		case "/":
			echo $x / $y."\n";
			break;
		case "*":
			echo $x * $y."\n";
			break;
		default:
			break;
	}
}

?>