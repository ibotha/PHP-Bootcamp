<?php

class Lannister {
	public function __constructor() {}
	public function sleepWith($other) {
		$pair[get_class($this)] = get_class($other);
		$pair[get_class($other)] = get_class($this);
		if ($pair['Jaime'] == 'Tyrion' || $pair['Tyrion'] == 'Cersei')
			echo "Not even if I am drunk !\n";
		if ($pair['Jaime'] == 'Sansa' || $pair['Tyrion'] == 'Sansa')
			echo "Let's do this\n";
		if ($pair['Jaime'] == 'Cersei')
			echo "With pleasure, but only in a tower in Winterfell, then.\n";
	}
}

?>