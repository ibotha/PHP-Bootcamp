<h3 style="text-align: center; margin-top: 40px;">All Items</h3>
<h3 style="text-align: center; margin-top: 40px;"><?php echo $errstr ?></h3>
<div id="list">
	<?php
		foreach ($_SESSION["cart"] as $name => $content)
		{
			echo '<form method="post" action="#" class="article">
					<img class="display" src='.$content["imgurl"].'>
					<div class="discription"><div class="desc">'.$name.'</div>
					<div class="price">'.$content["price"].'</div>
					<div class="price">Amount: '.$content["stock"].'</div>
					<div class="categories"><ul>';
			foreach ($content["categories"] as $cat)
				{
					if ($i < 4)
						echo "<li>$cat</li>";
					$i++;
				}
				echo	'</ul></div>
						<div class="buy">
							<input style="display: none;" name=item value="'.$name.'">
							<div>Amount: <input name=quantity style="width: 40px;" value="'."0".'"></div>
						<button class="readoutelem" type="submit" name="action" value="remove">Remove</button>
						</div>
					</div>
				</form>';
		}
	?>
</div>
<form method="post" action="#" style="margin: auto;">
	<button class="adminbutton" type="submit" name="action" value="checkout">Checkout</button>
</form>