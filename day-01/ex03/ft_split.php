#!/usr/bin/php
<?php

	function ft_split($str)
	{
		$retarray = preg_split('/ +/', $str);
		sort($retarray);
		$ret = [];
		foreach ($retarray as $elem)
		{
			if ($elem)
				array_push($ret, $elem);
		}
		return $ret;
	}

?>