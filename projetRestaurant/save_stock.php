<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php

include('db.php');

if (isset($_POST['save_stock'])) {
  $quantite = $_POST['quantite'];
  $status = $_POST['status'];
  $produit = $_POST['produit'];
  $date = date('Y-m-d H:i:s');
  
  $query = "INSERT INTO stock_produit(date_dinsertion, quantite, status, produit_id) VALUES ('$date','$quantite','$status','$produit')";
  echo $query;
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query en erreur.");
  }

  $_SESSION['message'] = 'Stock - Produit sauvegardée avec succès';
  $_SESSION['message_type'] = 'success';
  header('Location: index_stock.php');

}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>
