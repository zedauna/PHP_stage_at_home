<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Saisir BD</title>
	<meta name="author" content="Jéros" />
</head>
<body>

	<form name="frm" method="post" action="05_ajout_image_complexe_traitement.php">
		Nom de fichier <input type="text" name="zs_fic" /><br /><br />
		Auteur <select name="zl_auteur"><br />
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

		<h2>Choissiez les thèmes associés</h2>
		<?php

		$sql='select num_theme, nom_theme from t_theme order by nom_theme';
		$sth = $db->prepare($sql);
		$sth->execute();

		while($result = $sth->fetch())
		{
			echo "<input type='checkbox' name='cc_".$result['num_theme']."' value='".$result['num_theme']."'> ".$result['nom_theme']."<br/>";
		}
		
		?>
		
		<input type="submit" value="Valider" />
		
	</form>

</body>
</html>