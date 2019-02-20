<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basic.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<?php
		//inclure fichier 
  		include 'connexion.php';
  	?>
	                  <!-- FORMULAIRE UPDATE -->
	<div  class="formulModif">
		<div class="titleMofi">Randonnées à modifier</div>
		<form action="update.php" method="post" name="formModif"> <!--  affiche les elements a modifier -->
			<div> 
			<?php //**********************PHP *****************************************
				//recuperer le ID du post modif et afficher ID
				if(array_key_exists('idModif',$_POST))
				{
								$idModif = ($_POST['idModif']);
								//	echo $idModif;
							// On récupère tout le contenu de la table hiking pour l'ID à madifier et on affiche
							$reponse = $bdd->query('SELECT * FROM hiking WHERE id= '. $idModif);
							//mettre dans un tableau tout les données, le parcourir, le vider et recuperer les données
							
							while($donnees = $reponse->fetch())
							{
								$id = $donnees["id"];
								$name = $donnees["name"];
								$difficulty = $donnees["difficulty"];
								$distance = $donnees["distance"];
								$duree = $donnees["duration"];
								$denivele = $donnees["height_difference"];
						?>
						<label for="name">Name</label>
						<input type="text" name="name" required size = "50" value="<?php echo $name ?>">
						</div>
						<div>
						<label for="difficulty">Difficulté</label>
						<select name="difficulty">
							<option value="très facile" >Très facile</option>
							<option value="facile">Facile</option>
							<option value="moyen" selected>Moyen</option>
							<option value="difficile">Difficile</option>
							<option value="très difficile">Très difficile</option>
						</select>
						</div>
						
						<div>
						<label for="distance">Distance</label>
						<input type="number" name="distance" required value="<?php echo $distance ?>">
						</div>
						<div>
						<label for="duration">Durée</label>
						<input type="time" name="duration" required value="<?php echo $duree ?>">
						</div>
						<div>
						<label for="height_difference">Dénivelé</label>
						<input type="number" name="height_difference"required value="<?php echo $denivele ?>">
						</div>
						<input style="display:none" readonly="readonly" name="id" value="<?php echo $id ?>">
						<button type="submit" name="button" action="">Envoyer</button>
					</form>
						<?php
							}

				$reponse->closeCursor(); // Termine le traitement de la requête 

				}//END  modif et afficher ID
				
				
				//UPDATE les éléments
				
				
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
					$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

					echo $id;
					if($nom!== false && $difficulty!== false && $distance!== false && $duration!== false && $heightDifference!== false)// si les données sont valide 
					{
						echo "je recupere les données " . $nom . " " .$difficulty . " " .$distance . " " . $duration . " " . $heightDifference;
						//communiquer avec MySQL "UPDATE" modifier les donnees dans tableaux 
						
						$bdd->exec('UPDATE hiking SET name = "' . $nom .'", difficulty = "' . $difficulty . '", distance = '. $distance .', height_difference = ' . $heightDifference .' WHERE id ='. $id);// requete UPDATE
					
						echo '<p style="color:blue">La randonnée a été modifié avec succès.</p>';
						//$reponse->closeCursor(); // Termine le traitement de la requête
					}
				}// END UPDATE les éléments
				
			?>
	</div>
</body>
</html>
