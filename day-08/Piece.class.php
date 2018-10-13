<?php

	abstract class Piece {

		public static $verbose = false;
		public static function doc() : string {
			$str = "\n".str_pad("<- Board ", 80, "-")."\n";
			$str .= file_get_contents('./Board.doc.txt')."\n";
			$str .= str_pad(" Board ->", 80, "-", STR_PAD_LEFT)."\n";
			return ($str);
		}

		protected $_width;
		protected $_height;
		protected $_health;
		protected $_x;
		protected $_y;

		public function __construct($width, $height, $x, $y, $health) {
			if (!is_numeric($width) || !is_numeric($height) || !is_numeric($x) || !is_numeric($y) || !is_numeric($health))
				throw new Exception("Piece construction was given a non-int value");
			if ($width < 1 || $height < 1 || ($y - (int)($height / 2)) < 0 || ($x - (int)($width / 2)) < 0 || $y > (100 - (int)($height / 2)) || $x > (150 - (int)($width / 2)))
				throw new Exception("Piece is too thin or off board");
			if ($health < 1)
				throw new Exception("Piece is dead");
			$this->_width = $width;
			$this->_height = $height;
			$this->_x = $x;
			$this->_y = $y;
			$this->_health = $health;
		}

		public function setHealth($i) {
			$this->_health = $i;
		}

		public function getHealth() {
			return $this->_health;
		}

		function __get($name) { return $this->$name; }
	}

?>