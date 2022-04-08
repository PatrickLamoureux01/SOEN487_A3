<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<?php include_once('../include/config.php'); ?>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Lets Getaway</title>
  <!--    <link rel="stylesheet" type="text/css" media="screen" href="./_style/css/exhibit.css" /> 
    <link rel="stylesheet" type="text/css" media="print" href="./_style/css/print.css" /> -->
  <script src="../_style/js/jquery-1.4.4.min.js" type="text/javascript"></script>
  <script src="../_style/js/datePicker.js" type="text/javascript"></script>
  <!--   <link rel="stylesheet" media="screen" type="text/css" href="./_style/css/datepicker.css" /> -->
  <script src="../_style/js/jquery.treeview.js" type="text/javascript"></script>
  <!--    <link rel="stylesheet" media="screen" type="text/css" href="./_style/css/treeview.css" /> -->
  <link rel="stylesheet" href="../bootstrap/css/sb-admin-2.css" />
  <link href="../bootstrap/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../bootstrap/css/personal.css">
</head>

<body>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10">

        <div class="card o-hidden shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-5 p-0 d-none d-lg-block">
                <div id="header">
                  <img src="../logo.png" style="display:block; margin: 0 auto;" alt="Lets Getaway" width="250px">
                </div>
                <p class="center"><i>LETS GETAWAY</i></p>
              </div>
              <div class="border-left col-lg-7">
                <form class="user p-5 m-0" action="../Controller/validateLogin.php" method="post">
                  <div class="form-group m-0">
                    <label for="email">Email</label>
                  </div>
                  <div class="form-group">
                    <input class="form-control form-control-user" name="email" id="email" type="text" placeholder="Email">
                  </div>
                  <div class="form-group m-0">
                    <label for="password">Password</label>
                  </div>
                  <div class="form-group">
                    <input class="form-control form-control-user" name="password" id="password" type="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
                  </div>
                  <div class="form-group">
                    <p style="text-align:center;">New user? Sign up now!</p>
                    <button class="btn btn-primary btn-block" onclick="redirect()" name="signup" type="button">Sign up</button>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div> <!-- row -->
      </div> <!-- card body -->
    </div> <!-- card -->

  </div> <!-- column -->

  </div> <!-- outer row-->

  </div> <!-- container -->
  <!-- Account created successfully -->
  <div class="toast-container">
    <div class="toast text-white bg-success" id="accountToast">
      <div class="toast-body">
        Account created successfully
      </div>
    </div>
  </div>

  <!-- Invalid user/pass -->
  <div class="toast-container">
    <div class="toast text-white bg-danger" id="invalidToast">
      <div class="toast-body">
        Invalid username/password!
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <link rel="stylesheet" href="../bootstrap/css/sb-admin-2.css" />


  <!-- Custom styles for this page -->


  <!-- Bootstrap core JavaScript-->
  <script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../bootstrap/js/sb-admin-2.min.js"></script>
  <script>
    $(document).ready(function() {
      if (window, location.href.indexOf('1000') > -1) {
        $("#accountToast").toast({
          delay: 1400
        });
        $('#accountToast').toast('show');
      }
      if (window, location.href.indexOf('2000') > -1) {
        $("#invalidToast").toast({
          delay: 1400
        });
        $('#invalidToast').toast('show');
      }
    });

    function redirect() {
      window.location.href = "signup.php";
    }
  </script>
</body>



</html>