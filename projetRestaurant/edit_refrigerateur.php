<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php
include("db.php");
$code = '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "select r.* from refrigerateur r WHERE r.id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $code = $row['code'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $code= $_POST['code'];
  
  $query = "UPDATE refrigerateur set code = '$code' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'mise à jour ok';
  $_SESSION['message_type'] = 'attention';
  header('Location: index_refrigerateur.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card">
	  
		  <div class="card-header text-center">
			Edit Refrigerateur
		  </div>
		  <div class="card-body">
			  <form action="edit_refrigerateur.php?id=<?php echo $_GET['id']; ?>" method="POST">
				<div class="form-row">
					<div class="form-group col-md-7">
					  <label for="code">Code:</label>
					  <input name="code" type="text" class="form-control form-control-sm" value="<?php echo $code; ?>" placeholder="Update code">
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
