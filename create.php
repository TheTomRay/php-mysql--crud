<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basic.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="create.php" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name"required>
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="number" name="distance" required>
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" required>
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="number" name="height_difference"required>
		</div>
		<button type="submit" name="button" action="create.php">Envoyer</button>
	</form>

	<!-- code php creation pour creer les donnees dans BDD -->
	<?php
	//inclure fichier 
	include 'connexion.php';
		
		
		// recuperer POST 
		//si le tableau avec données existe
		if(array_key_exists("name",$_POST) && array_key_exists("difficulty",$_POST) && array_key_exists("distance",$_POST) && array_key_exists("duration",$_POST) && array_key_exists("height_difference",$_POST))
		{

			//verifier données avant injecter FILTRER https://openclassrooms.com/fr/courses/1269536-les-filtres-en-php-pour-valider-les-donnees-utilisateur
			// different filtre https://www.w3schools.com/php/filter_sanitize_string.asp
					
			$nom = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING); //verifie et return que le format string et delete les balise HTML
			$difficulty = filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_STRING); 
			$distance = filter_input(INPUT_POST, 'distance', FILTER_VALIDATE_INT);//verifier que c'est format int et return la val
			$duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_STRING);
			$heightDifference = filter_input(INPUT_POST, 'height_difference', FILTER_VALIDATE_INT);

			if($nom!== false && $difficulty!== false && $distance!== false && $duration!== false && $heightDifference!== false)// si les données sont valide 
			{
				echo "je recupere les données " . $nom . " " .$difficulty . " " .$distance . " " . $duration . " " . $heightDifference;
				//communiquer avec MySQL "query" recuperer les donnees dasn tableaux => $reponse = $bdd->query('Tapez votre requête SQL ici');
				
				/*requete pour inserer données INSERT

				INSERT INTO `hiking` (`id`, `name`, `difficulty`, `distance`, `duration`, `height_difference`) VALUES (NULL, 'Les toboggans de Fleurs Jaunes et le Bassin Roche par le Bras Rouge', 'difficile', '6100', '02:15:00', '450');*/

				//ajouter une entree dans la table 2eme methode

				$req = $bdd->prepare('INSERT INTO hiking(name, difficulty, distance, duration, height_difference) VALUES(:name, :difficulty, :distance, :duration, :height_difference)');
				$req->execute(array(
					'name' => $nom,
					'difficulty' => $difficulty,
					'distance' => $distance,
					'duration' => $duration,
					'height_difference' => $heightDifference
					));

				echo '<p style="color:blue">La randonnée a été ajoutée avec succès.</p>';
				$req->closeCursor(); // Termine le traitement de la requête
			}
		
	}

	?>

</body>
</html>
