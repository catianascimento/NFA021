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
		<button type="button" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#modalRefrigerateur">
		  Add Refrigerateur
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
            <th>Code</th>
			<th>Action</th>
          </tr>
        </thead>
        <tbody id="myTable">

          <?php
          $query = "select * from refrigerateur";
          $result_refrigerateurs = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_refrigerateurs)) { ?>
          <tr>
            <td class="text-center"><?php echo $row['code']; ?></td>
			<td class="text-center">
			  <a href="show_temperatures.php?id=<?php echo $row['id']?>&code=<?php echo $row['code']?>" class="btn btn-primary btn-rounded">
                <i class="fas fa-list"></i>
              </a>
			
			  <a data-toggle="modal" data-target="#modalTemperature" data-code=<?php echo $row['code']?> data-id=<?php echo $row['id']?> id="temperature" 
			    class="btn btn-warning btn-rounded call-modal" href="#modalTemperature">
				<i class="fas fa-temperature-low"></i>
			  </a>				  
			
              <a href="edit_refrigerateur.php?id=<?php echo $row['id']?>" class="btn btn-success btn-rounded">
                <i class="fas fa-marker"></i>
              </a>
			  
              <a href="delete_refrigerateur.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-rounded">
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
	<div class="modal fade" id="modalRefrigerateur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Ajouter Refrigerateur</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="save_refrigerateur.php" method="POST">
			 	<div class="form-row">
					<div class="form-group col-md-12">
					  <label for="code">Code:</label>
					  <input name="code" type="text" class="form-control form-control-sm" placeholder="Code Refrigerateur">
					</div>
				</div>
				<div class="form-row text-center">
					<div class="form-group col-md-12">
						<input type="submit" name="save_refrigerateur" class="btn btn-success btn-block" value="Save Refrigerateur">
					</div>
				</div>
			  </form>
		  </div>
		</div>
	  </div>
	</div>
	
	  <!-- Modal -->
	<div class="modal fade" id="modalTemperature" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		
		<div class="modal-content">
		  <div class="col-md-12 table-responsive">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Enregistrer Temperature</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
		    </div>
		    <br>
			<div class="modal-temperature-body">
		  	<form action="save_refrigerateur_temperature.php" method="POST">
			 	<div class="form-row">
					<div class="form-group col-md-10">
					  <label for="refrigerateur_code">Code:</label>
					  <input type="text" name="refrigerateur_code" id="refrigerateur_code" value="" disabled="true"/>
					</div>
					<div class="form-group col-md-2">
						<input type="text" name="refrigerateur_id" id="refrigerateur_id" value="" hidden="true"/>
					</div>
					<div class="form-group col-md-6">
						<label for="customRange1">Min temperature:</label>
						<input type="range" min="-5" max="5" step="1" list="steplist" name="min_temperature" value="0" id="customRange1">
						<datalist id="steplist">
						    <option>-5</option>
							<option>-4</option>
							<option>-3</option>
							<option>-2</option>
							<option>-1</option>
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</datalist>
					</div>
					<div class="form-group col-md-6">
						<label for="customRange2">Max temperature:</label>
						<input type="range" min="-5" max="5" step="1" list="steplist" name="max_temperature" value="0" id="customRange2">
						<datalist id="steplist">
						    <option>-5</option>
							<option>-4</option>
							<option>-3</option>
							<option>-2</option>
							<option>-1</option>
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</datalist>
					</div>
				</div>
				<div class="form-row text-center">
					<div class="form-group col-md-12">
						<input type="submit" name="save_refrigerateur_temperature" class="btn btn-success btn-block" value="Save Refrigerateur Temperature">
					</div>
				</div>
			  </form>
		  </div>
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
	    $(".call-modal").click(function(){
			$(".modal-temperature-body #refrigerateur_code").val($(this).data("code"));
			$(".modal-temperature-body #refrigerateur_id").val($(this).data("id"));
			$("#modalTemperature").modal("show");
		});
		
		});
		</script>';?>
	
</main>




<?php include('includes/footer.php'); ?>
