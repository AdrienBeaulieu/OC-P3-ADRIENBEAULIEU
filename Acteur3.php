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
		<title>GBAF: Formation&co</title>
	</head>
	
	<body>

<!-- Header -->		
		<header class="ntete">
			
			<p><a href="Pageprincipal.php"><img class="logo_header" src="logogbaf.png" alt="Logo GBAF"></a></p>
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

<!-- SECTION ACTEUR -->

	<div class="cadre_acteur">
		<p class="logo_acteur_p"><img class="logo_acteur" src="formation_co.png" alt="Logo Fomation et co"></p>
		<h2>Formation&co</h2>
		<p>
			<a href="Formation&co.fr">Lien vers le site Formation&co</a>
		</p>
		<p>
			Formation&co est une association française présente sur tout le territoire.<br />
            Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.<br />
            Notre proposition :<br />
            <ul>
            <li>un financement jusqu’à 30 000€</li>
            <li>un suivi personnalisé et gratuit</li>
            <li>une lutte acharnée contre les freins sociétaux et les stéréotypes.</li>
            </ul>

            Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… .<br />
            Nous collaborons avec des personnes talentueuses et motivées.<br />
            Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.<br />
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