<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php

include('db.php');

if (isset($_POST['save_categorie'])) {
  $nom = $_POST['nom'];
  
  $query = "INSERT INTO categorie(nom) VALUES ('$nom')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query en erreur.");
  }

  $_SESSION['message'] = 'Categorie sauvegardée avec succès';
  $_SESSION['message_type'] = 'success';
  header('Location: index_categorie.php');

}

?>
