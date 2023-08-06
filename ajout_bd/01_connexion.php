<?php
	if(session_id()=='')
		session_start();

	include('../inclusion/02_connection_BD_postgres.inc');
	$db = connexion();
	
	$login=pg_escape_string($_POST['zs_login']);
	$mdp=pg_escape_string($_POST['zs_mdp']);
	
	$mdp=md5($mdp);
	
	$sql="select num_auteur, login, mdp from t_auteur where login=".$login." and mdp=".$mdp;

	$sth = $db->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll();

	if($result['login']==$login && $result['mdp']==$mdp)
	{
		print('OK');
		$_SESSION['num_auteur']=$result['num_auteur'];
	}
	else {
		print('Utilisateur inconuu');
	}


?>