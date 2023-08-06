
	<?php
		include('../inclusion/03_pg_connection.inc');
		$db = connect();
		// récupération des données
		$fic = pg_escape_string($_POST['zs_fic']);
		$aut = $_POST['zl_auteur'];
		$d=date('Y-m-d', time());

		// enregistrement dans la table t_image
		$sql="insert into t_image (date_mel, nom_fichier, num_auteur)
            values('".$d."', '".$fic."', ".$aut.")";
		$sth = $db->pg_prepare($sql);
		$sth->pg_execute();


		// récupération du numéro d'image
		$oid = pg_last_oid($sth);
		$sql="select num_image from t_image where oid=".$oid;
		$sth = $db->pg_prepare($sql);
		$sth->pg_execute();

		$result = $sth->fetchAll();

		$num_image=$result['num_image'];
	
		// enregistrement dans la table t_correspondre
		foreach($_POST as $index=>$valeur)
		{
			$t=explode('_',$index);
			if($t[0]=='cc')
			{
				$num_theme=$t[1];
				$sql='insert into t_correspondre (num_image, num_theme)
				      values('.$num_image.','.$num_theme.')';
				print($sql.'<br />');
				$sth = $db->pg_prepare($sql);
				$sth->pg_execute();

				
			}
		}

		//$temp = $sth->fetch(PDO::FETCH_ASSOC);
		//header('Location: ./04_ajout_image.php');
		
	?>
