<?php
session_start();
require_once("../include/database.php");

class FileGateway extends Database
{

    public function get_files_by_id($link, $id) {

        $sql = "SELECT * FROM drive_files WHERE trip_id = ?";
        $select_files = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($select_files,'i',$id);
        mysqli_stmt_execute($select_files);
        $files = mysqli_stmt_get_result($select_files);
        mysqli_stmt_close($select_files);

        return $files;
    }

    public function get_trip_id_by_google_drive_id($link, $id) {

        $sql = "SELECT trip_id from drive_files where google_drive_file_id = ?";
		$select_tripid = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($select_tripid, 'i', $id);
		mysqli_stmt_execute($select_tripid);
		mysqli_stmt_bind_result($select_tripid, $tripid);
		mysqli_stmt_fetch($select_tripid);
		mysqli_stmt_close($select_tripid);

		return $tripid;
    }
}

?>