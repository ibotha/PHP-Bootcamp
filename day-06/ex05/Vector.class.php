<?php
require_once "Vertex.class.php";
class Vector{
	public static $verbose = false;
	public static function doc() : string {
		$str = "\n".str_pad("<- Vector ", 80, "-")."\n";
		$str .= file_get_contents('./Vector.doc.txt')."\n";
		$str .= str_pad(" Vector ->", 80, "-", STR_PAD_LEFT)."\n";
		return ($str);
	}

	private $_x;
	private $_y;
	private $_z;
	private $_w;
	
	function __construct(array $args) {
		if (!isset($args['orig']))
			$args['orig'] = new Vertex( array ( 'x' => 0, 'y' => 0, 'z' => 0, 'w' => 1 ) );
		if (array_key_exists("dest", $args) && $args['dest'] instanceof Vertex) {
			$this->_x = $args['dest']->get_x() - $args['orig']->get_x();
			$this->_y = $args['dest']->get_y() - $args['orig']->get_y();
			$this->_z = $args['dest']->get_z() - $args['orig']->get_z();
			$this->_w = 0.00;
		}
		if (Vector::$verbose)
			print ($this.' constructed'.PHP_EOL);
	}

	function __toString() {
		$ret = sprintf('Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )',
							$this->_x, $this->_y, $this->_z, $this->_w);
		return $ret;
	}

	function add(Vector $v) : Vector {
		return new Vector( array ( 'dest' => new Vertex( array(
										'x' => $this->get_x() + $v->get_x(),
										'y' => $this->get_y() + $v->get_y(),
										'z' => $this->get_z() + $v->get_z())
									)
								)
							);
	}

	function sub(Vector $v) : Vector {
		return new Vector( array ( 'dest' => new Vertex( array(
										'x' => $this->get_x() - $v->get_x(),
										'y' => $this->get_y() - $v->get_y(),
										'z' => $this->get_z() - $v->get_z())
									)
								)
							);
	}

	function scalarProduct($f) : Vector {
		return new Vector( array ( 'dest' => new Vertex( array(
										'x' => $this->get_x() * $f,
										'y' => $this->get_y() * $f,
										'z' => $this->get_z() * $f)
									)
								)
							);
	}

	function magnitude() : float {
		return sqrt( pow($this->get_x(), 2) + pow($this->get_y(), 2) + pow($this->get_z(), 2));
	}

	function normalize() : Vector{
		if ($this->magnitude())
			return $this->scalarProduct(1 / $this->magnitude());
		else
			return $this;
	}

	function opposite() : Vector{
		return $this->scalarProduct(-1);
	}

	function dotProduct(Vector $v) : float{
		return $this->get_x() * $v->get_x() + $this->get_y() * $v->get_y() + $this->get_z() * $v->get_z();
	}

	function crossProduct(Vector $v) : Vector{
		return new Vector( array ( 'dest' => new Vertex( array(
										'x' => $this->get_y() * $v->get_z() - $this->get_z() * $v->get_y(),
										'y' => $this->get_z() * $v->get_x() - $this->get_x() * $v->get_z(),
										'z' => $this->get_x() * $v->get_y() - $this->get_y() * $v->get_x())
									)
								)
							);
	}

	function cos(Vector $v) : float{
		$c = $this->dotProduct($v);
		$a = $this->dotProduct($this);
		$b = $v->dotProduct($v);
		return $c / sqrt($a * $b);
	}

	function __destruct() {
		if (Vector::$verbose)
			print ($this.' destructed'.PHP_EOL);
	}

	function get_x() { return $this->_x; }
	function get_y() { return $this->_y; }
	function get_z() { return $this->_z; }
	function get_w() { return $this->_w; }
}
?>