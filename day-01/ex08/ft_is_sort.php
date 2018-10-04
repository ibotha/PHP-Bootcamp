#!/usr/bin/php
<?PHP
function ft_is_sort($tab)
{
	$og = $tab;
	sort($tab);
	return $og == $tab;
}
?>