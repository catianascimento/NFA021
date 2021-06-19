<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php

include('db.php');

if (isset($_POST['save_utilisateur'])) {
	$adresse_mail = $_POST['adresse_mail'];
	$login = $_POST['login'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$role = $_POST['role'];
  
	$query = "INSERT INTO utilisateur(nom, prenom, adresse_mail, login, mot_de_passe, role_id) VALUES ('$nom', '$prenom','$adresse_mail', '$login', '$mot_de_passe', $role)";
	$result = mysqli_query($conn, $query);
	if(!$result) {
		die("Query en erreur.");
	}
		

  $_SESSION['message'] = 'Utilisateur sauvegardée avec succès';
  $_SESSION['message_type'] = 'success';
  header("location:index.php");

}

?>
