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
		<title>Mentions légales</title>
	</head>

	<body>
<!-- Header -->		
		<header class="ntete">
			
			<p><a href="Pageprincipal.php"><img class="logo_header" src="logogbaf.png" alt="Logo GBAF"></a></p>
			<p><a href="profil.php"><img class="photo_profil" src="imageprofile.png" alt="Photo de profil"></a></p>
			<a href='deconnexion.php' class="boutonsite2">Déconnexion<a/>  
			<div class="nom_prenom">
				 <?php 
            echo $user['nom'];
            ?>
            <?php 
            echo $user['prenom']; ?>
			</div>
			<hr class="barre_header" clolor="grey">
		</header>

<!-- CONTENU --> 
		
		<p>Ce site internet est créé par BEAULIEU ADRIEN dans le cadre d’une formation Openclassrooms. Il rentre dans le cadre du projet 3 «Réalisez l'extranet d'un groupe bancaire» de la formation prép’fullstack.<br />

		Les informations que vous trouverez sur ce site sont fausses.</p>

		<h1> Mentions Légales </h1>

		<p>Propriétaire : GBAF</p>
		<p>Créateur : BEAULIEU Adrien</p>
		<p>Responsable publication : Personne Fictif</p>
		<p>Webmaster : BEAULIEU Adrien</p>
		<p>Hébergeur : LWS – 10, RUE PENTHIEVRE 75008 PARIS FRANCE</p>
		





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