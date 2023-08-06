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
	<!--Auteur -->
	<?php
	#####################################################################
		#Reception des données 
		$num_acteur=$_POST["zl_acteur"];
		
		#Connexion à la base de donnée
		include('./inclusion/02_connection_BD_postgres.inc');
		$db = connexion();

		#Requete Query
		if ($num_acteur!=0) 
		{
			$sql="SELECT nom_auteur,prenom_auteur FROM t_auteur WHERE num_auteur=".$num_acteur;
			#lecture
			$sth = $db->prepare($sql);
			$sth->execute();
			$result = $sth->fetchAll();

			foreach($result as $valeur)
				echo "<h3> liste des images de l'auteur : ".$valeur["nom_auteur"]." ".$valeur["prenom_auteur"]."</h3>";
		}
		else
		{
			echo "<h3>liste des images de tous les auteurs</h3>";
		}
	?>

	<!--thème -->
	<?php
	#####################################################################
		#Reception des données 
		$num_acteur=$_POST["zl_acteur"];
		$num_theme=$_POST["zl_theme"];

		#Requete Query
		if ($num_theme!=0) 
		{
			$sql="SELECT nom_theme FROM t_theme WHERE num_theme=".$num_theme;
			#lecture 
			$sth = $db->prepare($sql);
			$sth->execute();
			$result = $sth->fetchAll();

			foreach($result as $valeur)
				echo "<h3> liste des images du thème : ".$valeur["nom_theme"]."</h3>";
		}
		else
		{
			echo "<h3>liste des images de tous les thèmes</h3>";
		}
	?>

<!--tableau sans couleur -->

	<?php
#####################################################################
	#Reception des données 
	$num_acteur=$_POST["zl_acteur"];
	$num_theme=$_POST["zl_theme"];

	#Requete Query
	if ($num_acteur!=0 && $num_theme!=0) 
	{
		 $sql="select t_image.num_image, date_mel, nom_fichier, nom_auteur, prenom_auteur , nom_theme
 					  from t_image, t_auteur, t_theme, t_correspondre
					  where t_image.num_auteur = t_auteur.num_auteur
					  and t_image.num_image=t_correspondre.num_image
					  and t_theme.num_theme=t_correspondre.num_theme
					  and t_theme.num_theme=".$num_theme."
					  and t_auteur.num_auteur=".$num_acteur."
					  order by date_mel desc";
	} 
	elseif ($num_acteur==0 && $num_theme!=0) 
	{
		$sql="select t_image.num_image, date_mel, nom_fichier, nom_auteur, prenom_auteur , nom_theme
 					  from t_image, t_auteur, t_theme, t_correspondre
					  where t_image.num_auteur = t_auteur.num_auteur
					  and t_image.num_image=t_correspondre.num_image
					  and t_theme.num_theme=t_correspondre.num_theme
					  and t_theme.num_theme=".$num_theme."
					  order by date_mel desc";
	}
	elseif ($num_acteur!=0 && $num_theme==0) 
	{
		$sql="select t_image.num_image, date_mel, nom_fichier, nom_auteur, prenom_auteur , nom_theme
 					  from t_image, t_auteur, t_theme, t_correspondre
					  where t_image.num_auteur = t_auteur.num_auteur
					  and t_image.num_image=t_correspondre.num_image
					  and t_theme.num_theme=t_correspondre.num_theme
					  and t_auteur.num_auteur=".$num_acteur."
					  order by date_mel desc";
	}
	else
	{
		$sql="select t_image.num_image, date_mel, nom_fichier, nom_auteur, prenom_auteur , nom_theme
 					  from t_image, t_auteur, t_theme, t_correspondre
					  where t_image.num_auteur = t_auteur.num_auteur
					  and t_image.num_image=t_correspondre.num_image
					  and t_theme.num_theme=t_correspondre.num_theme
					  order by date_mel desc";
	}
	

	#lecture 
		$sth = $db->prepare($sql);
		$sth->execute();

		echo "Tableau sans couleur <br/>";
		echo "<table border='5'>";
		echo "<tr bgColor='yellow'>
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
      echo "<br/><br/>"

	?>

<!--tableau avec couleur formule 1 -->
	<?php
#####################################################################

	#lecture 
		$sth = $db->prepare($sql);
		$sth->execute();
		echo "Tableau avec couleur formule 2 <br/>";
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
        		<td>".$result["nom_fichier"]."</td>
          		<td>".$result["date_mel"]."</td>
          		<td>".$result["nom_auteur"]."</td>
          		<td>".$result["prenom_auteur"]."</td>
          		<td>".$result["nom_theme"]."</td>
          	</tr>";
      }
      echo "</table>";
      echo "<br/><br/>";
	?>


	<!--tableau  avec couleur et image formule 3 -->
	<?php
	#####################################################################

	#lecture 
		$sth = $db->prepare($sql);
		$sth->execute();
		echo "Tableau avec couleur et images Formule 3 <br/>";
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

	 while ($result = $sth->fetch())
      {

	      	if ($compteur%3==0)
	       	 	$couleur="green";
	      	elseif ($compteur%3==1)
	        	$couleur="lightblue";
	        else
	        	$couleur="cyan";
      	$compteur++;
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

      deconnexion($bd);

	?>

	

</body>
</html>