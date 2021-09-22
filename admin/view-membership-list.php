<?php include 'header.php'; ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Resident Record</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Resident List</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-bar mr-1"></i>
          List of Residents
        </h3>
      </div>
      <div class="card-body">
        
        <table id="membersTable" class="table table-bordered table-hover text-nowrap table-sm">
          <thead>
          <tr>
            <th class="table-plus datatable-nosort" >No</th>
            <th>Membership Name</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Details</th>
            <th>Date Added</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>

            <?php

              $membershipPlan = $connection->query("SELECT * FROM membership_plans");
              $number = 1;
              while($membershipPlanRow = $membershipPlan->fetch_array()){
              
            ?>
            <tr>
              <td> <?= $number++; ?> </td>
              <td> <?= $membershipPlanRow['membership_name']; ?> </td>
              <td> <?= $membershipPlanRow['price']; ?> </td>
              <td> <?= $membershipPlanRow['duration']; ?> </td>
              <td> <?= $membershipPlanRow['details']; ?> </td>
              <td> <?= $membershipPlanRow['created_at']; ?> </td>
              <td>

                <!-- View -->
                <button class="btn btn-primary btn-sm viewResident" data-tooltip="tooltip" title="Click to View" data-id="<?php echo urlencode(base64_encode($residentRow['id'])); ?>"><i class="fas fa-eye"></i></button>

                <!-- Edit -->
                <button class="btn btn-success btn-sm editResident" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo urlencode(base64_encode($residentRow['id'])); ?>"><i class="fas fa-edit"></i></button>

                <!-- Delete -->
                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
  </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#membersTable').DataTable({
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