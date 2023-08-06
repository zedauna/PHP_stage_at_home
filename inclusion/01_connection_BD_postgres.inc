<?php
	//Renvoie True si la connexion réussit, False sinon
	function connexion($BD,$user,$pass)
		{
		$local = new PDO('pgsql:host=localhost;port=5432;dbname='.$BD,$user,$pass);
		return $local;
		}
	function deconnexion($local)
		{
		$local->connection = null; } ?>
