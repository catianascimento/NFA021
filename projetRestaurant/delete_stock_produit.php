<?php

include("db.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  //$stock_id = $_GET['stock_id'];
  $query = "delete from stock_produit where id = '$id'";
  print($query);
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query en erreur.");
  }

  $_SESSION['message'] = 'Relation Produit - Stock supprimée avec succès';
  $_SESSION['message_type'] = 'danger';
   header('Location: index_stock.php');
}

?>
