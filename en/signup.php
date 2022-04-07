<?php

//include_once('../header.php');

session_start();
/*
$db = new dbmysqli();
$link = $db->connect($db_host, $db_username, $db_password, $db_name);
*/
// Turn off undefined index error
error_reporting(E_ALL ^ E_NOTICE);
//echo $_SESSION["mid"];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Add User</title>

    <!-- Custom fonts for this template-->
    <link href="../bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../_style\css\font.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="../bootstrap/css/sb-admin-2.css" />


    <!-- Custom styles for this page -->
    <link href="../bootstrap/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../bootstrap/css/toastr.min.css" rel="stylesheet">
    <link href="../bootstrap/css/personal.css" rel="stylesheet">
    <script src="../bootstrap/vendor/jquery/jquery.min.js"></script>

</head>

<body >

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div>
                        <h1 class="center">Sign up to Lets Getaway</h1>

                        <form method="post" action="../Controller/userController.php">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input id="fname" name="fname" type="text" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input id="lname" name="lname" type="text" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" type="text" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input id="address" name="address" type="text" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input id="country" name="country" type="text" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input id="phone" name="phone" type="text" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                                <label for="password" class="my-1 mr-2">Password</label>
                                <input id="password" name="password" type="password" class="form-control form-control-user">
                            </div>
                            <div class="form-group">
                                <label for="password_repeat" class="my-1 mr-2">Re-Enter Password</label>
                                <input id="password_repeat" name="password_repeat" type="password" class="form-control form-control-user">
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Create Account</button>
                        </form>
                    </div>

                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <hr>
                        <span>Copyright &copy; SOEN487 A3</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- DB error -->
    <div class="toast-container">
        <div class="toast text-white bg-danger" id="dbErrorToast">
            <div class="toast-body">
                Database error - Contact administrator.
            </div>
        </div>
    </div>

    <!-- User already exists -->
    <div class="toast-container">
        <div class="toast text-white bg-danger" id="alreadyExistsToast">
            <div class="toast-body">
                This user already exists!
            </div>
        </div>
    </div>

    <!-- Password mismatch -->
    <div class="toast-container">
        <div class="toast text-white bg-danger" id="passwordToast">
            <div class="toast-body">
                The passwords do not match!
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

    <!-- Page level plugins -->
    <script src="../bootstrap/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../bootstrap/js/demo/chart-area-demo.js"></script>
    <script src="../bootstrap/js/demo/chart-pie-demo.js"></script>

    <script src="../bootstrap/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            if (window.location.href.indexOf('1000') > -1) {
                $("#dbErrorToast").toast({
                    delay: 1400
                });
                $('#dbErrorToast').toast('show');
            } else if (window.location.href.indexOf('2000') > -1) {
                $("#alreadyExistsToast").toast({
                    delay: 1400
                });
                $('#alreadyExistsToast').toast('show');
            } else if (window, location.href.indexOf('3000') > -1) {
                $("#passwordToast").toast({
                    delay: 1400
                });
                $('#passwordToast').toast('show');
            }
        });
    </script>

</body>

</html>