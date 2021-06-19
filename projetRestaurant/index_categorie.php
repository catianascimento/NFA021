<?php include("db.php"); ?>

<?php include('includes/header.php'); 
?>

<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<main class="container">
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
	
	<div class="col-md-3">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#addCategorie">
		  Add Categorie
		</button>
	</div>
  </div>
  <br>
  <p>Filtrer : </p>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <div class="row">
    <div class="col-md-12 table-responsive">
      <table class="table table-striped table-bordered table-sm" >
         <thead class="thead-dark">
          <tr class="text-center">
            <th>Nom</th>
			<th>Action</th>
          </tr>
        </thead>
        <tbody id="myTable">

          <?php
          $query = "select cat.* from categorie cat";
          $result_categories = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_categories)) { ?>
          <tr>
            <td class="text-center"><?php echo $row['nom']; ?></td>
	        <td class="text-center">
			
              <a href="edit_categorie.php?id=<?php echo $row['id']?>" class="btn btn-outline-info btn-rounded waves-effect">
                <i class="fas fa-marker"></i>
              </a>
			  
              <a href="delete_categorie.php?id=<?php echo $row['id']?>" class="btn btn-outline-danger btn-rounded waves-effect">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
		  
		  
        </tbody>
      </table>
    </div>
  </div>
  
	  <!-- Modal -->
	<div class="modal fade" id="addCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Ajouter categorie</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="save_categorie.php" method="POST">
			 	<div class="form-row">
						<div class="form-group col-md-7">
						  <label for="nom">Nom:</label>
						  <input name="nom" type="text" class="form-control form-control-sm" placeholder="Nom">
						</div>
						
				</div>
				<div class="form-row text-center">
					<div class="form-group col-md-12">
						<input type="submit" name="save_categorie" class="btn btn-success btn-block" value="Save categorie">
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
</main>

<?php include('includes/footer.php'); ?>
