<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Saisir BD</title>
	<meta name="author" content="Jéros" />
</head>
<body>

	<form name="frm" method="post" action="04_ajout_image_traitement.php">
		Nom de fichier <input type="text" name="zs_fic" /><br />
		Auteur <select name="zl_auteur">
		<?php
			include('../inclusion/02_connection_BD_postgres.inc');
			$db = connexion();
			$sql='select num_auteur, nom_auteur, prenom_auteur from t_auteur order by nom_auteur';
			$sth = $db->prepare($sql);
			$sth->execute();

			while($result = $sth->fetch())
			{
				print('<option value="'.$result['num_auteur'].'">'.$result['nom_auteur'].' '.$result['prenom_auteur'].'</option>');
			}
		?>		
		
	</select><br />
	
		<input type="submit" value="Valider" />
		
	</form>

</body>
</html>