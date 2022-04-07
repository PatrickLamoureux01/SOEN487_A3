<?php 
  
  include_once('../header.php');
  
  session_start();
  if(!isset($_SESSION["User"]))
  {
    header("Location: login.php?status=2001");
  }

  $db = new dbmysqli();
  $link = $db->connect($db_host, $db_username, $db_password, $db_name);

	$member = new member();
	$memberid = $member->get_member_id($_SESSION["User"],$link);
    $_SESSION["mid"] = $memberid;
    $memberusername = $_SESSION["User"];
	
	// Turn off undefined index error
    error_reporting (E_ALL ^ E_NOTICE);
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

  
  <title>Change Password</title>

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



  <?php 
    include_once('../en/testMenu.php');
    include_once('../en/topbar.php')
    ?>

    

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Change password</h1>
        </div>


            <form method="post" action="./include/password2.php">
                <div class="form-group">
                    <label for="member_login">Login ID</label>
                    <input id="member_login" name="member_login" type="text" value="<?php echo $memberusername ?>" readonly class="form-control form-control-user">
                </div>
               <div class="form-group">
                    <label for="member_old_password" class="my-1 mr-2">Old password</label>
                    <input id="member_old_password" name="member_old_password" type="password" class="form-control form-control-user">
                </div>
                <div class="form-group">
                    <label for="member_new_password" class="my-1 mr-2">New password</label>
                    <input id="member_new_password" name="member_new_password" type="password" class="form-control form-control-user">
                </div>
                <div class="form-group">
                    <label for="member_password_repeat" class="my-1 mr-2">Re-Enter Password</label>
                    <input id="member_password_repeat" name="member_password_repeat" type="password" class="form-control form-control-user">
                </div>
                
                <?php 
                if ($_GET["status"] == "1001"){

                  echo("<span class=\"text-danger\">The old password entered is incorrect. Please try again. </span> <br><br>");
                }
               ?>


            <button name="submit" type="submit" class="btn btn-danger">Change password</button>
            </form>

           
      
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
 
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->


    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Montreal Computer Forensic Lab 2020</span>
          </div>
        </div>
      </footer>

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


</body>
</html>
