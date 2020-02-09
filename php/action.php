<?php

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['t']) AND !empty($_GET['t'])) {
	$gett = (int) $_GET['t'];
	$sessionid = $_SESSION['id'];
	if($gett == 1) {
		$check_like = $bdd->prepare('SELECT id FROM likes WHERE id_membres = ?');
		$check_like->execute(array($sessionid));
		$check_dislike = $bdd->prepare('SELECT id FROM dislikes WHERE id_membres = ?');
		$check_dislike->execute(array($sessionid));

		if($check_like->rowCount() == 1) {
			$del = $bdd->prepare('DELETE FROM likes WHERE id_membres = ?');
			$del->execute(array($sessionid));
		}elseif ($check_dislike->rowCount() == 1) {
			$del = $bdd->prepare('DELETE FROM dislikes WHERE id_membres = ?');
			$del->execute(array($sessionid));
		}else{
			$ins = $bdd->prepare('INSERT INTO likes (id_membres) VALUES (?)');
			$ins->execute(array($sessionid));}
		

		
	}elseif($gett == 2) {
		$check_like = $bdd->prepare('SELECT id FROM dislikes WHERE id_membres = ?');
		$check_like->execute(array($sessionid));
		$check_dislike = $bdd->prepare('SELECT id FROM likes WHERE id_membres = ?');
		$check_dislike->execute(array($sessionid));

		if($check_dislike->rowCount() == 1) {
			$del = $bdd->prepare('DELETE FROM dislikes WHERE id_membres = ?');
			$del->execute(array($sessionid));
		}elseif($check_like->rowCount() == 1) {
			$del = $bdd->prepare('DELETE FROM likes WHERE id_membres = ?');
			$del->execute(array($sessionid));
		}else{
			$ins = $bdd->prepare('INSERT INTO dislikes (id_membres) VALUES (?)');
			$ins->execute(array($sessionid));}
		
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
	}

?>

