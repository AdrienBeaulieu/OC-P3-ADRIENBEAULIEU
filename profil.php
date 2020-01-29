<?php

session_start();

if(isset($_SESSION['id']))

{
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
            echo $_SESSION['nom'];
            ?>
            <?php 
            echo $_SESSION['prenom']; ?></div>
         <hr class="barre_header" clolor="grey">
      </header>

   <body>
      <div align="center">
         <h2>Profil de <?php echo $_SESSION['prenom']; ?></h2>
         <br /><br />
         Nom = <?php echo $_SESSION['nom']; ?>
         <br /><br />
         Prénom = <?php echo $_SESSION['prenom']; ?>
         <br /><br />
         Pseudonyme = <?php echo $_SESSION['username']; ?>
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