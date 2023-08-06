<?php
	//Renvoie True si la connexion réussit, False sinon
	function connexion(){
	$local = new PDO('pgsql:host=localhost;port=5432;dbname=bd_images','postgres','postgres');
		return $local;};
		
	function deconnexion($local){
		$local->connection = null; } ?>
