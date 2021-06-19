<?php

include("db.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM stock WHERE id = $id;";
  $result = mysqli_query($conn, $query);
  
  if(!$result) {
    die("Query en erreur.");
  }
  
  $query = "DELETE FROM stock_produits where stock_id = $id;";
  $result = mysqli_query($conn, $query);
  
  if(!$result) {
    die("Query en erreur.");
  }

  $_SESSION['message'] = 'Stock supprimée avec succès';
  $_SESSION['message_type'] = 'danger';
  header('Location: index_stock.php');
}

?>
