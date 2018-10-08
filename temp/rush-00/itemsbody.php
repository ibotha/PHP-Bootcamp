<form method="post" action="#" style="margin: auto; margin-top: 40px;">
	<h3>New Item:</h3>
	Name: <input name="name">
	Price: <input name="price">
	Categories: <input name="categories">
	Image: <input name="imgurl">
	Stock: <input name="stock">
	<button type="submit" name="action" value="add">Add</button>
</form>
<div id="readout">
	<h3>Items:</h3>
	<?php
		foreach ($items as $name => $value)
		{
			echo '<form method="post" action="#">
					<img class="ico" src='.$value["imgurl"].'>'.
					'Name: <input class="readoutelem" name="name" value="'.$name.'">
					<input style="display: none;" name="og" value="'.$name.'">
					Price: <input class="readoutelem" name="price" value="'.$value["price"].'">
					Categories: <input class="readoutelem" name="categories" value="';
					foreach ($value["categories"] as $cat)
						echo "$cat ";
					echo	'">
					Image: <input class="readoutelem" name="imgurl" value="'.$value["imgurl"].'">
					Stock: <input class="readoutelem" name="stock" value="'.$value["stock"].'">
					<button class="readoutelem" type="submit" name="action" value="add">Modify</button>
					<button class="readoutelem" type="submit" name="action" value="del">del</button>
				</form>';
		}
	?>
</div>
<div id="RightBar">
	<?php
	foreach ($cats as $cat)
		echo '<button class="SideBarItem" name="category" value="'.$cat.'">'.$cat.'</button>'
	?>
</form>