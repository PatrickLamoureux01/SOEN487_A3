<?php
session_set_cookie_params(86400);
ini_set('session.gc_maxlifetime', 86400);
session_start();
// This header will verify that the user session is granted.
include_once('../include/case_info2.php');
include_once('../include/common2.php');
include_once('../include/config.inc');
include_once('../include/dbapi.php');
include_once('../include/investigative_unit.php');
include_once('../include/member2.php');
include_once('../include/files.php');
include_once('../include/return_status.php');
include_once('../include/to_tcb.php');
include_once('../include/version.php');
include_once('../include/task2.php');
include_once('../include/sub_task.php');
include_once('../include/notification.php');
include_once('../include/calendar2.php');
include_once('../include/tasklist.php');
include_once('../include/notes.php');
include_once('../include/changelog.php');
include_once('../include/subtasklist.php');
include_once('../include/system_log.php');
include_once('../include/evidence.php');
include_once('../include/image.php');
include_once('../include/notes.php');


include_once('../include/broadcast.php');



$system_log = new system_log();

$db = new dbmysqli();
$link = $db->connect($db_host, $db_username, $db_password, $db_name);

  //This stops SQL Injection in POST vars
  foreach ($_POST as $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($link,$value);
  }

  //This stops SQL Injection in GET vars
  foreach ($_GET as $key => $value) {
    $_GET[$key] = mysqli_real_escape_string($link,$value);
  }


if (isset($_SESSION["User"])) {
	header("Cache-control: private");
	//echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';

	// validate user access level
} else {
	// except for the index page that's not authorized, redirect everyone else to index.php login page
	$full_path = $relative_path.$_SERVER["PHP_SELF"];
/*	if ($_SERVER["PHP_SELF"] != $full_path) {
		header("Location: ./index.php");
	}
*/
}
?>
