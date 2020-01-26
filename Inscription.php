<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['forminscription']))
{
	$Nom = htmlspecialchars($_POST['Nom']);
	$Prénom = htmlspecialchars($_POST['Prénom']);
	$Mail = htmlspecialchars($_POST['Mail']);
	$Mail2 = htmlspecialchars($_POST['Mail2']);
	$motdepasse = sha1($_POST['motdepasse']);
	$motdepasse2 = sha1($_POST['motdepasse2']);

	if(!empty($_POST['Nom']) AND !empty($_POST['Prénom']) AND !empty($_POST['Mail']) AND !empty($_POST['motdepasse']))
	{
		$Nomlength = strlen($Nom);
		if($Nomlength <=255)
		{
			if($Mail == $Mail2)
			{
				if(filter_var($Mail, FILTER_VALIDATE_EMAIL))
				{
					if($motdepasse == $motdepasse2)
					{
						$insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenom, mail, motdepasse) VALUES (:nom, :prenom, :mail, :motdepasse)");
                        $insertmbr->execute(array(
              			'nom' => $Nom,
              			'prenom' => $Prénom,
              			'mail' => $Mail,
             			'motdepasse' => $motdepasse));
						$erreur = "Votre compte a bien été créé !";
					}
					else
					{
						$erreur = "Vos mots de passe ne correspondent pas.";
					}
				}
				else
				{
					$erreur = "Votre adresse mail n'est pas valide.";
				}
			}
			else
			{
				$erreur = "Vos adresses mails ne correspondent pas.";
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
		<title>S'inscrire</title>
		<meta charset="utf-8">
	</head>
	<body>
		<form method="POST" action="">
	<div align="center">
				<h2> Inscription </h2>
		<br><br><br>
		<table>
			<tr>
				<td align="right">
				<label for="Nom">Nom :</label>
				</td>
				<td>
				<input type="text" placeholder="Nom" id="Nom" name="Nom" value="<?php if(isset($Nom)) { echo $Nom; } ?>">
				</td>
			</tr>
			<tr>
				<td align="right">
				<label for="Prénom">Prénom :</label>
				</td>
				<td>
				<input type="text" placeholder="Prénom" id="Prénom" name="Prénom" value="<?php if(isset($Prénom)) { echo $Prénom; } ?>">
				</td>
			</tr>
			<tr>
				<td align="right">
				<label for="Mail">E-mail :</label>
				</td>
				<td>
				<input type="text" placeholder="Mail" id="Mail" name="Mail" value="<?php if(isset($Mail)) { echo $Mail; } ?>">
				</td>
			</tr>
			<tr>
				<td align="right">
				<label for="Mail2">Confirmation E-mail :</label>
				</td>
				<td>
				<input type="text" placeholder="Confirmez votre Mail" id="Mail2" name="Mail2">
				</td>
			</tr>
			<tr>
				<td align="right">
				<label for="motdepasse">Mot de passe :</label>
				</td>
				<td>
				<input type="password" placeholder="mot de passe" id="motdepasse" name="motdepasse">
				</td>
			</tr>
			<tr>
				<td align="right">
				<label for="motdepasse2">Confirmation Mot de passe :</label>
				</td>
				<td>
				<input type="password" placeholder="Confirmez votre mot de passe" id="motdepasse2" name="motdepasse2">
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="center">
					<br/>
					<input type="submit" name="forminscription" value="Je m'inscris"/>
				</td>
			</tr>
		</table>
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