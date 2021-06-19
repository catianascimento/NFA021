<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php
include("db.php");
$nom = '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "select cat.* from categorie cat WHERE cat.id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nom = $row['nom'];
  }
}

if (isset($_POST['update'])) {
  $nom= $_POST['nom'];
 
  $query = "UPDATE categorie set nom = '$nom' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'mise à jour ok';
  $_SESSION['message_type'] = 'attention';
  header('Location: index_categorie.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card">
	  
		  <div class="card-header text-center">
			Edit Categorie
		  </div>
		  <div class="card-body">
			  <form action="edit_categorie.php?id=<?php echo $_GET['id']; ?>" method="POST">
				<div class="form-row">
						<div class="form-group col-md-7">
						  <label for="nom">Nom:</label>
						  <input name="nom" type="text" class="form-control form-control-sm" value="<?php echo $nom; ?>" placeholder="Update nom">
						</div>
				</div>
				<div class="form-row text-center">
					<div class="form-group col-md-12">
						<button class="btn-success" name="update">
							Update
						</button>
					</div>
				</div>
			  </form>
			</div>
      </div>
    </div>
  </div>
</div>


<?php include('includes/footer.php'); ?>
