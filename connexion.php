<?php

    echo'<p style="color:red">hello page connexion.php ce message c\'est pour confirmer le include de connexion.php </p>';

    //connection bdd // inclure vos elements de connexion
		$nameHote = 'localhost'; // a remplir
		$nameBdd = 'reunion_island'; // a remplir
		$login= 'root'; //a remplir
		$mDP = 'mot de passe'; //a remplir

		try//test la validite de la connexion
		{
			$bdd = new PDO('mysql:host=' . $nameHote . ';dbname=' . $nameBdd . ';charset=utf8', $login, $mDP);
		}
		catch(Exception $e)//return msg erreur si erreur connexion 
		{
			die('Erreur : ' . $e->getMessage());
		}	
?>