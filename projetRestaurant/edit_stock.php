<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php
include("db.php");
$identifiant = '';
$produit='';
$quantite='';
$status='';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
    
  $query = "select *, sp.id sp_id from stock_produit sp join produit p on sp.produit_id = p.id WHERE sp.id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $identifiant = $row['id'];
	$produit = $row['nom'];
	$quantite = $row['quantite'];
	$status = $row['status'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $status= $_POST['status'];

  $query = "UPDATE stock_produit set status = '$status' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'mise à jour ok';
  $_SESSION['message_type'] = 'attention';
  header('Location: index_stock.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <br>
  <div class="row">
    <div class="col-md-9">
      <!-- MESSAGES -->
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>
    </div>
	
  </div>
  <br>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
	  
		  <div class="card-header text-center">
			Edit Stock - Produit
		  </div>
		  <div class="card-body">
			  <form action="edit_stock.php?id=<?php echo $_GET['id']; ?>" method="POST">
				<div class="form-row row justify-content-between">
					<div class="form-group col">
					  <label for="identifiant">Identifiant Stock:</label>
					  <input name="identifiant" type="text" class="form-control form-control-sm" value="<?php echo $identifiant; ?>" placeholder="Update Identifiant" disabled>
					</div>
					
					<div class="form-group col">
					  <label for="quantite">Quantite:</label>
					  <input name="quantite" type="text" class="form-control form-control-sm" value="<?php echo $quantite; ?>" placeholder="Update Quantite" disabled>
					</div>
					
					<div class="form-group col-md-3">
						<label for="status">Status:</label>
						<select name="status" class="form-control form-control-sm">
							<option value="OK" <?php echo $status == "OK" ? "selected" : "" ?>>OK</option>
							<option value="RETIRE" <?php echo $status == "RETIRE" ? "selected" : "" ?>>RETIRE</option>
						</select>
					</div>
					
					<!--<div class="form-group col-md-2">
						<button type="button" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#exampleModal">
							Ajouter produit
						</button>
					</div>-->
				</div>
				<div class="form-row row justify-content-between">
					
					
					<div class="form-group col-md-7">
					  <label for="produit">Produit:</label>
					  <input name="produit" type="text" class="form-control form-control-sm" value="<?php echo $produit; ?>" placeholder="Update Produit" disabled>
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

	  <!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Ajouter Produit</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="save_produit_stock.php" method="POST">
				<div class="form-row">
					<input name="stock_id" type="int" value="<?php echo $id; ?>" hidden>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="categorie_id">Available produits:</label>
						<select class="form-control form-control-sm" aria-label="Default select example" name="produit_id">
						<?php
							$query = "select * from produit p where p.id not in (select sp.produits_id from stock_produits sp)";
							$result_produits = mysqli_query($conn, $query);    
							while($row = mysqli_fetch_assoc($result_produits)) { ?>
								<option value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></option>
							<?php } ?>	
						</select>
					</div>
				</div>
				<div class="form-row text-center">
					<div class="form-group col-md-12">
						<input type="submit" name="save_produit_stock" class="btn btn-success btn-block" value="Ajouter">
					</div>
				</div>
			  </form>
		  </div>
		</div>
	  </div>
	</div>
	
	<?php
		echo '<script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
		</script>';?>

<?php include('includes/footer.php'); ?>
