<?php
	function connect()
	{
		$idc = pg_connect('host=localhost user=postgres password=postgres dbname=bd_images');
		return($idc);
	}
	function connect2()
	{
		$idc = pg_connect('host=localhost user=postgres password=postgres dbname=bd_notes');
		return($idc);
	}
?>