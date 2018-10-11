<?php

require_once "Vertex.class.php";

class Triangle {

	static $verbose = false;
	static function doc() {

		$str = "\n".str_pad("<- Triangle ", 80, "-")."\n";
		$str .= file_get_contents('./Triangle.doc.txt')."\n";
		$str .= str_pad(" Triangle ->", 80, "-", STR_PAD_LEFT)."\n";
		return ($str);
	}

	var $_A;
	var $_B;
	var $_C;

	function __construct( Vertex $a, Vertex $b, Vertex $c ) {
		$this->_A = $a;
		$this->_B = $b;
		$this->_C = $c;
		if (Triangle::$verbose)
			echo "Triangle constructed\n";
	}

	function __toString() {
		return sprintf("A: %s\nB: %s\nC: %s",$this->getA(), $this->getB(), $this->getC());
	}

	function getA() { return $this->_A; }
	function getB() { return $this->_B; }
	function getC() { return $this->_C; }

	function __destruct() {
		if (Triangle::$verbose)
			echo "Triangle destructed\n";
	}
}

?>