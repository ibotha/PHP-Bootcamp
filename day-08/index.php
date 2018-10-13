<?php
	require_once "Board.class.php";
	session_start();
	$_SESSION['errstr'] = array();
	if (!isset($_SESSION['board']) || $_POST['reset'] == 'OK')
		$_SESSION['board'] = new Board();
	if ($_POST['endturn'] == 'OK')
		$_SESSION['board']->nextTurn();
	if ($_POST['nextship'] == 'OK')
		$_SESSION['board']->nextShip();
	if ($_POST['move'] == 'OK')
		$_SESSION['board']->moveShip(explode(' ', $_GET['gridpos'])[0], explode(' ', $_GET['gridpos'])[1]);
	if ($_POST['attack'] == 'OK')
		$_SESSION['board']->attack($_GET['target']);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>WARHAMMER</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="index.css" />
</head>
<body>
	<form class="board" method="get" action="#">
	<?php
		$_SESSION['board']();
	?>
	</form>
	<form class="actionbar" method="post" action="#">
		<div style="margin-right: 20px; border-right: 1px solid black;"><?php echo '<H1>Player: '.$_SESSION['board']->getTurn().'</H1>
			<H4>Phase: '.$_SESSION['board']->getStrPhase().'</H4>';print_r($_SESSION['errstr']);?></div>
		<div style="margin-right: 20px; border-right: 1px solid black;">
			<?php
				echo '<H1>'.$_SESSION['board']->getShip()->getName().
					'</H1> health:'.$_SESSION['board']->getShip()->__get('_health').
					'</br> PP:'.$_SESSION['board']->getShip()->getPP().
					'</br> Shield:'.$_SESSION['board']->getShip()->getShield().
					'</br> Movement:'.$_SESSION['board']->getShip()->getMovement().
					'</br> Weapon:'.$_SESSION['board']->getShip()->getWeapon();
			?>
		</div>
		<div style="margin-right: 20px; border-right: 1px solid black;">
		<?php
			switch ($_SESSION['board']->getPhase())
			{
				case 0:?>
				Shields: <input type="number" name="shields" min="0" value="0"><br>
				Movement: <input type="number" name="movement" min="0" value="0"><br>
				Weapons: <input type="number" name="weapons" min="0" value="0"><br>
				<?php break;
				case 1:?>
				<button type="submit" name="move" value="OK">Move</button>
				<?php break;
				case 2:?>
				Nuke: <button type="submit" name="attack" value="OK">Attack</button>
				<?php break;
			} ?>
		</div>
		<div style="margin-right: 20px; border-right: 1px solid black;">
			<button type="submit" name="nextship" value="OK">next Ship</button><br>
			<button type="submit" name="endturn" value="OK">End turn</button><br>
			<button type="submit" name="reset" value="OK">Reset</button><br>
		</div>
	</form>
</body>
</html>