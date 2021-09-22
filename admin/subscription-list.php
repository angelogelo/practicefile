<?php include 'header.php'; ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Subscription List</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Subscription List</li>
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
          List of Subscription
        </h3>
      </div>
      <div class="card-body">
        
        <table id="membersTable" class="table table-bordered table-hover text-nowrap table-sm">
          <thead>
          <tr>
            <th class="table-plus datatable-nosort" >No</th>
            <th>Client Name</th>
            <th>Coach Name</th>
            <th>Membership Name</th>
            <th>Membership Cost</th><!-- 
            <th>Registration Date</th>
            <th>Start Date</th>
            <th>End Date</th> -->
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>

            <?php

              $subscription = $connection->query("SELECT * FROM subscriptions");
              $number = 1;
              while($subscriptionRow = $subscription->fetch_array()){

                $coach = $connection->query("SELECT * FROM coach WHERE id = '".$subscriptionRow['coach_id']."'");
                $coachRow = $coach->fetch_array();

                $membership = $connection->query("SELECT * FROM membership_plans WHERE id = '".$subscriptionRow['membership_id']."'");
                $membershipRow = $membership->fetch_array();

                $client = $connection->query("SELECT * FROM client WHERE client_id = '".$subscriptionRow['client_id']."'");
                $clientRow = $client->fetch_array();

                if ($subscriptionRow['coach_id'] == "") {
                  $fullname = "No Coach";
                }else{
                  $fullname = $coachRow['firstname']." ".$coachRow['middlename']." ".$coachRow['lastname'];
                }


                $clientName = $clientRow['firstname']." ".$clientRow['middlename']." ".$clientRow['lastname'];
            ?>
            <tr>
              <td> <?= $number++; ?> </td>
              <td> <?= $clientName; ?> </td>
              <td> <?= $fullname; ?> </td>
              <td> <?= $membershipRow['membership_name']; ?> </td>
              <td> ₱<?= $subscriptionRow['membership_cost']; ?>.00 </td>
              <td>

                <!-- View -->
                <button class="btn btn-primary btn-sm viewSubscription" data-tooltip="tooltip" title="Click to View" data-id="<?php echo $subscriptionRow['id']; ?>"><i class="fas fa-eye"></i></button>

                <!-- Edit -->
                <button class="btn btn-success btn-sm editResident" data-tooltip="tooltip" title="Click to Edit" data-id="<?php echo urlencode(base64_encode($residentRow['id'])); ?>"><i class="fas fa-edit"></i></button>

                <!-- Delete -->
                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>

            <div class="modal fade" id="viewSubscription<?php echo $subscriptionRow['id']; ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">
                      <i class="fas fa-info-circle"></i> Subscription's Information
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
                              <i class="fas fa-info-circle"></i> Coach Info
                            </h4>
                          </div>
                          <div class="card-body box-profile">
                            <div class="form-group">
                              <div class="text-center">
                                <?php  

                                  if ($subscriptionRow['coach_id'] == "") {
                                    ?>
                                      <h3 class="profile-username text-center" style="font-size: 20px;">No Coach</h3>
                                    <?php
                                  }else{
                                    if ($coachRow['picture'] == "none" || $coachRow['picture'] == NULL) {
                                      ?>
                                        <img src="../images/no_image.png" class="profile-user-img img-fluid img-circle">
                                      <?php
                                    }else {
                                      ?>
                                        <img src="../images/coach/<?php echo $coachRow['picture']; ?>" class="profile-user-img img-fluid img-circle">

                                        <h3 class="profile-username text-center" style="font-size: 20px;"><?php echo $coachRow['firstname']." ".$coachRow['middlename']." ".$coachRow['lastname']; ?></h3>

                                      <?php
                                    }
                                  }
                                  
                                ?>
                              </div>
                            </div>
                          </div>
                        </div><!-- /.card-body -->
                      </div><!-- /.col -->

                      <div class="col-lg-8">
                        <div class="card card-warning card-outline">
                          <div class="card-header">
                            <h4 class="card-title">
                              <i class="fas fa-info-circle"></i> Client Info
                            </h4>
                          </div>
                          <div class="card-body">
                            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <i class="fas fa-user-circle text-sm"></i> <b>Client Name</b>
                                  <a class="float-right">
                                    <?= $clientName; ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-dumbbell text-sm"></i> <b>Membership Name</b>
                                  <a class="float-right">
                                    <?= $membershipRow['membership_name']; ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-money-bill text-sm"></i> <b>Membership Cost</b>
                                  <a class="float-right">
                                    ₱<?= $subscriptionRow['membership_cost']; ?>.00
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-calendar-alt text-sm"></i> <b>Registration Date</b>
                                  <a class="float-right">
                                    <?= date('M d, Y', strtotime($subscriptionRow['registration_date'])); ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-calendar-alt text-sm"></i> <b>Start Date</b>
                                  <a class="float-right">
                                    <?= date('M d, Y', strtotime($subscriptionRow['start_date'])); ?>
                                  </a>
                              </li>
                              <li class="list-group-item">
                                <i class="fas fa-calendar-alt text-sm"></i> <b>End Date</b>
                                  <a class="float-right">
                                    <?= date('M d, Y', strtotime($subscriptionRow['end_date'])); ?>
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

    $(document).on('click', '.viewSubscription', function(){
      var id = $(this).attr('data-id');
      $('#viewSubscription'+id).modal('show');
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