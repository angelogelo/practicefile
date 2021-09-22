<?php include 'header.php' ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
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

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <?php  
              $members = $connection->query("SELECT * FROM client WHERE status LIKE '%Active%'");
            ?>
            <h3><?php echo $members->num_rows; ?></h3>

            <p>Total Client</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-circle"></i>
          </div>
          <a href="residents.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <?php  
              $members = $connection->query("SELECT * FROM coach WHERE status LIKE '%Active%'");
            ?>
            <h3><?php echo $members->num_rows; ?></h3>

            <p>Total Coach</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <a href="residents.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->

    </div><!-- ./row -->

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-bar mr-1"></i>
          List of Coach
        </h3>
      </div>

      <div class="card-body">
        <table id="officialTable" class="table table-bordered table-hover text-nowrap table-sm">
          <thead>
          <tr>
            <th class="table-plus datatable-nosort" >No</th>
            <th>Status</th>
            <th>Photo</th>
            <th>Coach ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Skills</th>
          </tr>
          </thead>
          <tbody>
            <?php

              $coach = $connection->query("SELECT * FROM coach");
              $number = 1;
              while($coachRow = $coach->fetch_array()){

                $birthDate = new DateTime($coachRow['birthDate']);
                $age = $birthDate->diff(new DateTime);

                $coachSkill = $connection->query("SELECT * FROM skills WHERE id = '".$coachRow['coach_skills_id']."'");
                $coachSkillRow = $coachSkill->fetch_array();
                
            ?>
            <tr>
              <td> <?= $number++; ?> </td>
              <td> 

                <?php  
                  if ($coachRow['status'] == "active") {
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
                  if ($coachRow['picture'] == "none" || $coachRow['picture'] == NULL) {
                    ?>
                      <img src="../images/no_image.png" class="img-fluid rounded" style="width: 50px; height: 50px;">
                    <?php
                  }else {
                    ?>
                      <img src="../images/coach/<?php echo $coachRow['picture']; ?>" class="img-fluid rounded" style="width: 50px; height: 50px;">
                    <?php
                  }
                ?>

              </td>
              <td> <?= $coachRow['coach_id']; ?> </td>
              <td> <?php echo $coachRow['lastname'].", ".$coachRow['firstname']." ".$coachRow['middlename']; ?> </td>
              <td> <?= $age->y; ?> </td>
              <td> <?= $coachSkillRow['skills_name']; ?> </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div><!-- /.card-body -->
    </div><!-- /.card -->

  </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script type="text/javascript">
  $(document).ready(function(){

    $('#officialTable').DataTable({
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