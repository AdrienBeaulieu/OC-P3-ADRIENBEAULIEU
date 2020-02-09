<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
setlocale(LC_TIME, 'fra_fra');

	$likes = $bdd->prepare('SELECT id FROM likes3');
      $likes->execute(array());
      $likes = $likes->rowCount();
      $dislikes = $bdd->prepare('SELECT id FROM dislikes3');
      $dislikes->execute(array());
      $dislikes = $dislikes->rowCount();



if(isset($_SESSION['id'])){
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();

   $userid = $_SESSION['id'];

   $reqidcomment = $bdd->query("SELECT userid FROM commentsfco");
   $useridcomm = $reqidcomment->fetch();

   $reqcomm = $bdd->query('SELECT * FROM commentsfco');


	if(isset($_POST['submit_commentaire'])) {
		$commentaire = htmlspecialchars($_POST['commentaire']);
		$dates = strftime('%d/%m/%y');
			if(isset($_POST['commentaire']) AND !empty($_POST['commentaire'])) {
				if($_SESSION['id'] == $useridcomm['userid']) {
					# code...
				
					 echo "Vous avez déjà écrit un commentaire !";

				}else{
					$insertcmt = $bdd->prepare('INSERT INTO commentsfco (prenom, commentaire, dates, userid) VALUES (?, ?, ?, ?)');
					$insertcmt->execute(array($user['prenom'],$commentaire,$dates, $userid));
					header("Location: acteur3.php");}
			}else{
			echo "Vous n'avez pas écris de message !";
			}
	}

			
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
            Notre proposition :<br /><br />
            
            Un financement jusqu’à 30 000€<br />
            Un suivi personnalisé et gratuit<br />
            Une lutte acharnée contre les freins sociétaux et les stéréotypes.<br /><br />
            

            Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… .<br />
            Nous collaborons avec des personnes talentueuses et motivées.<br />
            Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.<br />
		</p>
	</div>
	
<!-- Section commentaire -->
			<br />
		<div class="votrecommentaire">

 <form method="POST">
   <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
</form>


<?php  $totalcommentaireReqID = $bdd->query("SELECT COUNT(*) FROM commentsfco");
	 	$totalcommentaireID = $totalcommentaireReqID->fetchColumn();  ?>

		</div>
		<br />
		<div class="commentaire_encadrement">
			<p><?php echo $totalcommentaireID; ?> Commentaires</p>
				<div class="like_encadremen">
					<a href="php/action3.php?t=1" class="like">J'aime</a> (<?= $likes ?>)
					<a href="php/action3.php?t=2" class="dislike">Je n'aime pas</a> (<?= $dislikes ?>)
				</div>
<?php while ($commentaires = $reqcomm->fetch()) { ?>


			<div class="commentaire">
				<p>Prénom: <?php echo $commentaires['prenom']; ?> </p>
				<p>Message: <?php echo $commentaires['commentaire']; ?> </p>
				<p>Date: <?php echo $commentaires['dates']; ?> </p>
			</div>
<br />
<?php } ?>

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