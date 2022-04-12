<?php
require_once('../include/database.php');
require_once('../Gateway/tripGateway.php');
require_once('../Gateway/userGateway.php');
session_start();

$db = new Database();
$link = $db->connect();

$tripGateway = new TripGateway();
$trips = $tripGateway->get_all_trips($link);
$userGateway = new UserGateway();

$fullname = $userGateway->getFullName($link, $_SESSION['user_id']);


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>My Trips</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../bootstrap/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../bootstrap/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/personal.css">

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
            <h6 class="collapse-header">Trip Functions</h6>
            <a class="collapse-item" href="viewtrips.php">View My Trips</a>
            <a class="collapse-item" href="createtrip.php">Create a Trip</a>
            <a class="collapse-item" href="edittrip.php">Edit a Trip</a>
            <a class="collapse-item" href="deletetrip.php">Delete a Trip</a>
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

          <div class="card border-0 bg-transparent pb-4">
            <div class="row">
              <div class="col">
                <h1 class="h4 text-gray-900 pt-4">My Trips </h1>
              </div>
            </div>
            <hr class="sidebar-divider pb-0 mb-0">
          </div>
          <!-- beginning of row -->

          <div class="row">
            <?php

            if (mysqli_num_rows($trips) == 0) {
              echo "<p class='center'><b>Unfortunately, you do not have any trips planned at the moment.</b></p>";
            } else {
              foreach ($trips as $trip) {
                echo ('<div class="col-xl-4 mb-4">
                <a class="card shadow py-2 text-decoration-none" href="#">');
                echo ('
                <div class="card-body">
                  <div class="row">
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="font-weight-bold text-uppercase mb-1">');
                echo ($trip['name']);
                echo ('</div>
                        <div class="small">Departure Country: ');
                echo ($trip['depart_country']);
                echo ('</div>
                        <div class="small">Arrival Country: ');
                echo ($trip['arrival_country']);
                echo ('</div>
                        <div class="small">Last Update: ');
                echo ($trip['last_update']);
                echo ('</div>
                    </div> 
                    <div class="col text-right">
                      <div class="font-weight-bold text-uppercase mb-1">');
                echo round((strtotime($trip['start_date']) - time()) / (60 * 60 * 24) + 1) . " days remaining!";
                echo ($case['case_status']);
                echo ('</div>
                              <div class="small">Departure Date: ');
                echo ($trip['start_date']);
                echo ('</div>
                          <div class="small">End Date: ');
                echo ($trip['end_date']);
                echo ('</div>
                          <div class="small text-danger font-weight-bold">Documents linked: ');
                echo ($numDocs);
                echo ('</div>
                    </div> 
                </div>
              </div>
              </a>
              <a type="button" href= "trip.php');
                echo ('?tid=' . $trip['id']);
                echo ('" class="p-0 pb-1 small text-danger btn btn-block btn-light border-bottom"><i class="fa fa-arrow-right"></i></a>
      
              </div> <!-- end column 1 -->');
              }
            }
            ?>

          </div> <!-- end row -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->

      <!-- End of Footer -->

    </div>
  </div>
  </div>
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
    <script src="https://kit.fontawesome.com/0ce3f6901e.js" crossorigin="anonymous"></script>


</body>

</html>