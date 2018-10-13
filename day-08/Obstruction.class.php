<?php

	require_once "Piece.class.php";

	class Obstruction extends Piece {

		public static $verbose = false;
		public static function doc() : string {
			$str = "\n".str_pad("<- Board ", 80, "-")."\n";
			$str .= file_get_contents('./Board.doc.txt')."\n";
			$str .= str_pad(" Board ->", 80, "-", STR_PAD_LEFT)."\n";
			return ($str);
		}

		public function __construct($width, $height, $x, $y, $health) {
			Parent::__construct($width, $height, $x, $y, $health);
			if (Obstruction::$verbose)
				echo "Obstruction insance constructed\n";
		}

		function __toString() {
			return "Obstruction (width: $width, height: $height, x: $x, y: $y, health: $health)";
		}

		public function __destruct()
		{
			if (Obstruction::$verbose)
				echo "Obstruction insance destructed\n";
		}

		
	}

?>