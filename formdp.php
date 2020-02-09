<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['formconnexion'])) {
   $usernameconnect = $_POST['usernameconnect'];
   $saconnect = $_POST['secretanswer'];
   $motdepasse = $_POST['motdepasse'];
   $motdepasse2 = $_POST['motdepasse2'];

   if(!empty($usernameconnect) AND !empty($saconnect) AND !empty($motdepasse) AND !empty($motdepasse2)) {

      $requser = $bdd->prepare("SELECT * FROM membres WHERE username = ?");
      $requser->execute(array($usernameconnect));
      $userinfo = $requser->fetch();

      $verifmdp = password_verify($_POST['secretanswer'], $userinfo['secretanswer']);

      if($userinfo && $verifmdp) {
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['nom'] = $userinfo['nom'];
         $_SESSION['prenom'] = $userinfo['prenom'];
         $_SESSION['username'] = $userinfo['username'];
         $_SESSION['secretanswer'] = $userinfo['secretanswer'];
               if(isset($_POST['motdepasse']) AND !empty($_POST['motdepasse']) AND isset($_POST['motdepasse2']) AND !empty($_POST['motdepasse2'])) {
                     $mdp1 = ($_POST['motdepasse']);
                     $mdp2 = ($_POST['motdepasse2']);
                     if($mdp1 == $mdp2) {
                        $motdepassein = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);
                        $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE username = ?");
                        $insertmdp->execute(array($motdepassein, $_SESSION['username']));
                        header('Location: connexion.php?'.$_SESSION['username']);
                     } else {
                        $erreur = "Vos deux mots de passe ne correspondent pas !";
                     }
               }else{
                  $erreur = "Erreur isset mdp";
               }
      }else{             
      $erreur = "Mauvaise réponse à la question secrète !";
      }
}else{
      $erreur = "Tous les champs doivent être complétés !";
}

}

?>
<html>
   <head>
      <title>Récupération mot de passe</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="body.css" media="screen" type="text/css" />
   </head>
   <body>
      <div id="container">
         <mg  src="logogbaf.png" alt="Logo gbaf">
         
         <form method="POST" action="">
               <h1></h1>
            <label><b>Pseudonyme</b></label>
            <input type="text" name="usernameconnect" placeholder="pseudonyme" />

            <label for="secretquestion"><b>Votre question secrète :</b></label>
            <select name="secretquestion" id="secretquestion">
               <?php 
               $reponse = $bdd->query('SELECT * FROM secretquestions');
               while ($donnees = $reponse->fetch())
               {
               ?> 
               <option value="<?php echo $donnees['secretquestion']; ?>"><?php echo $donnees['secretquestion']; ?></option>
            <?php 
            }
            ?>

            <label><b>Réponse question secrète</b></label>
            <input type="password" name="secretanswer" placeholder="Réponse question" />

            <label for="motdepasse"><b>Nouveau Mot de passe :</b></label>          
            <input type="password" placeholder="mot de passe" id="motdepasse" name="motdepasse">
      
         
            <label for="motdepasse2"><b>Confirmation Mot de passe :</b></label>
            <input type="password" placeholder="Confirmez votre mot de passe" id="motdepasse2" name="motdepasse2">


            
            <input type="submit" id="submit" name="formconnexion" value="Modifier" />
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
<?php 

?>