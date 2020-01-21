<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css" />
		<title>GBAF</title>
	</head>

	<body>
<!-- Header -->
			
		<header class="ntete">
			
			<p><a href="Pageprincipal.php"><img class="logo_header" src="logogbaf.png" alt="Logo GBAF"></a></p>
			<p> <img class="photo_profil" src="imageprofile.png" alt="Photo de profil"></p> 
			<div class="nom_prenom"> Nom & Prénom </div>
			<hr class="barre_header" color="grey">
		</header>
	
	

<!-- Section présentation -->
		<h1>Bienvenue sur le site du GBAF</h1>
		<p id="text_presentation">Le Groupement Banque Assurance Français​ (GBAF) est une fédération  représentant les 6 grands groupes français</p>
		
			<p id="logo_presentation_p"><img class="logo_presentation" src="logogbaf.png" alt="Logo GBAF"></p>
		<p id="barre_presentation"></p>
		

<!-- Section acteur -->
	    <h2>Voici nos acteurs et partenaires</h2>
		<p id="text_acteurs">Texte acteurs et partenaires</p>	

		<?php echo "bonjour"; ?>
		 <!-- Début section regrouprement Acteurs -->


			<!-- Acteur 1 CDE-->

	<div class="cadre_general">	
		<div class="encadrement_acteurs">
			<img class="logo_acteurs" src="CDE.png" alt="Logo CDE">
			<h3>CDE</h3>
				<p>La CDE (Chambre Des Entrepreneurs) accompagne les..
					<a href="CDE.php">Lire la suite</a>
				</p>
		</div>
		<br />

			<!-- Acteur 2 DSA FRANCE-->
		<div class="encadrement_acteurs">	
			<img class="logo_acteurs" src="Dsa_france.png" alt="Logo Dsa_france">
			<h3>DSA France</h3>
				<p>Dsa France accélère la croissance du territoire et..
					<a href="Acteur2.php">Lire la suite</a>
				</p>
		</div>
		<br />

			<!-- Acteur 3 Formation co-->
		<div class="encadrement_acteurs">	
			<img class="logo_acteurs" src="formation_co.png" alt="logo formation_co">
			<h3>Formation And Co</h3>
				<p>Formation&co est une association française présente sur..
					<a href="Acteur3.php">Lire la suite</a>
				</p>
		</div>
		<br />		

			<!-- Acteur 4 Protect people-->
		
		<div class="encadrement_acteurs">	
			<img class="logo_acteurs" src="protectpeople.png" alt="logo protectpeople"> 
			<h3>Protect people</h3>
				<p>Protectpeople finance la solidarité nationale..
					<a href="Acteur4.php">Lire la suite</a> 
				</p>
		</div>

	</div>
	<br />
	</body>	 <!-- Fin section regrouprement Acteurs -->
		

<!-- Footer -->
		<footer>
			<ul>	
				<li><a href="ML.php">Mentions légales</a></li>
				<li> | </li>
				<li><a href="Contact.php">Contact</a></li>
			</ul>	
			
		</footer>

	</body>
</html>