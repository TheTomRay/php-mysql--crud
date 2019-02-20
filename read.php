<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basic.css" >
  </head>
  <body>
  <?php
	//inclure fichier 
  include 'connexion.php';
  ?>
    <h1>Liste des randonnées</h1>
    <table class="tableCreate">
      <thead>
        <tr class="title">
          <th>Nom</th>
          <th>Difficultés</th>
          <th>Distance</th>
          <th>Durée</th>
          <th>Dénivelé</th>
          <th colspan="2">options</th>
        </tr>
      </thead>
      <tbody>
      <!-- Afficher la liste des randonnées -->
      <?php
              // On récupère tout le contenu de la table hiking
        $reponse = $bdd->query('SELECT * FROM hiking');

              // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch())
        {
      ?>
        <tr>
          <td> <?php echo $donnees['name']?> </td>
          <td> <?php echo $donnees['difficulty']?> </td>
          <td> <?php echo $donnees['distance']?> </td>
          <td> <?php echo $donnees['duration']?> </td>
          <td> <?php echo $donnees['height_difference']?> </td>
          <form method="post" action="read.php" name="form1"><!-- formulaire supprimer -->
            <td  class="hidden"><input readonly="readonly" name="idSupp" value="<?php echo $donnees['id']?>"></td>
            <td>
              <input action="" type="submit" class="buttons" value="Supprimer">
            </td>
          </form>
          <form method="post" action="update.php" name="form2"><!-- formulaire mofier -->
            <td  class="hidden">
              <input  type="text" name="idModif" value="<?php echo $donnees['id']?>"/>
            </td>
            <td><input name="button" type="submit" class="buttons" action="update.php" value="Modifier"></td>
            </td>
          </form>          
        </tr>
      <?php
        }
        $reponse->closeCursor(); // Termine le traitement de la requête

                    //DELETE ligne                    
        if(array_key_exists('idSupp',$_POST))
        { //supprimer un element de la table
          $idSup= $_POST['idSupp'];
          //requete
          $bdd->exec('DELETE FROM hiking WHERE id=' .$idSup);
          echo '<p style="color:blue">La randonnée a été supprimer avec succès.</p>';
        }
      ?>
      </tbody>          
    </table>
  </div>
  </body>  
</html>
