<?php
class Color{
	public static $verbose = false;
	public static function doc() : string {
		return file_get_contents('./Color.doc.txt');
	}

	public $red;
	public $green;
	public $blue;
	
	function __construct(array $col) {
		if ($col["rgb"])
		{
			$this->red = ((int)($col["rgb"] >> 16) & 255);
			$this->green = ((int)($col["rgb"] >> 8) & 255);
			$this->blue = (int)($col["rgb"] & 255);
		}
		else
		{
			$this->red = (intval($col["red"], 10));
			$this->green = (intval($col["green"], 10));
			$this->blue = (intval($col["blue"], 10));
		}
		if (Color::$verbose)
			print ($this.' constructed.'.PHP_EOL);
	}

	function __toString() {
		 return sprintf('Color( red: %3d, green: %3d, blue: %3d )', $this->red, $this->green, $this->blue);
	}

	function add(Color $col) : Color {
		return new Color(array ("red" => $col->red + $this->red,
								"green" => $col->green + $this->green,
								"blue" => $col->blue + $this->blue));
	}

	function sub(Color $col) : Color {
		return new Color(array ("red" => $this->red - $col->red,
								"green" => $this->green - $col->green,
								"blue" => $this->blue - $col->blue));
	}

	function mult($f) : Color {
		return new Color(array ("red" => $f * $this->red,
								"green" => $f * $this->green,
								"blue" => $f * $this->blue));
	}

	function __destruct() {
		if (Color::$verbose)
			print ($this.' destructed.'.PHP_EOL);
	}
}
?>