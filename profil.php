<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
      <title>Profil</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="styleacteurs.css" />
   </head>

   <!-- Header -->      
      <header class="ntete">
         
         <p><a href="Pageprincipal.php"><img class="logo_header" src="logogbaf.png" alt="Logo GBAF"><a></p>
         <p> <img class="photo_profil" src="imageprofile.png" alt="Photo de profil"></p> 
         <div class="nom_prenom"> Nom & Prénom </div>
         <hr class="barre_header" clolor="grey">
      </header>

   <body>
      <div align="center">
         <h2>Profil de <?php echo $userinfo['prenom'] ?></h2>
         <br /><br />
         Nom = <?php echo $userinfo['nom']; ?>
         <br />
         Prénom = <?php echo $userinfo['prenom']; ?>
         <br />
         Mail = <?php echo $userinfo['mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
         {
         ?>
         <a href='#'>Editer mon profil<a/>
         <a href='deconnexion.php'>Deconnexion<a/>
         <?PHP
         }
         ?>
      </div>
   </body>
</html>
<?php
}
?>