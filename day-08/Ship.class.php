<?php

	require_once "Piece.class.php";

	final class Ship extends Piece {

		public static $verbose = false;
		public static function doc() : string {
			$str = "\n".str_pad("<- Board ", 80, "-")."\n";
			$str .= file_get_contents('./Board.doc.txt')."\n";
			$str .= str_pad(" Board ->", 80, "-", STR_PAD_LEFT)."\n";
			return ($str);
		}

		private $_rotated;
		private	$_name;
		private	$_pp;
		private $_shield = 0;
		private $_movement = 0;
		private $_weapon = 0;
		private $_speed;

		public function __construct($width, $height, $x, $y, $health, $name, $pp, $speed) {
			Parent::__construct($width, $height, $x, $y, $health);
			if ($width < $height)
				$this->_rotated = true;
			$this->_x += 1;
			$this->_name = $name;
			$this->_pp = $pp;
			$this->_speed = $speed;
			if (Ship::$verbose)
				echo "Ship instance constructed";
		}

		function __toString() {
			return "Ship (width: $width, height: $height, x: $x, y: $y, health: $health, Name: $name, PP: $pp, Speed: $speed)";
		}

		function isRotated() {return $this->_rotated;}
		function getName() {return $this->_name;}
		function getPP() {return $this->_pp;}
		function getShield() {return $this->_shield;}
		function getMovement() {return $this->_movement;}
		function getWeapon() {return $this->_weapon;}

		function allocPP($s, $m, $w) {
			$left = $this->_pp;
			$this->_shield = min($left, $s);
			$left -= $s;
			if ($left < 0)
				return;
			$this->_movement = min($left, $m) + $this->_speed;
			$left -= $m;
			if ($left < 0)
				return;
			$this->_weapon = 1 + min($left, $w);
		}

		function canMove($x, $y) {
			if ($this->_width < 1 || $this->_height < 1 || ($y - (int)($this->_height / 2)) < 0 || ($x - (int)($this->_width / 2)) < 0 || $y > (100 - (1 + (int)($this->_height / 2))) || $x > (150 - 1 - (int)($this->_width / 2)))
				return false;
			$x -= $this->_x;
			$y -= $this->_y;
			if (sqrt($x ** 2 + $y ** 2) < $this->_movement)
				return true;
			return false;
		}

		function move($x, $y) {
			if ($this->canMove($x, $y)) {
				$x -= $this->_x;
				$y -= $this->_y;
				$this->_x += $x;
				$this->_y += $y;
				$this->_movement -= (int)sqrt($x ** 2 + $y ** 2);
			}
		}

		public function __destruct() {
			if (Ship::$verbose)
				echo "Ship instance destructed";
		}
	}

?>