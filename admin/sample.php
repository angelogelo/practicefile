<?php include 'header.php'; ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Subscription</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Add Subscription</li>
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
      <div class="col-lg-6">
        <form action="" method="POST" enctype="multipart/form-data" id="addSubscriptionForm">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h4 class="card-title">Subscription Form</h4>
            </div>
            <div class="card-body">

              <div class="form-group">
                <span><b>Client</b></span>
                <select name="respondent" class="form-control form-control-sm" required>
                  <option selected="" disabled="" value="">- - - Select Client - - -</option>
                  <?php  
                    $member = $connection->query("SELECT * FROM members");
                    if ($member->num_rows < 1) {
                      ?>
                        <option disabled>No member available</option>
                      <?php
                    }else {
                      while ($memberRow = $member->fetch_array()) {
                        ?>
                          <option value="<?= $memberRow['member_id']; ?>">
                            <?= $memberRow['firstname']." ".$memberRow['middlename']." ".$memberRow['lastname']; ?>
                          </option>
                        <?php
                      }
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <span><b>Price</b></span>
                <input type="number" class="form-control form-control-sm" name="price" id="price" placeholder="How Much?" required readonly>
              </div>
            </div><!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            </div>
          </div><!-- /.card -->
        </form>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content -->
<?php include 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){


    // $("#plan").keyup(function(){
    //   var price = 0;
    //   var plan = Number($("#plan").val());

    //   var price = plan*300;
    //   var total = price + '.00';

    //   $('#price').val(total);
    // });


    $('#addSubscriptionForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: "../includes/addSubscription.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          console.log(data);
          if (data == "Taken") {
            swal({
              title: "Failed to add new plan. Plan Already Exist.",
              icon: "error"
            });

          }else {
            swal({
              title: "New subscription has been added.",
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