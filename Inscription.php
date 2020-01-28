<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['forminscription']))
{
	$Nom = htmlspecialchars($_POST['nom']);
	$Prénom = htmlspecialchars($_POST['prenom']);
	$username = htmlspecialchars($_POST['username']);
	$motdepasse = htmlspecialchars($_POST['motdepasse']);
	$motdepasse2 = htmlspecialchars($_POST['motdepasse2']);
	$secretanswer = htmlspecialchars($_POST['secretanswer']);

	if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['username']) AND !empty($_POST['motdepasse']) AND !empty($_POST['secretanswer']))
	{
		$Nomlength = strlen($Nom);
		if($Nomlength <=255)
		{
			
				{
					if($motdepasse == $motdepasse2)
					{
						$pass_hache = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);
						$secret_hache = password_hash($_POST['secretanswer'], PASSWORD_DEFAULT);
						$insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenom, username, motdepasse, secretanswer) VALUES (:nom, :prenom, :username, :motdepasse, :secretanswer)");
                        $insertmbr->execute(array(
              			'nom' => $Nom,
              			'prenom' => $Prénom,
              			'username' => $username,
             			'motdepasse' => $pass_hache,
             			'secretanswer' => $secret_hache));
						$erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter<a/>";
					}
					else
					{
						$erreur = "Vos mots de passe ne correspondent pas.";
					}
				}

		}
		else
		{
			$erreur = "Votre Nom ne doit pas dépasser 255 caractères.";
		}
	}
	else
	{
		$erreur = 'Tous les champs doivent être complétés';
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>GBAF : Inscription</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="body.css" media="screen" type="text/css" />
	</head>
	<body>
	<div id="container">
	
				<form method="POST" action="">
			
					<h1><b>Inscription</b></h1>
				<label for="Nom"><b>Nom :</b></label>
				<input type="text" placeholder="Nom" id="nom" name="nom" value="<?php if(isset($Nom)) { echo $Nom; } ?>">
			
				
				<label for="Prénom"><b>Prénom :</b></label>
				<input type="text" placeholder="Prénom" id="prenom" name="prenom" value="<?php if(isset($Prénom)) { echo $Prénom; } ?>">
			
				
				<label for="Mail"><b>Pseudonyme :</b></label>
				<input type="text" placeholder="Pseudonyme" id="username" name="username" value="<?php if(isset($username)) { echo $username; } ?>">
		
			
				
				<label for="motdepasse"><b>Mot de passe :</b></label>				
				<input type="password" placeholder="mot de passe" id="motdepasse" name="motdepasse">
		
			
				<label for="motdepasse2"><b>Confirmation Mot de passe :</b></label>
				<input type="password" placeholder="Confirmez votre mot de passe" id="motdepasse2" name="motdepasse2">
			
				
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
		
				<label for="secretanswer"><b>Réponse à la question secrète :</b></label>
				<input type="password" placeholder="Entrez votre réponse" id="secretanswer" name="secretanswer">
		
				
				
					<input type="submit" name="forminscription" value="Je m'inscris"/>
		
	</div>
</form>
<?php 
if(isset($erreur))
{
	echo $erreur;
}
?>
	</div>
	</body>
</html>