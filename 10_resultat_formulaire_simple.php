<!DOCTYPE html >

<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>templates</title>
	<meta name="author" content="Jéros" />
	<!-- Date: 2019-10-31 -->
</head>
<body>
	<h1> Liste des noms</h1>
	<?php

	#Reception des données
	$num_acteur=$_POST["zl_acteur"];
	$num_theme=$_POST["zl_theme"];

	# Déclaration des variables
	$BD='bd_images';
	$USER='postgres';
	$PASS='postgres';

	#Connexion BD
	$db = new PDO('pgsql:host=localhost;dbname='.$BD,$USER ,$PASS ) or die("Problème de connexion !");

	#Requete Query
	 $sql="select t_image.num_image, date_mel, nom_fichier, nom_auteur, prenom_auteur , nom_theme
	 from t_image, t_auteur, t_theme, t_correspondre
					  where t_image.num_auteur = t_auteur.num_auteur
					  and t_image.num_image=t_correspondre.num_image
					  and t_theme.num_theme=t_correspondre.num_theme
					  and t_theme.num_theme=".$num_theme."
					  and t_auteur.num_auteur=".$num_acteur."
					  order by date_mel desc";

	#lecture 2
		$sth = $db->prepare($sql);
		$sth->execute();
		echo "<table border='5'>";
		echo "<tr>
			<td>num_image</td>
			<td>nom_fichier</td>
			<td>date_mel</td>
        	<td>nom_auteur</td>
        	<td>prenom_auteur</td>
        	<td>nom_theme</td>
        	</tr>";

	 while ($result = $sth->fetch())
      {
        echo "<tr>
        		<td>".$result["num_image"]."</td>
        		<td>".$result["nom_fichier"]."</td>
          		<td>".$result["date_mel"]."</td>
          		<td>".$result["nom_auteur"]."</td>
          		<td>".$result["prenom_auteur"]."</td>
          		<td>".$result["nom_theme"]."</td>
          	</tr>";
      }
      echo "</table>";

	?>

	

</body>
</html>