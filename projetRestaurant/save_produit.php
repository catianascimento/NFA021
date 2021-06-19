<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php

include('db.php');

if (isset($_POST['save_produit'])) {
  $nom = $_POST['nom'];
  $status = $_POST['status'];
  $categorie_id = $_POST['categorie_id'];
  $duree = $_POST['duree'];
  
  $query = "INSERT INTO produit(nom, status, categorie_id, duree_de_conservation_en_heures) VALUES ('$nom', '$status', '$categorie_id', '$duree')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query en erreur.");
  }

  $_SESSION['message'] = 'Produit sauvegardée avec succès';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>
