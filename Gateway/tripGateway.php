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

    public function insert_event($link, $name, $datetime, $location, $tid) {

        $sql = "INSERT INTO events(name,datetime,location,trip_id) VALUES (?,?,?,?)";
        $insert_event = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($insert_event, 'sssi', $name, $datetime, $location, $tid);
        mysqli_stmt_execute($insert_event);
        mysqli_stmt_close($insert_event);
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

    public function get_all_events_by_trip_id($link, $id) {

        $sql = "SELECT * FROM events WHERE trip_id = ?";
        $select_events = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($select_events, 'i', $id);
        mysqli_stmt_execute($select_events);
        $events = mysqli_stmt_get_result($select_events);
        mysqli_stmt_close($select_events);

        return $events;

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

    public function edit_trip($link, $name, $dep_cnt, $dep_city, $arv_cnt, $arv_city, $start, $end, $id) {

        $sql = "UPDATE trips SET name = ? , depart_country = ?, depart_city = ?, arrival_country = ?, arrival_city = ?, start_date = ?, end_date = ? WHERE id = ?";
        $update_trip = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($update_trip, 'sssssssi', $name, $dep_cnt, $dep_city, $arv_cnt, $arv_city, $start, $end, $id);
        mysqli_stmt_execute($update_trip);
        mysqli_stmt_close($update_trip);

    }

    public function delete_trip($link, $id) {

        $sql = "DELETE FROM trips WHERE id = ?";
        $delete_trip = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($delete_trip,'i',$id);
        mysqli_stmt_execute($delete_trip);
        mysqli_stmt_close($delete_trip);
    }
}
