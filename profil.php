<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id']))
{
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
?>
<html>
   <head>
      <title>GBAF: Profil</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="styleacteurs.css" />
   </head>

   <!-- Header -->      
      <header class="ntete">
         
         <p><a href="Pageprincipal.php"><img class="logo_header" src="logogbaf.png" alt="Logo GBAF"><a></p>
         <p><a href="profil.php"><img class="photo_profil" src="imageprofile.png" alt="Photo de profil"></a></p> 
         <div class="nom_prenom"> 
            <?php 
            echo $user['nom'];
            ?>
            <?php 
            echo $user['prenom']; ?></div>
         <hr class="barre_header" clolor="grey">
      </header>

   <body>
      <div align="center">
         <h2>Profil de <?php echo $user['prenom']; ?></h2>
         <br /><br />
         Nom = <?php echo $user['nom']; ?>
         <br /><br />
         Prénom = <?php echo $user['prenom']; ?>
         <br /><br />
         Pseudonyme = <?php echo $user['username']; ?>
         <br /><br /><br />
         <a href='editionprofil.php' class="boutonsite">Editer mon profil<a/>
         <a href='deconnexion.php' class="boutonsite">Deconnexion<a/>
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