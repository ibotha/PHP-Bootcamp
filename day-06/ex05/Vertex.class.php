<?php
require_once "Color.class.php";
class Vertex{
	public static $verbose = false;
	public static function doc() : string {
		$str = "\n".str_pad("<- Vertex ", 80, "-")."\n";
		$str .= file_get_contents('./Vertex.doc.txt')."\n";
		$str .= str_pad(" Vertex ->", 80, "-", STR_PAD_LEFT)."\n";
		return ($str);
	}

	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_color;
	
	function __construct(array $v) {

		$this->_x = (double)$v["x"];
		$this->_y = (double)$v["y"];
		$this->_z = (double)$v["z"];
		$this->_w = $v["w"] ? (double)$v["w"] : 1.00;
		$this->_color = $v["color"] ? $v["color"] : new Color( array( 'red' => 255, 'green' => 255, 'blue' => 255));
		if (Vertex::$verbose)
			print ($this.' constructed'.PHP_EOL);
	}

	function __toString() {
		$ret = sprintf('Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f',
							$this->_x, $this->_y, $this->_z, $this->_w);
		if (Vertex::$verbose)
			$ret .= ', '.$this->_color;
		$ret .= ' )';
		return $ret;
	}

	function add(Vertex $col) : Vertex {
		return new Vertex(array ("x" => $col->get_x() + $this->_x,
								"y" => $col->get_y() + $this->_y,
								"z" => $col->get_z() + $this->_z,
								"color" => $this->_color)
							);
	}

	function sub(Vertex $v) : Vertex {
		return new Vertex(array ("x" => $this->_x - $v->get_x(),
								"y" => $this->_y - $v->get_y(),
								"z" => $this->_z - $v->get_z(),
								"color" => $this->_color));
	}

	function mult($f) : Vertex {
		return new Vertex(array ("x" => $f * $this->_x,
								"y" => $f * $this->_y,
								"z" => $f * $this->_z,
								"color" => $this->_color));
	}

	function __destruct() {
		if (Vertex::$verbose)
			print ($this.' destructed'.PHP_EOL);
	}

	function get_x() { return $this->_x; }
	function get_y() { return $this->_y; }
	function get_z() { return $this->_z; }
	function get_w() { return $this->_w; }
	function set_x($v) { $this->_x = (float)$v; }
	function set_y($v) { $this->_y = (float)$v; }
	function set_z($v) { $this->_z = (float)$v; }
	function set_w($v) { $this->_w = (float)$v; }

	function get_color() { return $this->_color; }
	function set_color( Color $v) { $this->_color = $v; }
}
?>