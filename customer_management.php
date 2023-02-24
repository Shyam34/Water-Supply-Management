<div class="container">
	
	<button type="button" data-toggle="modal" data-target="#AddCustomer" class="btn btn-primary">Add New Customer</button>

	<div class="row">
		<div class="modal fade" id="AddCustomer" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          Add New Customer
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <label>Name</label>
            <input type="text" name="Name" required class="form-control">
            <label>Email</label>
            <input type="email" name="Email" required class="form-control">
            <label>Cell No</label>
            <input type="number" name="PhoneNo" required class="form-control">
            <label>Address</label>
            <input type="text" name="Address" required class="form-control"><br><br>
            <input type="submit" name="AddCustomer" value="Add Customer" class="btn btn-success btn-sm pull-right"><br><br>
          </form>
        </div>
      </div>
      
    </div>
  </div>

  		


  		<div class="col-sm-9" style="margin-top: 20px">
  			<?php 
		  		if (isset($_GET['Success'])) { ?>
		  		 	<div class="alert alert-success alert-dismissible">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <?=$_GET['Success']?>
					</div>
		  		<?php  } ?>
		  		<?php 
		  		if (isset($_GET['Danger'])) { ?>
		  		 	<div class="alert alert-danger alert-dismissible">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <?=$_GET['Danger']?>
					</div>
		  		<?php  } ?>
  			<table class="table table-striped table-bordered" id="table">
  				<thead>
  					<th>ID</th>
  					<th>Name</th>
  					<th>Email</th>
  					<th>PhoneNoNo</th>
  					<th>Address</th>
  					<th>Update</th>
  					<th>Delete</th>
  				</thead>
  				<tbody>

  				<?php 

  				$query = mysqli_query($con, "SELECT * FROM customers");

  				while ($customer =  mysqli_fetch_array($query)) {
  					echo "<tr>
                              <td>$customer[ID]</td>
                              <td>$customer[Name]</td>
                              <td>$customer[Email]</td>
                              <td>$customer[PhoneNo]</td>
                              <td>$customer[Address]</td>
                              <td><a href='index.php?Page=customer_management&Update=true&ID=$customer[ID]&Name=$customer[Name]&Email=$customer[Email]&PhoneNo=$customer[PhoneNo]
                              &address=$customer[address]' class='btn btn-info btn-sm'>Update</a></td>
                              <td><a href='index.php?Page=customer_management&Delete=true&ID=$customer[ID]' class='btn btn-danger btn-sm'>Delete</a></td>
  					         </tr>";
  				}

  				?>
  			</tbody>
  			</table>
  		</div>

  		<?php if (isset($_GET['Update'])): ?>

  			<div class="col-sm-3">
  				<form action="" method="POST">
  					<label>Name</label>
  				<input type="hidden" name="ID" value="<?=$_GET['ID']?>">
	            <input type="text" name="Name" required class="form-control" value="<?=$_GET['Name']?>">
	            <label>Email</label>
	            <input type="email" name="Email" required class="form-control" value="<?=$_GET['Email']?>">
	            <label>Cell No</label>
	            <input type="text" name="Number" required class="form-control" value="<?=$_GET['PhoneNo']?>">
	            <label>Address</label>
	            <input type="text" name="Address" required class="form-control" value="<?=$_GET['Address']?>"><br><br>
	            <input type="submit" name="UpdateCustomer" value="Update Customer" class="btn btn-primary btn-sm pull-right"><br><br>
  				</form>
  			</div>
  			
  		<?php endif ?>



	</div>
</div>

<?php 

	if (isset($_POST['AddCustomer'])) {
	 	$Name = $_POST['Name'];
	 	$Email = $_POST['Email'];
	 	$PhoneNo = $_POST['Number'];
	 	$Address = $_POST['Address'];

	 	$result = mysqli_query($con, "INSERT INTO customers SET Name = '$Name', Email = '$Email', PhoneNo = '$PhoneNo', Address = '$Address', Billed_On = NOW() ");

	 	if ($result) {
	 		echo "<script>
	 		         window.location.href='index.php?Page=customer_management&Success=Customer Added';
	 		       </script>";
	 	} else {
	 		echo "Error". mysqli_error($con);
	 	}
	 	
	 }


	 if (isset($_POST['UpdateCustomer'])) {
	 	$ID = $_POST['ID'];
	 	$Name = $_POST['Name'];
	 	$Email = $_POST['Email'];
	 	$PhoneNo = $_POST['Number'];
	 	$Address = $_POST['Address'];

	 	$result = mysqli_query($con, "UPDATE customers SET Name = '$Name', Email = '$Email', PhoneNo = '$PhoneNo', Address = '$Address' WHERE ID = '$ID' ");

	 	if ($result) {
	 		echo "<script>
	 		         window.location.href='index.php?Page=customer_management&Success=Customer Record Updated';
	 		       </script>";
	 	} else {
	 		echo "Error". mysqli_error($con);
	 	}
	 	
	 }


	 if (isset($_GET['Delete'])) {
	 	$ID = $_GET['ID'];

	 	$result = mysqli_query($con, "DELETE FROM customers WHERE ID = '$ID'");
	 	if ($result) {
	 		echo "<script>
	 		         window.location.href='index.php?Page=customer_management&Danger=Customer Record Deleted';
	 		       </script>";
	 	} else {
	 		echo "Error". mysqli_error($con);
	 	}

	 }




	  ?>