<?php
include_once('config.php');

class Database {

    function connect() 
    {
        $link = mysqli_connect(db_host,db_username,db_password,db_name);
        if(!$link){
            die('Error 001: Could not connect...');
        }
        
        return $link;
    }


}

?>