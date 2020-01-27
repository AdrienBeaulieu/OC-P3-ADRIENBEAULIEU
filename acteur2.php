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
		<title>DSA FRANCE</title>
	</head>

	<body>
<!-- Header -->		
		<header class="ntete">
			
			<p><a href="Pageprincipal.php"><img class="logo_header" src="logogbaf.png" alt="Logo GBAF"></a></p>
			<p> <img class="photo_profil" src="imageprofile.png" alt="Photo de profil"></p> 
			<div class="nom_prenom">
				 <?php 
            echo $user['nom'];
            ?>
            <?php 
            echo $user['prenom']; ?>
			</div>
			<hr class="barre_header" clolor="grey">
		</header>

<!-- SECTION ACTEUR -->	

	<div class="cadre_acteur">
		<p class="logo_acteur_p"><img class="logo_acteur" src="Dsa_france.png" alt="Logo Dsa_france"></p>
		<h2>DSA France</h2>

			<p>
				<a href="CDE.fr">Lien vers le site Dsa France</a>
			</p>
		<p>
		   Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.<br />
		   Nous accompagnons les entreprises dans les étapes clés de leur évolution.<br />
           Notre philosophie : s’adapter à chaque entreprise.<br />
           Nous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises
       </p>
    </div>

<!-- Section commentaire -->
		<br />
		<div class="commentaire_encadrement">
			<p>X Commentaires</p>
			<div class="commentaire">
				CECI EST UN COMMENTAIRE
			</div>
		</div>
		
<!-- Footer -->
		<footer>
			<nav>
				<ul>
					<li><a href="ML.php">Mentions légales</a></li>
					<li><a href="Contact.php">Contact</a></li>
				</ul>
			</nav>
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