<?php
require_once "Matrix.class.php";
class Camera{
	public static $verbose = false;
	public static function doc() : string {
		$str = "\n".str_pad("<- Camera ", 80, "-")."\n";
		$str .= file_get_contents('./Camera.doc.txt')."\n";
		$str .= str_pad(" Camera ->", 80, "-", STR_PAD_LEFT)."\n";
		return ($str);
	}

	private $_tT;
	private $_tR;
	private $_proj;
	private $_orig;
	private $_height;
	private $_width;
	
	function __construct(array $args) {
		$this->_height = $args['height'];
		$this->_width = $args['width'];
		$this->setOrigin($args['origin']);
		$this->setRotation($args['orientation']);
		$this->_proj = new Matrix( array('preset' => Matrix::PROJECTION,
										 'fov' => $args['fov'],
										 'ratio' => $args['width'] / $args['height'],
										 'near' => $args['near'],
										 'far' => $args['far']
										) );
		if (Camera::$verbose)
			echo "Camera instance constructed\n";
	}

	function __toString() {
		$ret = sprintf(
'Camera( 
+ Origin: %s
+ tT:
%s
+ tR:
%s
+ tR->mult( tT ):
%s
+ Proj:
%s
)',
		$this->_orig, $this->_tT, $this->_tR, $this->getView(), $this->_proj);
		return $ret;
	}

	function getView() : Matrix{
		return $this->_tR->mult($this->_tT);
	}

	function watchVertex(vertex $v) : Vertex {
		$vtx = ($this->getView())->transformVertex($v);
		$vtx = $this->_proj->transformVertex($vtx);
		$vtx->set_color($v->get_color());
		return ($vtx);

	}

	function __destruct() {
		if (Camera::$verbose)
			echo "Camera instance destructed\n";
	}

	function setOrigin(Vertex $orig) {
		$this->_orig = $orig; 
		$trans = new Vector( array( 'dest' => $this->_orig ) );
		$this->_tT = new Matrix( array('preset' => Matrix::TRANSLATION,
										'vtc' => $trans->opposite()
										)
								);
	}

	function setRotation(Matrix $R) {
		$this->_tR = new Matrix ( array ('preset' => Matrix::IDENTITY) );
		for ($x = 0; $x < 4; $x++)
			for ($y = 0; $y < 4; $y++)
				$this->_tR->set($x, $y, $R->get($y, $x));
	}

	function setProjection(array $args) {
		$this->_proj = new Matrix( array('preset' => Matrix::PROJECTION,
										 'fov' => $args['fov'],
										 'ratio' => $args['width'] / $args['height'],
										 'near' => $args['near'],
										 'far' => $args['far']
										) );
	}
}
?>