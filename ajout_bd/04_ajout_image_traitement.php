
	<?php
		include('../inclusion/02_connection_BD_postgres.inc');
		$db = connexion();
	
		$fic = pg_escape_string($_POST['zs_fic']);
		$aut = $_POST['zl_auteur'];
		$d=date('Y-m-d', time());

	

		$sql="insert into t_image (date_mel, nom_fichier, num_auteur)
            values('".$d."', '".$fic."', ".$aut.")";

      
		$sth = $db->prepare($sql);
		$sth->execute();

		header('Location: ./04_ajout_image.php');
		
	?>
