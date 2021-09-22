	  </div><!-- /.content-wrapper -->
	  <!-- Main Footer -->
	  <footer class="main-footer">
	    <!-- To the right -->
	    <!-- <div class="float-right d-none d-sm-inline">
	      Anything you want
	    </div> -->
	    <!-- Default to the left -->
	    <strong>(O-GHIMS) - Online Gym Information With Health Monitoring System</strong>
	  </footer>
	</div>
	<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- Sweetalert -->
<script src="../assets/sweetalert/sweetalert.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/vendors/easypiechart/jquery.easy-pie-chart.js"></script>

<!-- fullCalendar 2.2.5 -->
<script src="../assets/plugins/moment/moment.min.js"></script>
<script src="../assets/plugins/fullcalendar/main.min.js"></script>
<script src="../assets/plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="../assets/plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="../assets/plugins/fullcalendar-interaction/main.min.js"></script>
<script src="../assets/plugins/fullcalendar-bootstrap/main.min.js"></script>

<script>
$(function() {
    // Easy pie charts
    $('.chart').easyPieChart({animate: 1000});
});
</script>

<!-- Summernote -->
<script src="../assets/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<script>
  $(document).ready(function() {

        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false,
        });

        $('#logoutButton').click(function(){
          var type = $(this).attr('data-type');
          if (type == "admin") {
            return window.location.replace('../includes/logout.php');

          }else {
            return window.location.replace('../includes/logout.php');
          }
        });
        

        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#picture_display').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }

        $("#picture").change(function(){
          $('#picture_display').show();
          readURL(this);
        });
    });  
</script>

</body>
</html>
