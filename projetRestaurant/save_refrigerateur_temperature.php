<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php

include('db.php');

if (isset($_POST['save_refrigerateur_temperature'])) {
  $refrigerateur_id = $_POST['refrigerateur_id'];
  $max_temperature = $_POST['max_temperature'];
  $min_temperature = $_POST['min_temperature'];
  $date = date('Y-m-d H:i:s');
  
  $query = "INSERT INTO refrigerateur_temperature(date_time, refrigerateur_id, max_temperature, min_temperature) VALUES ('$date','$refrigerateur_id', '$max_temperature', '$min_temperature')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query en erreur.");
  }

  $_SESSION['message'] = 'Refrigerateur - Temperature sauvegardée avec succès';
  $_SESSION['message_type'] = 'success';
  header('Location: index_refrigerateur.php');

}

?>
