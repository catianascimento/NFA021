<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php

include('db.php');

if (isset($_POST['save_refrigerateur'])) {
  $code = $_POST['code'];
  
  $query = "INSERT INTO refrigerateur(code) VALUES ('$code')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query en erreur.");
  }

  $_SESSION['message'] = 'Refrigerateur sauvegardée avec succès';
  $_SESSION['message_type'] = 'success';
  header('Location: index_refrigerateur.php');

}

?>
