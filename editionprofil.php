<?php 

session_start();

if(isset($_SESSION['id']))

{
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