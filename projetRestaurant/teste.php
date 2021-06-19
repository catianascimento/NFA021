<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

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
      <table class="table table-bordered table-striped" >
				 <thead class="thead-dark">
				  <tr class="text-center">
					<th>Min</th>
					<th>Max</th>
					<th>Datetime</th>
					<th>Refrigerateur Id</th>
				  </tr>
				</thead>
				<tbody id="myTable">
				  <?php
				  $refrigerateurId = $_POST['refrigerateurId'];
				  $query = "select * from refrigerateur_temperature rt left join refrigerateur r on rt.refrigerateur_id = r.id where r.id=".$refrigerateurId;
				  $result_temperature = mysqli_query($conn, $query);    

				  while($row = mysqli_fetch_assoc($result_temperature)) { ?>
				  <tr>
					<td class="text-center"><?php echo $row['min_temperature']; ?></td>
					<td class="text-center"><?php echo $row['max_temperature']; ?></td>
					<td class="text-center"><?php echo $row['date_time']; ?></td>
					<td class="text-center"><?php echo $row['refrigerateur_id']; ?></td>
				  </tr>
				  <?php } ?>
		    
				</tbody>
			  </table>
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
	    $("#temperature").click(function(){
			$(".modal-body #refrigerateurCode").val($(this).data("code"));
			$("#modalTemperature").modal("show");
		});
		$("#temperatureId").click(function(){
			$(".modal-body #refrigerateurId").val($(this).data("id"));
			$("#modalListerTemperature").modal("show");
		});
		});
		</script>';?>
	
</main>




<?php include('includes/footer.php'); ?>
