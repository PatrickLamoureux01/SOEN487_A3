<?php
session_start();
require_once('../include/database.php');

class TripGateway extends Database
{

    public function insert_trip($link, $name, $dep_cnt, $dep_city, $arv_cnt, $arv_city, $start, $end)
    {

        $sql = "INSERT INTO trips(name,depart_country,depart_city,arrival_country,arrival_city,start_date,end_date) VALUES (?,?,?,?,?,?,?)";
        $insert_trip = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($insert_trip, 'sssssss', $name, $dep_cnt, $dep_city, $arv_cnt, $arv_city, $start, $end);
        mysqli_stmt_execute($insert_trip);
        mysqli_stmt_close($insert_trip);
    }

    public function get_all_trips($link)
    {

        $sql = "SELECT * FROM trips";
        $select_trips = mysqli_prepare($link, $sql);
        mysqli_stmt_execute($select_trips);
        $trips = mysqli_stmt_get_result($select_trips);
        mysqli_stmt_close($select_trips);

        return $trips;
    }

    public function get_trip_by_id($link,$id) {

        $sql = "SELECT * FROM trips WHERE id = ?";
		$select_trip = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($select_trip, 'i', $id);
		mysqli_stmt_execute($select_trip);
		$trip = mysqli_stmt_get_result($select_trip);
		mysqli_stmt_close($select_trip);

		return $trip;
    }

    public function get_trip_name_by_id($link,$id) {

        $sql = "SELECT name from trips where id = ?";
		$select_stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($select_stmt, 'i', $id);
		mysqli_stmt_execute($select_stmt);
		mysqli_stmt_bind_result($select_stmt, $name);
		mysqli_stmt_fetch($select_stmt);
		mysqli_stmt_close($select_stmt);

		return $name;
    }
}
