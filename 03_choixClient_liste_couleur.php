<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>templates</title>
	<meta name="author" content="Jéros" />
	<!-- Date: 2019-10-31 -->
</head>
<body>
	<form name="frm" method="post" action="11_resultat_formulaire_couleur.php">
		<!-- champs selection  sur le thème-->
		Nom_Thème : <select name="zl_theme">		
			<?php
	#Connexion à la base de donnée
			include('./inclusion/02_connection_BD_postgres.inc');
			$db = connexion();
	#Requete et lecture
			$sql = "SELECT num_theme,nom_theme FROM t_theme ORDER BY nom_theme";
			$sth = $db->prepare($sql);
			$sth->execute();
			while($result = $sth->fetch())
			{

				echo"<option value='".$result["num_theme"]."'>".$result["nom_theme"]."</option>";
			}
			
			?>
		</select><br /><br />

		<!-- champs selection  sur auteur-->
		Nom_Auteur : <select name="zl_acteur">
			<?php
				$sql = "SELECT num_auteur,nom_auteur, prenom_auteur FROM t_auteur ORDER BY nom_auteur";
				$sth = $db->prepare($sql);
				$sth->execute();

				while($result = $sth->fetch())
				{

					echo"<option value='".$result["num_auteur"]."'>".$result["nom_auteur"]." ".$result["prenom_auteur"]."</option>";
				}
				deconnexion($bd);
			?>
			</select><br /><br />



		<input type="submit" value="Valider" />

 		

	</form>
</body>
</html>



