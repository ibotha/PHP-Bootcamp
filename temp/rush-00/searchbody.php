<link rel="stylesheet" href="landing.css">
<h3 style="text-align: center; margin-top: 40px;">Browse</h3>
<div id="list">
	<?php
		foreach ($found as $name => $content)
		{
			$i = 0;
			echo '<form method="post" action="#" class="article">
					<img class="display" src='.$content["imgurl"].'>
					<div class="discription">
						<div class="desc">'.$name.'</div>
						<div class="price">'.$content["price"].'</div>
						<div class="stock">In Stock: '.$content["stock"].'</div>
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
							<button class="addtocart" type="submit" name="action" value="addtocart">Add to cart</button>
						</div>
					</div>
				</form>';
		}
	?>
</div>
<form method="get" action="#" id="RightBar">
	<?php foreach ($cats as $cat)
		echo '<button type="submit" class="SideBarItem" name="category" value="'.$cat.'">'.$cat.'</button>'
	?>
</form>