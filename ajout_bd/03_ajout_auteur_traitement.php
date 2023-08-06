
	<?php
		include('../inclusion/02_connection_BD_postgres.inc');
		$db = connexion();
	
		$nom = pg_escape_string($_POST['zs_nom']);
		$prenom = pg_escape_string($_POST['zs_prenom']);
		$login = pg_escape_string($_POST['zs_login']);
		$mdp = pg_escape_string($_POST['zs_mdp']);

		$mdp=md5($mdp);

		$sql="insert into t_auteur (nom_auteur, prenom_auteur, login, mdp)
          values('".$nom."','".$prenom."','".$login."','".$mdp."')";

        
		
		$sth = $db->prepare($sql);
		$sth->execute();

		header('Location: ./03_ajout_auteur.php');
		
	?>
