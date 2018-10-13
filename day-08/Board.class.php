<?php
	require_once "Player.class.php";
	require_once "Obstructions.class.php";
	class Board {

		public static $verbose = false;
		public static function doc() : string {
			$str = "\n".str_pad("<- Board ", 80, "-")."\n";
			$str .= file_get_contents('./Board.doc.txt')."\n";
			$str .= str_pad(" Board ->", 80, "-", STR_PAD_LEFT)."\n";
			return ($str);
		}

		private $_obstructions;
		private $_player1;
		private $_player2;
		private $_turn = 1;
		private $_currentShip = 0;
		private $_phase = 0;

		const PHASE1 = 0;
		const PHASE2 = 1;
		const PHASE3 = 2;

		function __call($method, $args) {
			return "It no exist";
		}

		function __staticCall($method, $args) {
			return "It no exist";
		}

		public function __construct() {
			$this->_player1 = new Player();
			$this->_player2 = new Player();
			$this->_obstructions = new Obstructions();
			$pieces = array(
				0 => new Ship(4, 10, 2, 5, 10, 'Harbinger', 15, 10),
				1 => new Ship(4, 1, 9, 5, 5, 'Blight', 10, 15),
				2 => new Ship(1, 4, 2, 12, 4, 'Smite', 9, 15),
				3 => new Ship(1, 2, 12, 14, 3, 'Lightning', 10, 20),
				4 => new Ship(2, 6, 16, 7, 6, 'Lion', 12, 12),
				5 => new Ship(2, 8, 5, 18, 7, 'Tiger', 8, 11)
			);
			foreach ($pieces as $key => $value) {
				$this->_player1->addPiece($key, $value);
			}
			$pieces = array(
				0 => new Ship(4, 10, 144, 95, 10, 'Harrow', 15, 10),
				1 => new Ship(4, 1, 141, 95, 5, 'Slip', 10, 15),
				2 => new Ship(1, 4, 143, 88, 4, 'Dip', 9, 15),
				3 => new Ship(1, 2, 138, 86, 3, 'Echo', 10, 20),
				4 => new Ship(2, 6, 134, 93, 6, 'Early development', 12, 12),
				5 => new Ship(2, 8, 145, 82, 7, 'End', 8, 11)
			);
			foreach ($pieces as $key => $value) {
				$this->_player2->addPiece($key, $value);
			}
			$pieces = array(
				-1 => new Obstruction(20, 20, 75, 50, 10),
				-2 => new Obstruction(10, 10, 130, 40, 5),
				-3 => new Obstruction(15, 15, 60, 20, 4),
				-4 => new Obstruction(10, 20, 100, 80, 3),
				-5 => new Obstruction(14, 16, 30, 70, 6),
				-6 => new Obstruction(5, 8, 15, 42, 7)
			);
			foreach ($pieces as $key => $value) {
				$this->_obstructions->addPiece($key, $value);
			}
			if (Board::$verbose)
				echo "instance of board constructed";
		}

		function __toString() {
			return 'Turn: '.$this->_turn.' Ship'.$this->_currentShip.' Phase:'.$this->_phase;
		}

		public function __invoke() {
			for ($i = 0; $i < (150 * 100); $i++) {
				if ($this->_phase == Board::PHASE3)
					echo "<div";
				else
					echo '<button';
				echo ' class="box" type="submit" name="gridpos" value="'.($i % 150).' '.(int)($i / 150).'"
					style="';
				if ($this->getShip()->canMove(($i % 150), (int)($i / 150)) && $this->_phase == Board::PHASE2)
					echo "background-color: green;";
				if ($this->_phase == Board::PHASE3)
					echo '"></div>';
				else
					echo '"></button>';
			}
			if ($this->_phase == 2)
			{
				if ($this->_turn == 1){
					$this->_player1->printPassive( array('ship' => $this->_currentShip, 'high' => $this->_turn == 1 ? 1 : 0) );
					$this->_player2->printActive( array('ship' => $this->_currentShip, 'high' => $this->_turn == 2 ? 1 : 0) );
				}
				else {
					$this->_player1->printActive( array('ship' => $this->_currentShip, 'high' => $this->_turn == 1 ? 1 : 0) );
					$this->_player2->printPassive( array('ship' => $this->_currentShip, 'high' => $this->_turn == 2 ? 1 : 0) );
				}
				$this->_obstructions->printActive( array('ship' => $this->_currentShip, 'turn' => $this->_turn) );
			}
			else {
				$this->_player1->printPassive( array('ship' => $this->_currentShip, 'high' => $this->_turn == 1 ? 1 : 0) );
				$this->_player2->printPassive( array('ship' => $this->_currentShip, 'high' => $this->_turn == 2 ? 1 : 0) );
				$this->_obstructions->printPassive( array('ship' => $this->_currentShip, 'turn' => $this->_turn) );
			}
		}

		public function __destruct() {
			if (Board::$verbose)
				echo "instance of board destructed";
		}

		public function getTurn() {
			return $this->_turn;
		}

		public function nextTurn() {
			$this->_currentShip = 0;
			$this->_phase = 0;
			$this->_turn = ($this->_turn == 1 ? 2 : 1);
		}

		public function getShip() {
			if ($this->_turn == 1)
				return $this->_player1->getShip($this->_currentShip);
			else
				return $this->_player2->getShip($this->_currentShip);
		}

		public function nextShip() {
			if ($this->_phase == Board::PHASE1)
				$this->getShip()->allocPP($_POST['shields'], $_POST['movement'], $_POST['weapons']);
			$this->_currentShip++;
			if (!$this->getShip())
				$this->nextPhase();
		}

		public function getPhase() {
			return $this->_phase;
		}

		public function getStrPhase() {
			switch ($this->_phase)
			{
				case 0:
					return 'Order';
					break;
				case 1:
					return 'Movement';
					break;
				case 2:
					return 'Attack';
					break;
			}
		}

		public function nextPhase() {
			$this->_currentShip = 0;
			$this->_phase++;
			if ($this->getPhase() > Board::PHASE3)
				$this->nextTurn();
		}

		public function moveShip($x, $y) {
			$this->_pieces[$this->_currentShip] = $this->getShip()->move($x, $y);
		}

		public function attack($target) {
			$hit = 0;
			for ($i = 0; $i < ($this->getShip()->getWeapon()); $i++)
			{
				if (mt_rand(1, 6) > 3)
					$hit = 1;
			}
			if ($hit == 0)
			{
				$_SESSION['errstr']['attack'] = 'miss';
				return;
			}
			else
			{
				if ($target < 0)
					$this->_obstructions->hit($target);
				else
				{
					if ($this->_turn == 1)
						$this->_player2->hit($target);
					else
						$this->_player1->hit($target);
				}
				$_SESSION['errstr']['attack'] = 'hit';
			}
			$this->nextShip();
		}

	}

?>