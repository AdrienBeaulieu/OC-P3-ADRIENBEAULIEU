<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id']))
{
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styleacteurs.css" />
		<title>GBAF: CDE</title>
	</head>

	<body>
<!-- Header -->		
		<header class="ntete">
			
			<p><a href="Pageprincipal.php"><img class="logo_header" src="logogbaf.png" alt="Logo GBAF"><a></p>
			<p><a href="profil.php"><img class="photo_profil" src="imageprofile.png" alt="Photo de profil"></a></p>
			<div class="nom_prenom">
				 <?php 
            echo $user['nom'];
            ?>
            <?php 
            echo $user['prenom']; ?>
			</div>
			<hr class="barre_header" clolor="grey">
		</header>

<!-- Section acteur -->
		

	<div class="cadre_acteur">
		<p class="logo_acteur_p"><img class="logo_acteur" src="CDE.png" alt="Logo CDE"></p> 
		<h2>Chambre des Entrepreneurs</h2>
			<p>
				<a href="CDE.fr">Lien vers le site CDE</a> <!-- Modifier le texte du lien (sur toutes les pages)-->
			</p>
		<p>La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.<br />
           Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.</p>
           <br />
    </div>

<!-- Section commentaire -->
		<br />
		<div class="commentaire_encadrement">
			<p>X Commentaires</p>
				<div class="like_encadrement">
					<a href="like.php" class="like">J'aime</a>
					<a href="dislike.php" class="dislike">J'aime pas</a>
				</div>
			<div class="commentaire">
				<p>Prénom: </p>
				<p>Message: </p>
				<p>Date: </p>
			</div>
		</div>
           
<!-- Footer -->
		<footer>
			<ul>	
				<li><a href="ML.php">Mentions légales</a></li>
				<li> | </li>
				<li><a href="Contact.php">Contact</a></li>
			</ul>	
			
		</footer>

	</body>
</html>
<?php
}
else
{
	header("Location: connexion.php");
}
?>