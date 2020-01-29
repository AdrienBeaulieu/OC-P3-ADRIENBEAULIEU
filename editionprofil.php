<?php 

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) {
      $newprenom = htmlspecialchars($_POST['newprenom']);
      $insertprenom = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ?");
      $insertprenom->execute(array($newprenom, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['username']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE membres SET username = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) {
      $newnom = htmlspecialchars($_POST['newnom']);
      $insertnom = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ?");
      $insertnom->execute(array($newnom, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = password_hash($_POST['newmdp1']);
      $mdp2 = password_hash($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mots de passe ne correspondent pas !";
      }
   }
?>

<!DOCTYPE html>
<html>
<head>
	<title>GBAF : Edition profil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styleacteurs.css">
</head>
<body>
	<header class="ntete">
         
         <p><a href="Pageprincipal.php"><img class="logo_header" src="logogbaf.png" alt="Logo GBAF"><a></p>
         <p><a href="profil.php"><img class="photo_profil" src="imageprofile.png" alt="Photo de profil"></a></p> 
         <div class="nom_prenom"> 
            <?php 
            echo $_SESSION['nom'];
            ?>
            <?php 
            echo $_SESSION['prenom']; ?></div>
         <hr class="barre_header" clolor="grey">
      </header>
	<div align="center">
		<h2>Edition de mon profil</h2><br /><br />
		<div align="center">
			<form method="POST" action="" enctype="mutlipart/form-daye">
				<label>Prénom :</label>
				<input type="text" name="newprenom" placeholder="Prénom" value=""/><br /><br />
				<label>Nom :</label>
				<input type="text" name="newnom" placeholder="Nom" value=""/><br /><br />
				<label>Pseudo :</label>
				<input type="text" name="newpseudo" placeholder="Pseudonyme" value=""/><br /><br />
				<label>Mot de passe :</label>
				<input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
				<label>Confirmation - mot de passe :</label>
				<input type="password" name="newmdp2" placeholder="Confirmation du mot de passe"/><br /><br />
				<input type="submit" value="Mettre à jour mon profil !"/>
			</form>
		</div>
	</div>
</body>
</html>
<?php
}
else
{
   header("Location: connexion.php");
}
?>