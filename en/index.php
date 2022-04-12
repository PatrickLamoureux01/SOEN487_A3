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
                            <i class="fa-solid fa-magnifying-glass" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>SEARCH FOR AN ALBUM</strong></p>
                            <br>
                            <br>
                            <p>Search for an album in the repository.</p>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="search-album.php">Search for an album</a></button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="fas fa-compact-disc" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>VIEW AN ALBUM</strong></p>
                            <br>
                            <br>
                            <p>Consult a list of active albums.</p>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="view-album.php">View Album</a></button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="fas fa-plus" style="font-size:52px;"></i>
                            <i class="fas fa-minus" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>CREATE/MODIFY AN ALBUM</strong></p>
                            <br>
                            <br>
                            <p>Create and/or modify an album.</p>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="create-album.php">Create Album</a></button>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="modify-album.php">Modify Album</a></button>
                        </div>
                    </div>
                    </br>
                    <hr>
                    <div class="row" style="text-align:center;">
                        <!-- Content Row -->
                        <div class="col-md-4">
                            <i class="fas fa-minus" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>DELETE AN ALBUM</strong></p>
                            <br>
                            <br>
                            <p>Delete any active album.</p>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="delete-album.php">Delete Album</a></button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="fas fa-plus" style="font-size:52px;"></i>
                            <i class="fas fa-minus" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>UPDATE/DELETE ALBUM COVER</strong></p>
                            <br>
                            <br>
                            <p>Add and/or delete an album cover.</p>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="update-cover.php">Update Album Cover</a></button>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="delete-cover.php">Delete Album Cover</a></button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="fas fa-scroll" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>VIEW CHANGE LOGS</strong></p>
                            <br>
                            <br>
                            <p>View change logs.</p>
                            <button type="button" class="btn btn-outline-info btn-block"><a href="view-logs.php">View Change Logs</a></button>
                        </div>
                    </div>
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
      }
    });
    </script>

</body>

</html>