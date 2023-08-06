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
	<form name="frm" method="post">
		<!-- champs deroulant -->
		Thème : <select name="zl_theme" ><br />
			<?php

				#Connexion à la base de donnée
				include('./inclusion/02_connection_BD_postgres.php');
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
		</select><br /> 

		<input type="submit" value="Valider" />
	</form>

	<?php
		#Reception des données 
		$num_theme=$_POST["zl_theme"];
		
		#Query Theme
		$sql="select nom_theme FROM t_theme WHERE num_theme=".$num_theme;
		$sth = $db->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll();
		foreach($result as $valeur)
			echo "<h3> liste des images du thème : ".$valeur["nom_theme"]."</h3>";


		#query tableau
		 $sql="select t_image.num_image, date_mel, nom_fichier, nom_auteur, prenom_auteur , nom_theme
 					  from t_image, t_auteur, t_theme, t_correspondre
					  where t_image.num_auteur = t_auteur.num_auteur
					  and t_image.num_image=t_correspondre.num_image
					  and t_theme.num_theme=t_correspondre.num_theme
					  and t_theme.num_theme=".$num_theme."
					  order by date_mel desc";


		#lecture 
		$sth = $db->prepare($sql);
		$sth->execute();
		echo "<table border='5'>";
		echo "<tr bgColor='yellow'>
			<td>num_image</td>
			<td>nom_fichier</td>
			<td>date_mel</td>
        	<td>nom_auteur</td>
        	<td>prenom_auteur</td>
        	<td>nom_theme</td>
        	</tr>";

        	$compteur=0;
        	$tabCouleur=array('green','cyan','lightblue');

			 while ($result = $sth->fetch())
		      {
		      	$compteur++;
		      	$reste=$compteur%count($tabCouleur);
		      	$couleur=$tabCouleur[$reste];
		        echo "<tr bgColor='".$couleur."'>
		        		<td>".$result["num_image"]."</td>
		        		<td><img src=../_BD_Tp2/images/".$result["nom_fichier"]." width='40px'/></td>
		          		<td>".$result["date_mel"]."</td>
		          		<td>".$result["nom_auteur"]."</td>
		          		<td>".$result["prenom_auteur"]."</td>
		          		<td>".$result["nom_theme"]."</td>
		          	</tr>";
		      }
      	echo "</table>";
      	##deconnexion($bd);
	?>

</body>
</html>
