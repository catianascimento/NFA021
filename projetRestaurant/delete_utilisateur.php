<?php

include("db.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM utilisateur WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query en erreur.");
  }
  
  $query = "DELETE FROM utilisateur_roles WHERE utilisateur_id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query en erreur.");
  }

  $_SESSION['message'] = 'Utilisateur supprimée avec succès';
  $_SESSION['message_type'] = 'danger';
  header('Location: index_utilisateur.php');
}

?>
