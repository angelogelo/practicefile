<?php include 'header.php'; ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Client List</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Client List</li>
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
          List of Client
        </h3>
      </div>
      <div class="card-body">
        
        <table id="membersTable" class="table table-bordered table-hover text-nowrap table-sm">
          <thead>
          <tr>
            <th class="table-plus datatable-nosort" >No</th>
            <th>Status</th>
            <th>Photo</th>
            <th>Member ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>BMI</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>

            <?php

              $client = $connection->query("SELECT * FROM client");
              $number = 1;
              while($clientRow = $client->fetch_array()){

                $birthDate = new DateTime($clientRow['birthDate']);
                $age = $birthDate->diff(new DateTime);
              
            ?>
            <tr>
              <td> <?= $number++; ?> </td>
              <td> 

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
                  

              </td>
              <td> 

                <?php  
                  if ($clientRow['picture'] == "none" || $clientRow['picture'] == NULL) {
                    ?>
                      <img src="../images/no_image.png" class="img-fluid rounded" style="width: 50px; height: 50px;">
                    <?php
                  }else {
                    ?>
                      <img src="../images/client/<?php echo $clientRow['picture']; ?>" class="img-fluid rounded" style="width: 50px; height: 50px;">
                    <?php
                  }
                ?>

              </td>
              <td> <?= $clientRow['client_id']; ?> </td>
              <td> <?php echo $clientRow['lastname'].", ".$clientRow['firstname']." ".$clientRow['middlename']; ?> </td>
              <td> <?= $age->y; ?> </td>
              <td> <?= $clientRow['bmi']; ?></td>
              <td>

                <!-- View -->
                <button class="btn btn-primary btn-sm viewClient" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $clientRow['id']; ?>"><i class="fas fa-eye"></i></button>

                <!-- Edit -->
                <button class="btn btn-success btn-sm editClient" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo urlencode(base64_encode($clientRow['id'])); ?>"><i class="fas fa-edit"></i></button>

                <!-- Delete -->
                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>


            <div class="modal fade" id="viewClient<?php echo $clientRow['id']; ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">
                      <i class="fas fa-info-circle"></i> Client's Information
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="card card-warning card-outline">
                          <div class="modal-header">
                            <h4 class="modal-title">
                              <i class="fas fa-info-circle"></i> About Me
                            </h4>
                          </div>
                          <div class="card-body box-profile">
                            <div class="form-group">
                              <div class="text-center">
                                <?php  
                                  if ($clientRow['picture'] == "none" || $clientRow['picture'] == NULL) {
                                    ?>
                                      <img src="../images/no_image.png" class="profile-user-img img-fluid img-circle">
                                    <?php
                                  }else {
                                    ?>
                                      <img src="../images/client/<?php echo $clientRow['picture']; ?>" class="profile-user-img img-fluid img-circle">
                                    <?php
                                  }
                                ?>
                              </div>

                              <h3 class="profile-username text-center" style="font-size: 20px;"><?php echo $clientRow['firstname']." ".$clientRow['middlename']." ".$clientRow['lastname']; ?></h3>

                              <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                  <i class="fas fa-info text-sm"></i> <b>Status</b>
                                  <a class="float-right"><?php  
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
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div><!-- /.card-body -->
                      </div><!-- /.col -->

                      <div class="col-lg-8">
                        <div class="card card-warning card-outline">
                          <div class="card-header">
                            <h4 class="card-title">Contact Details</h4>
                          </div>
                          <div class="card-body">
                            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <i class="fas fa-venus-mars text-sm"></i> <b>Gender</b>
                                  <a class="float-right">
                                    <?= $clientRow['gender']; ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-phone text-sm"></i> <b>Phone Number</b>
                                <a class="float-right">
                                  <?= $clientRow['contact_no']; ?>
                                </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-ruler-vertical text-sm"></i> <b>Height</b>
                                <a class="float-right">
                                  <?= $clientRow['height']; ?> cm
                                </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-weight text-sm"></i> <b>Weight</b>
                                <a class="float-right">
                                  <?= $clientRow['weight']; ?> kg
                                </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-child text-sm"></i> <b>BMI</b>
                                <a class="float-right">
                                  <?= $clientRow['bmi']; ?>
                                </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-map-marked-alt text-sm"></i> <b>Address</b>
                                <a class="float-right">
                                  <?= $clientRow['address']; ?>
                                </a>
                              </li>
                            </ul>

                          </div><!-- /.card-body -->
                        </div><!-- /.card -->
                      </div><!-- /.col -->

                    </div><!-- /.row -->
                  </div><!-- /.modal-body -->
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

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

    $(document).on('click', '.viewClient', function(){
      var id = $(this).attr('data-id');
      $('#viewClient'+id).modal('show');
    });

    $(document).on('click', '.editClient', function(){
      var id = $(this).attr('data-id');
      window.location.href = 'editClient.php?id='+id;
    });

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