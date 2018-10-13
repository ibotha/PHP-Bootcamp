<?php

	require_once "IParty.class.php";
	require_once "Obstruction.class.php";

	class Obstructions implements Party {

		public static $verbose = false;
		public static function doc() : string {
			$str = "\n".str_pad("<- Obstructions ", 80, "-")."\n";
			$str .= file_get_contents('./Obstructions.doc.txt')."\n";
			$str .= str_pad(" Obstructions ->", 80, "-", STR_PAD_LEFT)."\n";
			return ($str);
		}

		private $_pieces = array();

		public function __construct() {
			if (Obstructions::$verbose)
				echo "Obstructions instance constructed";
		}

		public function __destruct() {
			if (Obstructions::$verbose)
				echo "Obstructions instance destructed";
		}

		function __toString() {
			return "Obstructions";
		}

		public function addPiece($name, $piece) {
			$this->_pieces[$name] = $piece;
		}

		function printActive($cur) {
			foreach ($this->_pieces as $key => $value)
			{
				$x = $value->__get('_x');
				$y = $value->__get('_y');
				$w = $value->__get('_width');
				$h = $value->__get('_height');
				echo '<button type="submit" value="'.$key.'" name="target" style="	position: absolute;
									diplay: flex;
									background: transparent;
									flex-direction: row;
									color: white;';
							echo	'left: calc(13px * '.($x - (int)($w / 2)).' + 1px);
									top: calc(13px * '.($y - (int)($h / 2)).' + 1px);
									width: calc(13px * '.$w.' - 1px);
									height: calc(13px * '.$h.' - 1px);
									">';
				echo	'<img src="https://vignette.wikia.nocookie.net/samorost6178/images/9/99/Meteor.png/revision/latest?cb=20170128122740"
							style="	width: 100%;
									height: 100%;
									"></button>';
			}
		}

		function printPassive($cur) {
			foreach ($this->_pieces as $key => $value)
			{
				$x = $value->__get('_x');
				$y = $value->__get('_y');
				$w = $value->__get('_width');
				$h = $value->__get('_height');
				echo '<div style="	position: absolute;
									diplay: flex;
									flex-direction: row;
									color: white;';
							echo	'left: calc(13px * '.($x - (int)($w / 2)).' + 1px);
									top: calc(13px * '.($y - (int)($h / 2)).' + 1px);
									width: calc(13px * '.$w.' - 1px);
									height: calc(13px * '.$h.' - 1px);
									">';
				echo	'<img src="https://vignette.wikia.nocookie.net/samorost6178/images/9/99/Meteor.png/revision/latest?cb=20170128122740"
							style="	width: 100%;
									height: 100%;
									"></div>';
			}
		}

		function hit($i) {
			if (!isset($this->_pieces[$i]))
				return;
			if ($this->_pieces[$i]->getHealth() == 1)
				unset($this->_pieces[$i]);
			else
				$this->_pieces[$i]->setHealth($this->_pieces[$i]->getHealth() - 1);
		}

	}

?>