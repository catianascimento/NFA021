<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

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
		<button type="button" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#exampleModal">
		  Add Utilisateur
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
			<th>Prenom</th>
			<th>Email</th>
            <th>Login</th>
			<th>Action</th>
          </tr>
        </thead>
        <tbody id="myTable">

          <?php
          $query = "select * from utilisateur";
          $result_utilisateurs = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_utilisateurs)) { ?>
          <tr>
            <td class="text-center"><?php echo $row['nom']; ?></td>
			<td class="text-center"><?php echo $row['prenom']; ?></td>
            <td class="text-center"><?php echo $row['adresse_mail']; ?></td>
            <td class="text-center"><?php echo $row['login']; ?></td>
            <td class="text-center">
			
              <a href="edit_utilisateur.php?id=<?php echo $row['id']?>" class="btn btn-outline-info btn-rounded waves-effect">
                <i class="fas fa-marker"></i>
              </a>
			  
              <a href="delete_utilisateur.php?id=<?php echo $row['id']?>" class="btn btn-outline-danger btn-rounded waves-effect">
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
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Ajouter Utilisateur</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="save_utilisateur.php" method="POST">
			 	<div class="form-row">
						<div class="form-group col-md-6">
						  <label for="nom">Nom:</label>
						  <input name="nom" type="text" class="form-control form-control-sm" placeholder="Nom">
						</div>
						<div class="form-group col-md-6">
						  <label for="prenom">Prenom:</label>
						  <input name="prenom" type="text" class="form-control form-control-sm" placeholder="Prenom">
						</div>
				</div>
				<div class="form-row">
						<div class="form-group col-md-12">
						  <label for="adresse_mail">Adresse mail:</label>
						  <input name="adresse_mail" type="text" class="form-control form-control-sm" placeholder="Email">
						</div>
				</div>
				<div class="form-row">
						<div class="form-group col-md-6">
						  <label for="login">Login:</label>
						  <input name="login" type="text" class="form-control form-control-sm" placeholder="Login">
						</div>
						<div class="form-group col-md-6">
						  <label for="mot_de_passe">Mot de passe:</label>
						  <input name="mot_de_passe" type="password" class="form-control form-control-sm" placeholder="Mot de passe">
						</div>
				</div>
				<div class="form-row">
						<div class="form-group col-md-6">
						    <label for="role">Role:</label>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="role" id="admin" value="2">
							  <label class="form-check-label" for="admin">Admin</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="role" id="utilisateur" value="1" checked>
							  <label class="form-check-label" for="utilisateur">Utilisateur</label>
							</div>
						</div>
				</div>
				<div class="form-row text-center">
					<div class="form-group col-md-12">
						<input type="submit" name="save_utilisateur" class="btn btn-success btn-block" value="Save Utilisateur">
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
