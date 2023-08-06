
	<?php
		include('../inclusion/02_connection_BD_postgres.inc');
		$db = connexion();
	
		$theme = $_POST['zs_theme'];
		
		$theme=pg_escape_string($theme);

	
		$sql="insert into t_theme (nom_theme) values('".$theme."')";
		
		$sth = $db->prepare($sql);
		$sth->execute();
		
		header('Location: ./02_ajout_theme.php');
	?>
