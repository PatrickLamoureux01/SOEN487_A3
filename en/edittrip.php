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


    <title>Create Trip</title>

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
                <a class="nav-link" href="../en/viewtrips.php">
                    <i class="fa-solid fa-plane-departure"></i>
                    <span>View My Trips</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../en/createtrip.php">
                    <i class="fa-solid fa-plus"></i>
                    <span>Create a Trip</span>
                </a>
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
                        <input type="hidden" id="action" name="action" value="create"></input>
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
        <script src="https://kit.fontawesome.com/0ce3f6901e.js" crossorigin="anonymous"></script>
        <script src="../bootstrap/js/personal.js"></script>


</body>

</html>