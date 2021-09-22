<?php include 'header.php'; ?>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Client Management</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Client Management</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <?php
        $subscriptions = $connection->query("SELECT * FROM subscriptions WHERE coach_id = '".$coachRow['id']."'");
        while($subscriptionsRow = $subscriptions->fetch_array()){

          $client = $connection->query("SELECT * FROM client WHERE client_id = '".$subscriptionsRow['client_id']."'");
          $clientRow = $client->fetch_array();
      ?>
      <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-warning">
            <h3 class="widget-user-username"><?= $clientRow['firstname']." ".$clientRow['middlename']." ".$clientRow['lastname']; ?></h3>
            <h5 class="widget-user-desc"></h5>
          </div>
          <div class="widget-user-image">
            <?php  
              if ($clientRow['picture'] == "none" || $clientRow['picture'] == NULL) {
                ?>
                  <img src="../images/no_image.png" class="img-circle elevation-2">
                <?php
              }else {
                ?>
                  <img src="../images/client/<?php echo $clientRow['picture']; ?>" class="img-circle elevation-2">
                <?php
              }
            ?>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header"><b>Status</b></h5>
                  <span class="description-text">
                    <?php  
                      if ($clientRow['status'] == "active") {
                        ?>
                          <i class="fas fa-circle text-success"></i>
                        <?php
                      }else {
                        ?>
                          <i class="fas fa-circle text-danger"></i>
                        <?php
                      }
                    ?>
                  </span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->
              
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header"><b>Start Date</b></h5>
                  <span class="description-text"><b><?= date('M d, Y', strtotime($subscriptionsRow['start_date'])); ?></b></span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->

              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header"><b>View</b></h5>
                  <a class="viewClient" data-tooltip="tooltip" title="Click to View" data-client_id="<?php echo urlencode(base64_encode($clientRow['client_id'])); ?>"><i class="fas fa-eye text-primary"></i></a>
                </div><!-- /.description-block -->
              </div>
            </div><!-- /.row -->
          </div>
        </div><!-- /.widget-user -->
      </div><!-- /.col -->
      <?php } ?>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->
<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '.viewClient', function(){
      var client_id = $(this).attr('data-client_id');
      window.location.href = 'view-client.php?client_id='+client_id;
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