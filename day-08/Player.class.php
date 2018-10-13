<?php

	require_once "IParty.class.php";
	require_once "Ship.class.php";

	class Player implements Party {

		public static $verbose = false;
		public static function doc() : string {
			$str = "\n".str_pad("<- Player ", 80, "-")."\n";
			$str .= file_get_contents('./Player.doc.txt')."\n";
			$str .= str_pad(" Player ->", 80, "-", STR_PAD_LEFT)."\n";
			return ($str);
		}

		private $_pieces = array();

		public function __construct() {
			if (Player::$verbose)
				echo "Player instance constructed";
		}

		public function __destruct() {
			if (Player::$verbose)
				echo "Player instance destructed";
		}

		function __toString() {
			return "Player";
		}

		public function addPiece($name, $piece) {
			$this->_pieces[$name] = $piece;
		}

		function printActive($act) {
			foreach ($this->_pieces as $key=> $value)
			{
				$x = $value->__get('_x');
				$y = $value->__get('_y');
				$w = $value->__get('_width');
				$h = $value->__get('_height');
				echo '<button type="submit" value="'.$key.'" name="target" style="	position: absolute;
									background: transparent;
									diplay: flex;
									flex-direction: row;
									color: white;';
							if ($act['high'] && $key == $act['ship'])
								echo "border: 1px solid blue;";
							if ($value->isRotated())
							echo	'transform-origin: 0% 0%;
									transform: rotate(90deg);
									left: calc(13px * '.($x + 1 + (int)($w / 2)).' + 1px);
									top: calc(13px * '.($y - (int)($h / 2)).' + 1px);
									width: calc(13px * '.$h.' - 1px);
									height: calc(13px * '.$w.' - 1px);
									">';
							else
							echo	'left: calc(13px * '.($x - (int)($w / 2)).' + 1px);
									top: calc(13px * '.($y - (int)($h / 2)).' + 1px);
									width: calc(13px * '.$w.' - 1px);
									height: calc(13px * '.$h.' - 1px);
									">';
				echo	'<img src="http://pngimage.net/wp-content/uploads/2018/06/top-down-spaceship-png-6.png"
							style="	width: 100%;
									height: 100%;
									"><div style="position: absolute; pointer-events: none;
													top: 0%;">';
							echo	$value->getName().' <span style="color: lightcoral;">'.$value->__get('_health').'</span>
							<span style="color: lightblue;">'.$value->getShield().'</span>
							<span style="color: lightgreen;">'.$value->getMovement().'</span>
							<span style="color: gold;">'.$value->getWeapon().'</span></div></button>';
			}
		}

		function printPassive($act) {
			foreach ($this->_pieces as $key=> $value)
			{
				$x = $value->__get('_x');
				$y = $value->__get('_y');
				$w = $value->__get('_width');
				$h = $value->__get('_height');
				echo '<div style="	position: absolute;
									diplay: flex;
									flex-direction: row;
									color: white;';
							if ($act['high'] && $key == $act['ship'])
								echo "border: 1px solid blue;";
							if ($value->isRotated())
							echo	'transform-origin: 0% 0%;
									transform: rotate(90deg);
									left: calc(13px * '.($x + 1 + (int)($w / 2)).' + 1px);
									top: calc(13px * '.($y - (int)($h / 2)).' + 1px);
									width: calc(13px * '.$h.' - 1px);
									height: calc(13px * '.$w.' - 1px);
									">';
							else
							echo	'left: calc(13px * '.($x - (int)($w / 2)).' + 1px);
									top: calc(13px * '.($y - (int)($h / 2)).' + 1px);
									width: calc(13px * '.$w.' - 1px);
									height: calc(13px * '.$h.' - 1px);
									">';
				echo	'<img src="http://pngimage.net/wp-content/uploads/2018/06/top-down-spaceship-png-6.png"
							style="	width: 100%;
									height: 100%;
									"><div style="position: absolute; pointer-events: none;
													top: 0%;">';
							echo	$value->getName().' <span style="color: lightcoral;">'.$value->__get('_health').'</span>
							<span style="color: lightblue;">'.$value->getShield().'</span>
							<span style="color: lightgreen;">'.$value->getMovement().'</span>
							<span style="color: gold;">'.$value->getWeapon().'</span></div></div>';
			}
		}

		function getShip($key) {
			return $this->_pieces[$key];
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