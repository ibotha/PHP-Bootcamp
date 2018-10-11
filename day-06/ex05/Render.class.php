<?php

class Render {

	const EDGE = 'edge';
	const VERTEX = 'vertex';
	const RASTERIZE = 'rasterize';

	static $verbose = false;
	static function doc() {

		$str = "\n".str_pad("<- Renderer ", 80, "-")."\n";
		$str .= file_get_contents('./Renderer.doc.txt')."\n";
		$str .= str_pad(" Renderer ->", 80, "-", STR_PAD_LEFT)."\n";
		return ($str);
	}

	private $_width;
	private $_height;
	private $_filename;
	private $_image;

	function __construct($width, $height, $filename) {
		$this->_width = $width;
		$this->_height = $height;
		$this->_filename = $filename;
		$this->_image = imagecreate((int)$width, (int)$height);
		imagecolorallocate($this->_image, 0, 0, 0);
		if (Render::$verbose)
			echo "Render instance constructed\n";
	}

	function toW($x) { return ($x * $this->_width + $this->_width / 2); }

	function toH($x) { return $x * $this->_width + $this->_height / 2; }

	function renderVertex(Vertex $v) {
		$color = imagecolorallocate($this->_image,
									$v->get_color()->red,
									$v->get_color()->green,
									$v->get_color()->blue);
		imagesetpixel($this->_image,
						$this->toW($v->get_x()),
						$this->toH($v->get_y()),
						$color);
	}

	function renderTriangle(Triangle $v) {
		imagesetinterpolation($this->_image, IMG_TRIANGLE );
		$points = [$this->toW($v->getA()->get_x()), $this->toH($v->getA()->get_y()),
					$this->toW($v->getB()->get_x()), $this->toH($v->getB()->get_y()),
					$this->toW($v->getC()->get_x()), $this->toH($v->getC()->get_y())];
		$a = $v->getA()->get_color();
		$b = $v->getB()->get_color();
		$c = $v->getC()->get_color();
		$color1 = imagecolorallocate($this->_image, $a->red, $b->green, $b->blue);
		$color2 = imagecolorallocate($this->_image, $b->red, $b->green, $b->blue);
		$color3 = imagecolorallocate($this->_image, $c->red, $c->green, $c->blue);
		imagesetstyle($this->_image, array($color1, $color2, $color3));
		imagefilledpolygon($this->_image, $points, 3, IMG_COLOR_STYLED);

	}

	function renderEdge(Vertex $a, Vertex $b) {
		$color1 = imagecolorallocate($this->_image, $a->get_color()->red, $b->get_color()->green, $b->get_color()->blue);
		$color2 = imagecolorallocate($this->_image, $b->get_color()->red, $b->get_color()->green, $b->get_color()->blue);
		imagesetstyle($this->_image, array($color1, $color2));
		imageline($this->_image, $this->toW($a->get_x()), $this->toH($a->get_y()), $this->toW($b->get_x()), $this->toH($b->get_y()), IMG_COLOR_STYLED);
	}

	function renderMesh(array $v, $type) {
		foreach ($v as $tri)
		{
			switch ($type)
			{
				case Render::VERTEX:
					$this->renderVertex($tri->getA());
					$this->renderVertex($tri->getB());
					$this->renderVertex($tri->getC());
				case Render::EDGE:
					$this->renderEdge($tri->getA(), $tri->getB());
					$this->renderEdge($tri->getB(), $tri->getC());
					$this->renderEdge($tri->getC(), $tri->getA());
				case Render::RASTERIZE:
					$this->renderTriangle($tri);
			}
		}
	}

	function __destruct() {
		imagedestroy($this->_image);
		if (Render::$verbose)
			echo "Render instance destructed\n";
	}

	function develop() {
		imagepng($this->_image, $this->_filename);
	}
}

?>