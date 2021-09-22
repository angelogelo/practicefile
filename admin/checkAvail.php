<?php 

	include 'header.php';

	$id = mysqli_real_escape_string($connection, $_GET['id']);
	$id = urldecode(base64_decode($id));

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Check Who Has Avail This Membership Plan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Check Who Has Avail This Membership Plan</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
  	<div class="col-lg-6">
		<div class="card card-warning card-outline">
		    <div class="card-body">
		    	<table id="clientTable" class="table table-bordered table-hover text-nowrap table-sm">
				  <thead>
				  <tr>
				    <th class="table-plus datatable-nosort" >No</th>
				    <th>Name</th>
				  </tr>
				  </thead>
				  <tbody>
				    <?php
				      $selectClient = $connection->query("SELECT * FROM subscriptions WHERE membership_id = '$id' ");
				      $number = 1;
				      while($selectClientRow = $selectClient->fetch_array()){
				        
				        $client = $connection->query("SELECT * FROM client WHERE client_id = '".$selectClientRow['client_id']."'");
				        $clientRow = $client->fetch_array();

				        $fullname = $clientRow['firstname']." ".$clientRow['middlename']." ".$clientRow['lastname'];
				    ?>
				    <tr>
				      <td><?= $number++; ?></td>
				      <td><?= $fullname; ?></td>
				    </tr>
					<?php } ?>
				  </tbody>
				</table>
				<br>
				<a href="membership-plan.php" class="btn btn-danger btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Go Back</a>
		    </div>
		</div>
	</div>
  </div><!-- /.container-fluid -->
</div><!-- /.content -->


<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#clientTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


