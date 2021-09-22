<?php 

  include 'header.php';

  $client_id = mysqli_real_escape_string($connection, $_GET['client_id']);
  $client_id = urldecode(base64_decode($client_id));

  $client = $connection->query("SELECT * FROM client WHERE client_id = '$client_id'");
  $clientRow = $client->fetch_array();

?>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Client Body Mass Index</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Client Body Mass Index</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="card card-warning card-outline">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-bar mr-1"></i>
          List of <b><?= $clientRow['lastname'].", ".$clientRow['firstname']." ".$clientRow['middlename']; ?></b> Body Mass Index
        </h3>
        <div class="card-tools">
          <a href="client-management.php" class="btn btn-danger btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Go Back</a>
        </div>
      </div>
      <div class="card-body">
        <table id="clientTable" class="table table-bordered table-hover text-nowrap table-sm">
          <thead>
          <tr>
            <th class="table-plus datatable-nosort" >No</th>
            <th>Name</th>
            <th>Height</th>
            <th>Weight</th>
            <th>BMI</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
            <?php

              $client_bmi = $connection->query("SELECT * FROM client_bmi WHERE client_id = '$client_id' ORDER BY created_at DESC");
              $number = 1;
              while($client_bmi_row = $client_bmi->fetch_array()){
              
            ?>
            <tr>
              <td> <?= $number++; ?> </td>
              <td> <?= $clientRow['lastname'].", ".$clientRow['firstname']." ".$clientRow['middlename']; ?> </td>
              <td> <?= $client_bmi_row['height']; ?> </td>
              <td> <?= $client_bmi_row['weight']; ?> </td>
              <td> <?= $client_bmi_row['bmi']; ?> </td>
              <td> <?= date('M d, Y', strtotime($client_bmi_row['created_at'])); ?> </td>
              <td>
                
                <!-- View -->
                <button class="btn btn-primary btn-sm viewRecommendations" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $client_bmi_row['id']; ?>"><i class="fas fa-eye"></i></button>

              </td>
            </tr>

            <div class="modal fade" id="viewRecommendations<?php echo $client_bmi_row['id']; ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">
                      <i class="fas fa-dumbbell"></i> Workout and Diet Recommendations
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  </div><!-- /.modal-body -->
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <?php } ?>
          </tbody>
        </table>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->
<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.viewClient', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'viewClient.php?id='+id;
    });

    $(document).on('click', '.viewRecommendations', function(){
      var id = $(this).attr('data-id');
      $('#viewRecommendations'+id).modal('show');
    });

    $(document).on('click', '.insertComment', function(){
      var id = $(this).attr('data-id');
      $('#insertComment'+id).modal('show');
    });

    $('#clientTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    //calculate BMI
    $("#height, #weight").keyup(function(){
      var totalBMI = 0;
      var finalTotal = 0;
      var height = Number($("#height").val());
      var weight = Number($("#weight").val());
      var totalBMI = weight/(height/100*height/100);
      var finalTotal = totalBMI.toFixed(1);
      $('#result').val(finalTotal);
    });

    $('#addRecommendationForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/addRecommendations.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Taken") {
            swal({
              title: "Failed to add new recommendations.",
              icon: "error"
            });

          }else {
            swal({
              title: "New recommendations has been added.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

  });
</script>