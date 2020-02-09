<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
setlocale(LC_TIME, 'fra_fra');

	  $likes = $bdd->prepare('SELECT id FROM likes2');
      $likes->execute(array());
      $likes = $likes->rowCount();
      $dislikes = $bdd->prepare('SELECT id FROM dislikes2');
      $dislikes->execute(array());
      $dislikes = $dislikes->rowCount();


if(isset($_SESSION['id'])){
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();

   $userid = $_SESSION['id'];

   $reqidcomment = $bdd->query("SELECT userid FROM commentsdsa");
   $useridcommdsa = $reqidcomment->fetch();
   $useridcommentaire = $useridcommdsa['userid'];

   $reqcomm = $bdd->query('SELECT * FROM commentsdsa');

	
	if(isset($_POST['submit_commentaire'])) {
		$commentaire = htmlspecialchars($_POST['commentairedsa']);
		$dates = strftime('%d/%m/%y');
			if(isset($_POST['commentairedsa']) AND !empty($_POST['commentairedsa'])) {
				if($userid == $useridcommentaire) {
					# code...
				
					 echo "Vous avez déjà écrit un commentaire !";

				}else{
					$insertcmt = $bdd->prepare('INSERT INTO commentsdsa (prenom, commentaire, dates, userid) VALUES (?, ?, ?, ?)');
					$insertcmt->execute(array($user['prenom'],$commentaire,$dates, $userid));
					header("Location: acteur2.php");}
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
		<title>GBAF: DSA FRANCE</title>
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
		<div class="votrecommentaire">

 <form method="POST">
   <textarea name="commentairedsa" placeholder="Votre commentaire..."></textarea><br />
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
</form>


<?php  $totalcommentaireReqID = $bdd->query("SELECT COUNT(*) FROM commentsdsa");
	 	$totalcommentaireID = $totalcommentaireReqID->fetchColumn();  ?>

		</div>
		<br />
		<div class="commentaire_encadrement">
			<p><?php echo $totalcommentaireID; ?> Commentaires</p>
				<div class="like_encadremen">
					<a href="php/action2.php?t=1" class="like">J'aime</a> (<?= $likes ?>)
					<a href="php/action2.php?t=2" class="dislike">Je n'aime pas</a> (<?= $dislikes ?>)
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