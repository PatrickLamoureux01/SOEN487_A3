<?php
require_once('../include/database.php');
require_once('../Gateway/userGateway.php');
session_start();
$db = new Database();
$link = $db->connect();

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

    <title>Getaway Dashboard</title>

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

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <?php
                            if (date('H') >= "12") {
                                echo "Good Afternoon, $fullname!";
                            } else {
                                echo "Good Morning, $fullname!";
                            }
                            ?></h1>
                    </div>

                    <div class="row" style="text-align:center;">
                        <!-- Content Row -->
                        <div class="col-md-4">
                            <i class="fa-solid fa-plane-departure" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>VIEW MY TRIPS</strong></p>
                            <br>
                            <br>
                            <p>View your upcoming exciting trips!</p>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="viewtrips.php">View my trips!</a></button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="fa-solid fa-plus" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>CREATE A TRIP</strong></p>
                            <br>
                            <br>
                            <p>Start planning your next trip!</p>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="createtrip.php">Create a trip</a></button>
                        </div>
                    </div>
                    </br>
                    <hr>
                </div>
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

    <!-- Trip created successfully -->
    <div class="toast-container">
        <div class="toast text-white bg-success" id="tripToast">
            <div class="toast-body">
                Trip created successfully
            </div>
        </div>
    </div>

    <!-- Trip edited successfully -->
    <div class="toast-container">
        <div class="toast text-white bg-success" id="tripEditToast">
            <div class="toast-body">
                Trip edited successfully
            </div>
        </div>
    </div>

        <!-- Trip deleted successfully -->
        <div class="toast-container">
        <div class="toast text-white bg-danger" id="tripDelToast">
            <div class="toast-body">
                Trip deleted successfully
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
    <script>
    $(document).ready(function() {
      if (window, location.href.indexOf('1000') > -1) {
        $("#tripToast").toast({
          delay: 1400
        });
        $('#tripToast').toast('show');
      } else if (window, location.href.indexOf('1001') > -1) {
        $("#tripEditToast").toast({
          delay: 1400
        });
        $('#tripEditToast').toast('show');
      } else if (window, location.href.indexOf('1002') > -1) {
        $("#tripDelToast").toast({
          delay: 1400
        });
        $('#tripDelToast').toast('show');
      }
    });
    </script>

</body>

</html>