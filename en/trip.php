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

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Trip: <?php echo $currentCase['case_name']; ?></title>

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


                    <?php if ($_SESSION["UserPrivilege"] == 2) {
                        echo ('
              <div class="row">
                <button class="btn text-xs py-1 btn-danger-nav" onclick="window.location.href=\'allCases2.php\'"> <i class="fa fa-arrow-left"> &nbsp </i>  View All Cases</button>
              </div>');
                    } else if ($_SESSION["UserPrivilege"] == 3) {
                        echo ('
              <div class="row">
                <button class="btn text-xs py-1 btn-danger-nav" onclick="window.location.href=\'viewCases2.php\'"> <i class="fa fa-arrow-left"> &nbsp </i>  My Cases</button>
              </div>');
                    }
                    ?>


                    <div class="card border-0 bg-transparent pb-2">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-gray-900 pt-4">

                                    <?php

                                    if ($currentCase['is_open'] == 0) {
                                        echo ('<p class="text-danger">This case is closed and can no longer be modified. </p>');
                                        echo ('<span class="fade-link" >Case #' . $currentCase['case_id'] . ' | ' . $currentCase['case_name'] . ' </span>');
                                    } else {
                                        echo ('Case #' . $currentCase['case_id'] . ' | ' . $currentCase['case_name']);
                                    }
                                    ?>
                                </h4>

                            </div>
                            <div class="col pr-4 pt-4 text-right">
                                <?php
                                if ($_SESSION["UserPrivilege"] == 2) {
                                    echo (' <a class="m-0 pt-4 font-weight-bold align-bottom text-primary small" href="editCase2.php?cid=');
                                    echo ($_GET["cid"]);
                                    echo ('"><i class="fa fa-pencil-alt"></i>  Edit Case</a>');
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Build the top menu depending on case permission -->
                    <?php
                    if ($case_permission == 0 && $_SESSION["UserPrivilege"] != 2) {

                    ?>

                        <div class="border-0 m-0 py-0">
                            <div class="row justify-content-around m-2 small">

                                <a id="newtaskbutton" class="font-weight-bold text-primary" onclick="displayToast()"><i class="fa fa-plus"></i> Start New Task</a>

                                <a id="newflashtaskbutton" class="font-weight-bold text-primary" onclick="displayToast()"><i class="fa fa-plus"></i> Create Custom Task Template</a>

                                <a class="font-weight-bold text-primary" onclick="displayToast()"><i class="fa fa-plus"></i> Manage Evidence</a>

                                <a class="font-weight-bold text-primary" href="./calendar.php?cid=<?php echo $_GET["cid"]; ?>"><i class="fa fa-pencil-alt"></i> Case Calendar </a>

                                <a class="font-weight-bold text-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" type="button" aria-expanded="false"><i class="fa fa-download"></i> T2020 </a>


                                <div class="dropdown-menu">
                                    <a class="dropdown-item pt-0" href="report_download/tableheader2.php?cid=<?php echo $_GET["cid"]; ?>&cfa=<?php echo $_SESSION["cfa"]; ?>">My
                                        T2020</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item py-0" href="report_download/tableheader3.php?cid=<?php echo $_GET["cid"]; ?>">All</a>
                                </div>

                                <a class="font-weight-bold text-primary" onclick="displayToast()"><i class="fa fa-file "></i> Integras report</a>

                                <a hidden class="font-weight-bold text-primary" onclick="displayToast()"><i class="fa fa-balance-scale "></i> Disclosure report</a>

                                <a class="m-0 font-weight-bold text-primary" onclick="displayToast()"><i class="fa fa-lock"></i> Close Case</a>

                            </div>
                        </div>
                </div>

            <?php
                    } else { ?>

                <div class="border-0 m-0 py-0">
                    <div class="row justify-content-around m-2 small">

                        <a id="newtaskbutton" class="font-weight-bold text-primary" href="createtask3.php<?php echo ('?cid=' . $_GET["cid"]); ?>"><i class="fa fa-plus"></i> Start New Task</a>

                        <a id="newflashtaskbutton" class="font-weight-bold text-primary" href="custom_flash_task2.php<?php echo ('?cid=' . $_GET["cid"]); ?>"><i class="fa fa-plus"></i> Create Custom Task Template</a>

                        <a class="font-weight-bold text-primary" href="evidence.php?cid=<?php echo $_GET["cid"]; ?>"><i class="fa fa-plus"></i> Manage Evidence</a>

                        <a hidden class="font-weight-bold text-primary" href="./calendar.php?cid=<?php echo $_GET["cid"]; ?>"><i class="fa fa-pencil-alt"></i> Case Calendar </a>

                        <a class="font-weight-bold text-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" type="button" aria-expanded="false"><i class="fa fa-download"></i> T2020</a>

                        <div class="dropdown-menu">
                            <a class="dropdown-item pt-0" href="report_download/tableheader2.php?cid=<?php echo $_GET["cid"]; ?>&cfa=<?php echo $_SESSION["cfa"]; ?>">My
                                T2020</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item py-0" href="report_download/tableheader3.php?cid=<?php echo $_GET["cid"]; ?>">All</a>
                        </div>

                        <a class="font-weight-bold text-primary" href="report_download/integras.php?cid=<?php echo $_GET["cid"]; ?>"><i class="fa fa-file "></i> Integras report</a>

                        <a hidden class="font-weight-bold text-primary" href="report_download/disclosure.php?cid=<?php echo $_GET["cid"]; ?>"><i class="fa fa-balance-scale "></i> Disclosure report</a>

                        <a class="m-0 font-weight-bold text-primary" href="../case/case_processor2.php?type=close&cid=<?php echo $_GET["cid"]; ?>"><i class="fa fa-lock"></i> Close Case</a>

                    </div>
                </div>
            </div>
        <?php
                    }
        ?>

        <div class="mb-4 mx-4">
            <hr class="sidebar-divider py-0 mt-2 mb-0 ">

            <!-- Basic Info -->
            <div class="row mt-1">
                <div class="col">


                    <div class="card shadow py-2">
                        <div class="card-body m-0 p-0">
                            <div class="row text-center text-gray-800">
                                <div class="col mr-2">
                                    <span class="text-gray-600">CDP Received: </span> <?php print_r($currentCase['case_request_date']) ?>
                                </div>
                                <div class="col">
                                    <span class="text-gray-600">Lead Investigator:</span> <?php echo $currentCase['case_lead_investigator']; ?>
                                </div>
                                <div class="col">
                                    <span class="text-gray-600">Lead CFA:</span> <?php echo $currentCase['case_lead_cfa']; ?>
                                </div>
                                <div class="col">
                                    <span class="text-gray-600">Back-Up CFA: </span> <?php echo $currentCase['case_backup_cfa']; ?>
                                </div>
                                <div class="col">
                                    <span class="text-gray-600">Status: </span> <?php echo $currentCase['case_status']; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- DataTales Example -->
            <div class="card shadow">
                <div class="card-body">

                    <a href="#case4" class="d-block card-header py-3 bg-white active" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="case3">

                        <h6 class="m-0 text-primary m-0">Tasks in progress: <?php echo ($numInprogTasks); ?></h6>
                    </a>

                    <div class="collapse show" id="case4">
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

                                    if (empty($inprogressTasks)) {
                                        echo ('<tr>
                      <td>   </td>
                      <td> There are no tasks in progress. </td>
                    </tr>');
                                    }

                                    foreach ($inprogressTasks as $task) {

                                        $fetch_evidence =  $evidence->get_evidence_name($task['evidence_linked'], $link);
                                        if ($fetch_evidence == "/") {
                                            $evidence_linked = "No evidence linked";
                                        } else {
                                            $evidence_linked = $fetch_evidence;
                                        }

                                        $duedate = strtotime($task['task_due_date']);
                                        $date = date('Y/m/d');
                                        $currentDate = strtotime($date);
                                        $difference = ($duedate - $currentDate) / 86400;

                                        if ($difference < 0) {
                                            $badgeColour = "danger";
                                            $overdue = true;
                                        } else if ($difference < 7) {
                                            $badgeColour = "danger";
                                            $overdue = false;
                                            $c++;
                                        } else if ($difference < 30) {
                                            $badgeColour = "warning";
                                            $overdue = false;
                                            $c++;
                                        } else {
                                            $badgeColour = "success";
                                            $overdue = false;
                                        }


                                        if ($task['task_due_date'] == "0000-00-00") {
                                            $badgeColour = "success";
                                            $overdue = false;
                                        }

                                        //get calendar colour
                                        $taskid = $task['task_id'];
                                        // the following code will generate a random number for every event based on task id so we can differentiate task events from each other! to ensure that each task will have the same colour even after the page is refreshed, we will set a seed that is equal to the taskid.
                                        srand($taskid);
                                        $color = 'hsl(' . rand(0, 359) . ', 100%, 80%);';
                                        //use hsl instead of rgb so we can make sure all the randomly generated colours are light

                                        echo ('

                        <tr class="clickable-row" data-href="seetask2.php');
                                        echo ('?cid=' .  $_GET["cid"] . '&tid=' . $task['task_id']);
                                        echo ('">
                        <td> <a href="seetask2.php');
                                        echo ('?cid=' . $_GET["cid"] . '&tid=' . $task['task_id']);
                                        echo ('"class="btn btn-sm btn-');
                                        echo ($badgeColour);
                                        echo (' btn-circle"> <i class="fa fa-bell"></i> </a>');
                                        if ($overdue) {
                                            echo (' <i class="fa fa-exclamation text-red"></i>');
                                        }
                                        echo (' </td>
                        <td class="w-descrip">');
                                        echo ($task['task_type_id']);
                                        echo (' </td>
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
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <a href="#case3" class="d-block card-header py-3 bg-white active" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="case3">

                        <h6 class="m-0 text-primary m-0">Tasks to be started: <?php echo ($numGetstartTasks); ?></h6>
                    </a>

                    <div class="collapse show" id="case3">
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

                                    if (empty($getstartedTasks)) {
                                        echo ('<tr>
                                <td></td>
                                <td> There are no tasks to be started. </td>
                              </tr>');
                                    }

                                    foreach ($getstartedTasks as $task) {


                                        $fetch_evidence =  $evidence->get_evidence_name($task['evidence_linked'], $link);
                                        if ($fetch_evidence == "/") {
                                            $evidence_linked = "No evidence linked";
                                        } else {
                                            $evidence_linked = $fetch_evidence;
                                        }

                                        $duedate = strtotime($task['task_due_date']);
                                        $date = date('Y/m/d');
                                        $currentDate = strtotime($date);
                                        $difference = ($duedate - $currentDate) / 86400;


                                        if ($difference < 0) {
                                            $badgeColour = "danger";
                                            $overdue = true;
                                        } else if ($difference < 7) {
                                            $badgeColour = "danger";
                                            $overdue = false;
                                            $c++;
                                        } else if ($difference < 30) {
                                            $badgeColour = "warning";
                                            $overdue = false;
                                            $c++;
                                        } else {
                                            $badgeColour = "success";
                                            $overdue = false;
                                        }


                                        if ($task['task_due_date'] == "0000-00-00") {
                                            $badgeColour = "success";
                                            $overdue = false;
                                        }

                                        //get calendar colour
                                        $taskid = $task['task_id'];
                                        // the following code will generate a random number for every event based on task id so we can differentiate task events from each other! to ensure that each task will have the same colour even after the page is refreshed, we will set a seed that is equal to the taskid.
                                        srand($taskid);
                                        $color = 'hsl(' . rand(0, 359) . ', 100%, 80%);';
                                        //use hsl instead of rgb so we can make sure all the randomly generated colours are light

                                        echo ('

                        <tr class="clickable-row" data-href="seetask2.php');
                                        echo ('?cid=' . $_GET["cid"]  . '&tid=' . $task['task_id']);
                                        echo ('">
                              <td> <a href="seetask2.php');
                                        echo ('?cid=' . $_GET["cid"] . '&tid=' . $task['task_id']);
                                        echo ('"class="btn btn-sm btn-');
                                        echo ($badgeColour);
                                        echo (' btn-circle"> <i class="fa fa-bell"></i> </a>');
                                        if ($overdue) {
                                            echo (' <i class="fa fa-exclamation text-red"></i>');
                                        }
                                        echo (' </td>
                              <td class="w-descrip">');
                                        echo ($task['task_type_id']);
                                        echo (' </td>
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
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>


            <!-- Important Dates -->
            <!-- unhide to see potential design for when this can become dynamic, for now the dates are hardcoded -->
            <div hidden class="card shadow h-100 py-2 ">
                <div class="card-body">
                    <div class="row mx-2">
                        <div class="small text-primary text-uppercase mb-1 col">Important Dates</div>
                        <div class="col text-right"> <a class="m-0 text-primary small" href="#"><i class="fa fa-plus"></i> New
                                Event</a> </div>
                    </div>

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
                    <h6 class="m-0 text-primary">Completed Tasks: <?php echo ($numCompletedTasks); ?></h6>
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

    <!-- No Permission Toast -->
    <div class="toast text-white-50 bg-dark" id="permissionToast" style="display:none;">
        <div class="toast-body">
            You do not have permission to do this!
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

    function displayToast() {
        $('#permissionToast').show();
        $("#permissionToast").toast({
            delay: 1400
        });
        $('#permissionToast').toast('show');
    }
</script>

</html>