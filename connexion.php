<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['formconnexion'])) {
   $usernameconnect = $_POST['usernameconnect'];
   $mdpconnect = $_POST['mdpconnect'];

   if(!empty($usernameconnect) AND !empty($mdpconnect)) {

      $requser = $bdd->prepare("SELECT * FROM membres WHERE username = ?");
      $requser->execute(array($usernameconnect));
      $userinfo = $requser->fetch();

      $verifmdp = password_verify($_POST['mdpconnect'], $userinfo['motdepasse']);

      if($userinfo && $verifmdp) {
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['nom'] = $userinfo['nom'];
         $_SESSION['prenom'] = $userinfo['prenom'];
         $_SESSION['username'] = $userinfo['username'];
         $_SESSION['secretanswer'] = $userinfo['secretanswer'];

         header("Location: Pageprincipal.php?id=".$_SESSION['id']);
         die;
         
      } else {
         $erreur = "Mauvais pseudonyme ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
   <head>
      <title>Connexion</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="body.css" media="screen" type="text/css" />
   </head>
   <body>
      <div id="container">
         <mg  src="logogbaf.png" alt="Logo gbaf">
         
         <form method="POST" action="">
               <h1>Connexion</h1>
            <label><b>Pseudonyme</b></label>
            <input type="text" name="usernameconnect" placeholder="pseudonyme" />

            <label><b>Mot de passe</b></label>
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            
            <input type="submit" id="submit" name="formconnexion" value="Se connecter !" />
         </form>
         <a href="Inscription.php" class="sinscrire">Pas encore de compte ?<a/>
         <?php
         if(isset($erreur)) {
            echo '<font color="black">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>