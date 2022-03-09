<!doctype html>
<html>
<head>
	<title>Système de pagination simple en PHP</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<style>
		.input-group {
			margin: 10px 0px 10px 0px;
		}
		.input-group label {
			
			margin: 3px;
		}
		.input-group input {
			height: 30px;
			width: 150px;
			padding: 5px 10px;
			font-size: 16px;
			border-radius: 5px;
			border: 1px solid gray;
		}
		.btn {
			padding: 10px;
			font-size: 15px;
			color: white;
			background: #5F9EA0;
			border: none;
			border-radius: 5px;
		}
		.card {
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
			
			padding:auto;
			
		}

		.card:hover {
		    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			
		}

		.container {
		    padding: 2px 16px;
		}
</style>
	</style>
	
</head>
<body style="text-align:center">



	<h2>Pagination simple en PHP</h2>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, et odio cum accusamus expedita eligendi! Explicabo, ratione? Quis, inventore? Voluptatum minima nemo eius praesentium consectetur aliquid unde quia fugit quos.
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, et odio cum accusamus expedita eligendi! Explicabo, ratione? Quis, inventore? Voluptatum minima nemo eius praesentium consectetur aliquid unde quia fugit quos.
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, et odio cum accusamus expedita eligendi! Explicabo, ratione? Quis, inventore? Voluptatum minima nemo eius praesentium consectetur aliquid unde quia fugit quos.
	</p>
    <?php
	// Importer le fichier de la base de données 
	require_once 'db.php'; 
	// Chercher le nombre de commentaires : 
	$sql = "SELECT count(id) as nb FROM commentaire";
	// Exécuter la requête 
	$resultat=dbQuery($sql);
	// Chercher les associations 
	$row = dbFetchAssoc($resultat);
	// Recupérer le nombre de commentaire dans la variable $nb_commentaire
	$nb_commentaire = $row["nb"];
	
    // Le nombre de commentaire par page
	$nb_par_page=2;
	// Calculer le nombre des pages 
	$nb_de_page = ceil($nb_commentaire / $nb_par_page);

	
	?>
	<?php
	// Dans cette variable on recupère le nombre de la page selectionnée
     @$page= $_GET["page"];
	 // Si c'est le premier accès sur la page il faut initialiser la variable $page à 1
	 
	 if(empty($page)) $page=1;
	 // A partir de quel commentaire on va selctionner 
	 $debut = ($page-1)*$nb_par_page;
	 //echo $page;
	 //echo $debut;
	 // Sélectionner les commentaires dans un ordre decroissant, on se limite par le nombre de commentaire par page 
	 $sql = "SELECT * FROM commentaire order by id desc limit $debut,$nb_par_page";
	 // On exécute la requête 
	 $result = dbQuery($sql);
	 // Pour chercher toutes les associations (toutes les informations)
	 while($row = dbFetchAssoc($result)) {
		 
// On affiche le contenu et la date de chaque commentaire 
	 ?>	 
		
		<div class="card" >
		<h4><b><?=$row["contenu"]?></b></h4>
		<div class="container">
		<p><?=$row["date"]?></p> 
		</div>
		</div>
	<?php	
	}
   // On va afficher des liens de navigation 
	?>
	<br>
	<div id="pagination">
		<?php
         for ($i=1; $i <= $nb_de_page ; $i++) { 
			echo "<a href='?page=$i'>$i</a>&nbsp&nbsp&nbsp";
		 }

		 
		?>
    </div>	
	<!-- 
		Un formulaire pour ajouter un nouveau commentaire 
	 -->
	
	<h3>Ajouter votre commentaire</h3>
	<form method="post" action="ajouter.php">
	<div class="input-group">
		<label>Votre commentaire</label>
		<br>
		<textarea name="contenu" id="contenu" cols="30" rows="5"></textarea>
		<br>
		
		<input class="btn" type="submit" id="ajouter" value="Ajouter"></button>
	</div>
 </form>
	



</body>
</html>