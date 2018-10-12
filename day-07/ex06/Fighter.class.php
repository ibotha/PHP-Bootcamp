<?php
class Fighter {
	private $_name = "";

	function __construct(string $name) {
		$this->_name = $name;
	}

	function getName() {
		return $this->_name;
	}
}
?>