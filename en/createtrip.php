<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>Create Trip</title>

  <!-- Custom fonts for this template-->
  <link href="../bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../_style\css\font.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link rel="stylesheet" href="../bootstrap/css/sb-admin-2.css" />


  <!-- Custom styles for this page -->
  <link href="../bootstrap/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="../bootstrap/css/personal.css" rel="stylesheet">

  <script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
        <i class="fa-solid fa-earth-americas"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Welcome, <?php echo $fullname; ?>!</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
        <i class="fa-solid fa-globe"></i>
        <span>LETS GETAWAY</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Actions
</div>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrips" aria-expanded="true" aria-controls="collapseTrips">
        <i class="fa-solid fa-plane-departure"></i>
        <span>Trips</span>
    </a>
    <div id="collapseTrips" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Trip Functions:</h6>
            <a class="collapse-item" href="viewtrips.php">View My Trips</a>
            <a class="collapse-item" href="createtrip.php">Create a Trip</a>
            <a class="collapse-item" href="edittrip.php">Edit a Trip</a>
            <a class="collapse-item" href="deletetrip.php">Delete a Trip</a>
        </div>
    </div>
</li>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLogs" aria-expanded="true" aria-controls="collapseLogs">
        <i class="fas fa-scroll"></i>
        <span>Change Logs</span>
    </a>
    <div id="collapseLogs" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Logging Functions:</h6>
            <a class="collapse-item" href="view-logs.php">View Change Logs</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="../en/login.php">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <span>Logout</span>
    </a>
</li>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">



        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
            <h1 class="h3 mb-0 text-gray-800">You're on your way to creating your trip!</h1>
          </div>

          <form method="post" action="../Controller/tripController.php">
            <div class="form-group">
              <label for="trip_name">Trip name</label>
              <input id="trip_name" name="trip_name" type="text" class="form-control" placeholder="Enter your trip's name">
            </div>
            <div class="form-group">
              <label for="dep_country">Where are you leaving from?</label>
              <select name="dep_country" id="dep_country" class="form-control"></select>
            </div>
            <div class="form-group">
              <label for="arv_country">Where are you going?</label>
              <select name="arv_country" id="arv_country" class="form-control"></select>
            </div>
            <div class="form-group">
              <label for="trip_start_date" class="my-1 mr-2">Trip start date</label>
              <input type="date" id="trip_start_date" name="trip_start_date" class="form-control">
            </div>
            <div class="form-group">
              <label for="trip_end_date" class="my-1 mr-2">Trip end date</label>
              <input type="date" id="trip_end_date" name="trip_end_date" class="form-control">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Create Trip</button>
          </form>

          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; SOEN487 A3 2022</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->

    <script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../bootstrap/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../bootstrap/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../bootstrap/js/demo/chart-area-demo.js"></script>
    <script src="../bootstrap/js/demo/chart-pie-demo.js"></script>
    <script src="../bootstrap/js/personal.js"></script>


</body>

</html>
