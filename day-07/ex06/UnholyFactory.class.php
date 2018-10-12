<?php
class UnholyFactory {
	private $_army = array();
	private static $_types = ['Footsoldier' => 'foot soldier', 'Archer' => 'archer', 'Assassin' => 'assassin'];

	public function absorb($s) {
		if (get_parent_class($s) == 'Fighter')
		{
			if (isset($this->_army[$s->getName()]))
				echo "(Factory already absorbed a fighter of type ".$s->getName().")\n";
			else
			{
				$this->_army[$s->getName()] = $s;
				echo "(Factory absorbed a fighter of type ".$s->getName().")\n";
			}
		}
		else
			echo "(Factory can't absorb this, it's not a fighter)\n";
	}

	public function fabricate($s) {
		if (array_key_exists($s, $this->_army))
		{
			echo '(Factory fabricates a fighter of type '.$s.")\n";
			return (clone $this->_army[$s]);
		}
		else
			echo "(Factory hasn't absorbed any fighter of type ".$s.")\n";
	}
}
?>