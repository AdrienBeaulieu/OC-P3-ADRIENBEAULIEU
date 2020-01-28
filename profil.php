<?php

session_start();

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
         <p> <img class="photo_profil" src="imageprofile.png" alt="Photo de profil"></p> 
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
         <br />
         Prénom = <?php echo $_SESSION['prenom']; ?>
         <br />
         Pseudonyme = <?php echo $_SESSION['username']; ?>
         <br />
         <a href='#'>Editer mon profil<a/>
         <a href='deconnexion.php'>Deconnexion<a/>
      </div>
   </body>
</html>
<?php
}
?>