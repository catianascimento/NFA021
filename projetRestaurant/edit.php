<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php
include("db.php");
$nom = '';
$categorie= '';
$categorie_id= '';
$duree ='';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "select p.*, cat.nom as cat_nom, cat.id as cat_id from produit p left join categorie cat on p.categorie_id = cat.id WHERE p.id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nom = $row['nom'];
    $categorie = $row['cat_nom'];
	$categorie_id = $row['cat_id'];
	$duree = $row['duree_de_conservation_en_jours'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $nom= $_POST['nom'];
  $categorie_id= $_POST['categorie_id'];
  $duree= $_POST['duree'];

  $query = "UPDATE produit set nom = '$nom', categorie_id = '$categorie_id', duree_de_conservation_en_jours = '$duree' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'mise à jour ok';
  $_SESSION['message_type'] = 'attention';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>

<div class="container p-4">
  <div class="row">
    <div class="col-md- mx-auto">
      <div class="card">
	  
		  <div class="card-header text-center">
			Edit Produit
		  </div>
		  <div class="card-body">
			  <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
				<div class="form-row">
						<div class="form-group col-md-7">
						  <label for="nom">Nom:</label>
						  <input name="nom" type="text" class="form-control form-control-sm" value="<?php echo $nom; ?>" placeholder="Update nom">
						</div>
						<div class="form-group col-md-5">
							<label for="duree">Conservation (jours):</label>
							<input name="duree" type="number" class="form-control form-control-sm" placeholder="Duree" value="<?php echo $duree; ?>">
						</div>
						<!--<div class="form-group col-md-5">
							<legend class="col-form-label pt-0 col-sm-4">Status:</legend>
							<div class="col-sm-8">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="status" id="inlineRadio1" <?php if($status=='OK'){echo 'checked';} ?> value="OK">
									<label class="form-check-label" for="inlineRadio1">OK</label>
									
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="status" id="inlineRadio2" <?php if($status=='RETIRE'){echo 'checked';} ?> value="RETIRE">
									<label class="form-check-label" for="inlineRadio2">RETIRE</label>
								</div>
							</div>
						</div>-->
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="categorie_id">Categorie:</label>
						<select class="form-control form-control-sm" aria-label="Default select example" name="categorie_id">
						<?php
							$query = "select * from categorie";
							$result_categories = mysqli_query($conn, $query);    
							while($row = mysqli_fetch_assoc($result_categories)) { ?>
								<option value="<?php echo $row['id']; ?>" <?php if($categorie_id==$row['id']){echo 'selected="selected"';} ?> ><?php echo $row['nom']; ?></option>
							<?php } ?>	
						</select>
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
