<?php
session_start();
require_once('../include/database.php');

class TripGateway extends Database
{

    public function insert_trip($link, $name, $dep, $arv, $start, $end)
    {

        $sql = "INSERT INTO trips(name,depart_country,arrival_country,start_date,end_date) VALUES (?,?,?,?,?)";
        $insert_trip = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($insert_trip, 'sssss', $name, $dep, $arv, $start, $end);
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
}
