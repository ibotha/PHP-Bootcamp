<?php

require_once "IFighter.class.php";

class NightsWatch implements IFighter{
	private $_army = array();

	function recruit($f) { $this->_army[] = $f; }
	function fight() {
		foreach ($this->_army as $soldier) {
			if (method_exists($soldier, 'fight'))
				$soldier->fight();
		}
	}
}
?>