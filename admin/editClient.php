<?php 

  include 'header.php'; 

  $id = mysqli_real_escape_string($connection, $_GET['id']);

  $client_id = urldecode(base64_decode($id));

  $client = $connection->query("SELECT * FROM client WHERE id='$client_id'");
  $clientRow = $client->fetch_array();

  $birthDate = new DateTime($clientRow['dateofbirth']);
  $age = $birthDate->diff(new DateTime);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Client</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Edit Client</li>
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
      
        <div class="col-lg-4 col-md-4">
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <form action="" method="POST" enctype="multipart/form-data" id="updateClientForm">
              <div class="text-center">
                <?php
                  if ($clientRow['picture'] == "none" || $clientRow['picture'] == NULL) {
                    $updatePictureDisplay = "no_image.png";
                  }else {
                    $updatePictureDisplay = $clientRow['picture'];
                  }
                ?>
                <img id="picture_display" class="profile-user-img img-fluid img-circle" src="../images/client/<?php echo $updatePictureDisplay; ?>" style="width: 200px; display: block; margin-right: auto; margin-left: auto;">
              </div>
              <br>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <label>Upload Picture</label>
                  <div class="custom-file">
                    <input type="file" name="picture" id="picture" class="custom-file-input form-control-sm" accept="image/*">
                    <label class="custom-file-label">Choose file</label>
                  </div>
                </li>
              </ul>
            </div>
          </div><!-- /.card-body -->
        </div><!-- /.col -->

        <div class="col-lg-8">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h4 class="card-title">Client Form</h4>

              <div class="card-tools">
                <span>Client ID - <?= $clientRow['client_id']; ?></span>
              </div>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <span><b>First Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="firstname" value="<?= $clientRow['firstname']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Middle Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="middlename" value="<?= $clientRow['middlename']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Last Name</b></span>
                    <input type="text" class="form-control form-control-sm" name="lastname" value="<?= $clientRow['lastname']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Phone Number</b></span>
                    <input type="text" class="form-control form-control-sm" name="contactNumber" value="<?= $clientRow['contact_no']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Gender</b></span><br>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="gender" id="gendermale" class="custom-control-input" value="Male" <?php echo ($clientRow['gender'] == 'Male') ? 'checked' : null; ?> required>
                      <label class="custom-control-label" for="gendermale">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="gender" id="genderfemale" class="custom-control-input" value="Female" <?php echo ($clientRow['gender'] == 'Female') ? 'checked' : null; ?> required>
                      <label class="custom-control-label" for="genderfemale">Female</label>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-lg-6">
                  <div class="form-group">
                    <span><b>Birth Date</b></span>
                    <input type="date" class="form-control form-control-sm" name="birthDate" value="<?= $clientRow['dateofbirth']; ?>">
                  </div>
                  <div class="form-group">
                    <span><b>Address</b></span>
                    <textarea class="form-control" rows="4" name="address"><?= $clientRow['address']; ?></textarea>
                  </div>
                </div><!-- /.col -->

                <div class="col-2">
                  <div class="form-group">
                    <input type="hidden" name="update_id" id="update_id" value="<?php echo $clientRow['id']; ?>">
                    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Update</button>
                  </div>
                </div><!-- /.col -->

              </div><!-- /.row -->
              </form>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->
<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){


    $('#addMemberForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/addMember.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Contact Taken") {
            swal({
              title: "Contact Number already exist.",
              icon: "warning"
            });

          }else if (data == "Insert Failed") {
            swal({
              title: "Failed to add new member. Please try again later.",
              icon: "error"
            });

          }else if (data == "Image failed") {
            swal({
              title: "Failed to upload image. Please try another one.",
              icon: "error"
            });

          }else {
            swal({
              title: "New member has been added.",
              icon: "success"
            }).then(function(){
              location.reload();
            });
          }
        }
      })
    });

    $('#updateClientForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/updateClient.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Failed") {
            swal({
              title: "Failed to update client's information. Please try again later.",
              icon: "error"
            });

          }else {
            swal({
              title: "Client's information has been updated.",
              icon: "success"
            }).then(function(){
              location.href = "client-list.php";
            });
          }
        }
      })
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

  });
</script>