<?php

require_once "Vertex.class.php";
require_once "Vector.class.php";

class Matrix{

	const IDENTITY = 'IDENTITY';
	const SCALE = 'SCALE preset';
	const RX = 'Ox ROTATION preset';
	const RY = 'Oy ROTATION preset';
	const RZ = 'Oz ROTATION preset';
	const TRANSLATION = 'TRANSLATION preset';
	const PROJECTION = 'PROJECTION preset';

	public static $verbose = false;
	public static function doc() : string {
		$str = "\n".str_pad("<- Matrix ", 80, "-")."\n";
		$str .= file_get_contents('./Matrix.doc.txt')."\n";
		$str .= str_pad(" Matrix ->", 80, "-", STR_PAD_LEFT)."\n";
		return ($str);
	}

	private $_m = array();
	
	function __construct(array $args) {
		$this->make_identity();
		switch ($args['preset'])
		{
			case 'TRANSLATION preset':
				$this->set(3, 0, $args['vtc']->get_x());
				$this->set(3, 1, $args['vtc']->get_y());
				$this->set(3, 2, $args['vtc']->get_z());
				break;
			case 'SCALE preset':
				$this->set(0, 0, $args['scale']);
				$this->set(1, 1, $args['scale']);
				$this->set(2, 2, $args['scale']);
				break;
			case 'Ox ROTATION preset':
				$this->set(1, 1, cos($args['angle']));
				$this->set(1, 2, sin($args['angle']));
				$this->set(2, 2, $this->get(1, 1));
				$this->set(2, 1, -$this->get(1, 2));
				break;
			case 'Oy ROTATION preset':
				$this->set(0, 0, cos($args['angle']));
				$this->set(2, 0, sin($args['angle']));
				$this->set(2, 2, $this->get(0, 0));
				$this->set(0, 2, -$this->get(2, 0));
				break;
			case 'Oz ROTATION preset':
				$this->set(0, 0, cos($args['angle']));
				$this->set(0, 1, sin($args['angle']));
				$this->set(1, 1, $this->get(0, 0));
				$this->set(1, 0, -$this->get(0, 1));
				break;
			case 'PROJECTION preset':
				$this->set(1, 1, 1 / tan(0.5 * deg2rad($args['fov'])));
				$this->set(0, 0, $this->get(1, 1) / $args['ratio']);
				$this->set(2, 2, ($args['near'] + $args['far']) / ($args['near'] - $args['far']));
				$this->set(2, 3, -1);
				$this->set(3, 2, (2 * $args['near'] * $args['far']) / ($args['near'] - $args['far']));
				$this->set(3, 3, 0);
				break;
			default:
			break;
		}
		if (Matrix::$verbose)
			printf('Matrix %s instance constructed'."\n", $args['preset']);
	}

	private function make_identity() {
		$this->_m = array(1, 0, 0, 0,
						  0, 1, 0, 0,
						  0, 0, 1, 0,
						  0, 0, 0, 1);
	}

	function __toString() {
		return sprintf("M | vtcX | vtcY | vtcZ | vtxO\n".
					   "-----------------------------\n".
					   "x | %.2f | %.2f | %.2f | %.2f\n".
					   "y | %.2f | %.2f | %.2f | %.2f\n".
					   "z | %.2f | %.2f | %.2f | %.2f\n".
					   "w | %.2f | %.2f | %.2f | %.2f",
						$this->get(0, 0), $this->get(1, 0), $this->get(2, 0), $this->get(3, 0),
						$this->get(0, 1), $this->get(1, 1), $this->get(2, 1), $this->get(3, 1),
						$this->get(0, 2), $this->get(1, 2), $this->get(2, 2), $this->get(3, 2),
						$this->get(0, 3), $this->get(1, 3), $this->get(2, 3), $this->get(3, 3)
		);
	}

	function mult(Matrix $v) : Matrix {
		$ret = new Matrix( array( 'preset' => MATRIX::IDENTITY) );
		for ($i = 0; $i < 4; $i++)
		{
			for ($j = 0; $j < 4; $j++)
				$ret->set($i, $j, $this->get(0, $j) * $v->get($i, 0)
								+ $this->get(1, $j) * $v->get($i, 1)
								+ $this->get(2, $j) * $v->get($i, 2)
								+ $this->get(3, $j) * $v->get($i, 3));
		}
		return $ret;
	}

	function transformVertex(Vertex $v) : Vertex {
		return new Vertex( array(
			'x' => $v->get_x() * $this->get(0, 0) + $v->get_y() * $this->get(1, 0) + $v->get_z() * $this->get(2, 0) + $this->get(3, 0),
			'y' => $v->get_x() * $this->get(0, 1) + $v->get_y() * $this->get(1, 1) + $v->get_z() * $this->get(2, 1) + $this->get(3, 1),
			'z' => $v->get_x() * $this->get(0, 2) + $v->get_y() * $this->get(1, 2) + $v->get_z() * $this->get(2, 2) + $this->get(3, 2)) );
	}

	function __destruct() {
		if (Matrix::$verbose)
			echo 'Matrix instance destructed'.PHP_EOL;
	}

	function get(int $x, int $y) { return $this->_m[$x + $y*4]; }
	function set(int $x, int $y, float $v) { $this->_m[$x + $y*4] = $v; }
}
?>