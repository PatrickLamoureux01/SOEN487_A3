<?php
require_once('../include/database.php');
require_once('../include/config.php');
require_once('../Gateway/userGateway.php');
require_once('../Gateway/tripGateway.php');
session_start();
$db = new Database();
$link = $db->connect();

$status = $statusMsg = '';
if (!empty($_SESSION['status_response'])) {
    $status_response = $_SESSION['status_response'];
    $status = $status_response['status'];
    $statusMsg = $status_response['status_msg'];

    unset($_SESSION['status_response']);
}
$trip_id = $_GET["tid"];
$userGateway = new UserGateway();
$tripGateway = new TripGateway();
$fullname = $userGateway->getFullName($link, $_SESSION['user_id']);
$tripname = $tripGateway->get_trip_name_by_id($link,$trip_id);

?>
<!DOCTYPE html>

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Upload Documents - <?php echo $tripname; ?></title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../bootstrap/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../bootstrap/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/personal.css">

</head>




<body id="page-top">

    <!-- Status message -->
    <?php if (!empty($statusMsg)) { ?>
        <div class="alert alert-<?php echo $status; ?>"><?php echo $statusMsg; ?></div>
    <?php } ?>

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
                        <h1 class="h3 mb-0 text-gray-800">Now uploading a document to your <?php echo $tripname;?> trip...</h1>
                    </div>


                    <div class="col-md-12">
                        <form method="post" action="../Controller/fileController.php" class="form" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Document Name</label>
                                <input type="text" name="name" id="name" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            <input type="hidden" name="trip_id" id="trip_id" value="<?php echo $trip_id; ?>"/>
                            
                            <div class="form-group">
                                <input type="submit" class="form-control btn-primary" name="submit" value="Upload" />
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../bootstrap/js/sb-admin-2.min.js"></script>
        <script src="https://kit.fontawesome.com/0ce3f6901e.js" crossorigin="anonymous"></script>


</body>



<script>
    $(document).ready(function() {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });

        $('#noteTable').DataTable();
    });
</script>

</html>