<?php
require_once('../include/database.php');
require_once('../Gateway/userGateway.php');
require_once('../Gateway/tripGateway.php');
session_start();
$db = new Database();
$link = $db->connect();

$userGateway = new UserGateway();

$fullname = $userGateway->getFullName($link, $_SESSION['user_id']);

$tripGateway = new TripGateway();
$tripObj = $tripGateway->get_trip_by_id($link, $_GET['tid']);
$trip = mysqli_fetch_array($tripObj);

?>
<!DOCTYPE html>

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Trip - <?php echo $trip['name']; ?></title>

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

                    <?php

                    echo ('
              <div class="row">
                <button class="btn text-xs py-1 btn-danger-nav" onclick="window.location.href=\'viewtrips.php\'"> <i class="fa fa-arrow-left"> &nbsp </i>  My Trips</button>
              </div>');

                    ?>


                    <div class="card border-0 bg-transparent pb-2">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-gray-900 pt-4">

                                    <?php


                                    echo ('Trip #' . $trip['id'] . ' | ' . $trip['name']);

                                    ?>
                                </h4>

                            </div>
                        </div>
                    </div>

                    <div class="border-0 m-0 py-0">
                        <div class="row justify-content-around m-2 small">

                            <a class="font-weight-bold text-primary" href="upload.php<?php echo ('?tid=' . $_GET["tid"]); ?>"><i class="fa fa-plus"></i> Upload Travel Documents</a>

                            <a id="newflashtaskbutton" class="font-weight-bold text-primary" href="edittrip.php<?php echo ('?tid=' . $_GET["tid"]); ?>"><i class="fa-solid fa-pen"></i> Edit Trip Info</a>

                            <a class="font-weight-bold text-primary" href="deletetrip.php?tid=<?php echo $_GET["tid"]; ?>"><i class="fa-solid fa-trash"></i> Delete Trip</a>

                        </div>
                    </div>
                </div>

                <div class="mb-4 mx-4">
                    <hr class="sidebar-divider py-0 mt-2 mb-0 ">

                    <!-- Basic Info -->
                    <div class="row mt-1">
                        <div class="col">
                            <div class="card shadow py-2">
                                <div class="card-body m-0 p-0">
                                    <div class="row text-center text-gray-800">
                                        <div class="col mr-2">
                                            <span class="text-gray-600"><i class="fa-solid fa-plane-departure"></i><b> Departure:</b> <?php echo ($trip['depart_country']); ?> - <?php echo ($trip['arrival_country']); ?> on <?php echo ($trip['start_date']); ?></span>
                                        </div>
                                        <div class="col">
                                            <span class="text-gray-600"><i class="fa-solid fa-plane-arrival"></i><b> Return:</b> <?php echo $trip['arrival_country']; ?> - <?php echo ($trip['depart_country']); ?> on <?php echo ($trip['end_date']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-body">
                            <a href="#weather_depart" class="d-block card-header py-3 bg-white active" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="weather_depart">
                                <h6 class="m-0 text-primary m-0">Weather in <?php echo ($trip['depart_country']); ?></h6>
                            </a>
                            <div class="collapse" id="weather_depart">
                                <?php
                                $str = file_get_contents("http://localhost/487a3/weather.php?param=" . $trip['depart_city']);
                                $data = json_decode($str, true);
                                echo ("<h3 class='mt-2'>Current weather in " . $data['name'] . "</h3>");
                                echo date("jS F, Y", time());
                                echo ("<div class='inline'>");
                                echo ("<h4>" . $data['weather'][0]['main'] . "</h4>");
                                echo ("<p style='float: left'><img src='http://openweathermap.org/img/w/" . $data['weather'][0]['icon'] . ".png'
                class='weather-icon' /></p><p> Feels like: " . $data['main']['temp'] . "°C</p>");
                                echo ("</div>");
                                echo ("Max Temperature: " . $data['main']['temp_max'] . "°C<br>");
                                echo ("Min Temperature: " . $data['main']['temp_min'] . "°C<br>");
                                echo ("<br>");
                                echo ("Humidity: " . $data['main']['humidity'] . "%<br>");
                                echo ("Wind Speed: " . $data['wind']['speed'] . "km/h");
                                ?>
                            </div>
                            <a href="#weather_return" class="d-block card-header py-3 bg-white active" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="weather_return">
                                <h6 class="m-0 text-primary m-0">Weather in <?php echo ($trip['arrival_country']); ?></h6>
                            </a>
                            <div class="collapse" id="weather_return">
                                <?php
                                $str = file_get_contents("http://localhost/487a3/weather.php?param=" . $trip['arrival_city']);
                                $data = json_decode($str, true);
                                echo ("<h3 class='mt-2'>Current weather in " . $data['name'] . "</h3>");
                                echo date("jS F, Y", time());
                                echo ("<div class='inline'>");
                                echo ("<h4>" . $data['weather'][0]['main'] . "</h4>");
                                echo ("<p style='float: left'><img src='http://openweathermap.org/img/w/" . $data['weather'][0]['icon'] . ".png'
class='weather-icon' /></p><p> Feels like: " . $data['main']['temp'] . "°C</p>");
                                echo ("</div>");
                                echo ("Max Temperature: " . $data['main']['temp_max'] . "°C<br>");
                                echo ("Min Temperature: " . $data['main']['temp_min'] . "°C<br>");
                                echo ("<br>");
                                echo ("Humidity: " . $data['main']['humidity'] . "%<br>");
                                echo ("Wind Speed: " . $data['wind']['speed'] . "km/h");
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow h-100 py-2 ">
                        <a href="#docs" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="docs">
                            <h6 class="m-0 text-primary">Documents Uploaded</h6>
                        </a>
                        <div class="collapse" id="docs">
                            <div class="card-body">
                                <hr class="sidebar-divider pb-0 mb-0">

                                <div class="container mt-3">

                                    <div class="row py-1">
                                        <div class="col-sm-2 text-center">
                                            <button class="btn btn-square btn-info rounded-sm"> <strong class="text text-lg"> 14
                                                </strong></button> <br> SEPT
                                        </div>

                                        <div class="col">
                                            <p> See crown prosecutor about ITO review corrections and translation. Meeting with lead
                                                investigator as well. 2pm</p>
                                        </div>
                                    </div>

                                    <div class="row py-1">

                                        <div class="col-sm-2 text-center">
                                            <button class="btn btn-square btn-info rounded-sm"> <strong class="text text-lg"> 23
                                                </strong></button> <br>OCT
                                        </div>

                                        <div class="col">
                                            <p> Meeting with Lead Investigator about Open Source Research on person X</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- DataTales Example -->
                        <div class="card shadow">
                            <a href="#caseComp" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="caseComp">
                                <h6 class="m-0 text-primary">Events Scheduled</h6>
                            </a>
                            <div class="collapse" id="caseComp">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover " id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="status-width">Status</th>
                                                    <th class="desc-width">Task Description</th>
                                                    <th>Lead CFA</th>
                                                    <th>Due Date</th>
                                                    <th>Evidence linked</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                // if case has no tasks don\t go here
                                                // var_dump($caseTasks);

                                                foreach ($completedTasks as $task) {

                                                    $fetch_evidence =  $evidence->get_evidence_name($task['evidence_linked'], $link);
                                                    if ($fetch_evidence == "/") {
                                                        $evidence_linked = "No evidence linked";
                                                    } else {
                                                        $evidence_linked = $fetch_evidence;
                                                    }

                                                    if (!empty($task['task_id'])) {

                                                        $badgeColour = 'primary';
                                                        //get calendar colour
                                                        $taskid = $task['task_id'];
                                                        srand($taskid);
                                                        $color = 'hsl(' . rand(0, 359) . ', 100%, 80%);';

                                                        echo ('

                          <tr class="clickable-row" data-href="seetask2.php');
                                                        echo ('?cid=' . $_GET["cid"]  . '&tid=' . $task['task_id']);
                                                        echo ('">
                          <td> <a href="seetask2.php');
                                                        echo ('?cid=' . $_GET["cid"] . '&tid=' . $task['task_id']);
                                                        echo ('"class="btn btn-sm btn-');
                                                        echo ($badgeColour);
                                                        echo (' btn-circle"> <i class="fa fa-bell"></i> </a> </td>
                          <td class="w-descrip">');
                                                        echo ($task['task_type_id']);
                                                        echo ('</td>
                          <td>');
                                                        echo ($task['task_lead_cfa']);
                                                        echo ('</td>
                          <td>');
                                                        if ($task['task_due_date'] == "0000-00-00") {
                                                            echo (" Ongoing ");
                                                        } else {
                                                            echo ($task['task_due_date']);
                                                        }
                                                        echo ('</td>
                          <td >');
                                                        echo $evidence_linked;
                                                        echo ('
                          </td>
                        </tr>');
                                                    } else {

                                                        echo ('<tr>
                        <td>   </td>
                        <td> There are no completed tasks. </td>
                      </tr>');
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

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