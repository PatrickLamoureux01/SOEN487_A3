<?php
session_start();
require_once('../include/database.php');

class UserGateway extends Database {

    public function insert_user($link, $fname, $lname, $email, $address, $country, $phone, $pass) {
        
        $sql = "INSERT INTO users(fname,lname,email,address,country,phone,password) VALUES (?,?,?,?,?,?,?)";
        $insert_user = mysqli_prepare($link,$sql);
        mysqli_stmt_bind_param($insert_user,'sssssis',$fname,$lname,$email,$address,$country,$phone,$pass);
        mysqli_stmt_execute($insert_user);
        mysqli_stmt_close($insert_user);

    }

    public function authenticate_user($link, $email, $pass) {

        $sha1pass = sha1($pass);
        $sql = "SELECT id FROM users WHERE email = ? AND password = ?";
        $validate = mysqli_prepare($link,$sql);
        mysqli_stmt_bind_param($validate,'ss',$email,$sha1pass);
        mysqli_stmt_execute($validate);
        mysqli_stmt_bind_result($validate, $id);
        if ($check = mysqli_stmt_fetch($validate)) {
            $_SESSION['user_id'] = $id;
            return 1;
        } else {
            return 0;
        }
        mysqli_stmt_close($validate);
    }

    public function getFullName($link, $id) {

        $sql = "SELECT fname,lname FROM users WHERE id = ?";
        $select_name = mysqli_prepare($link,$sql);
        mysqli_stmt_bind_param($select_name,'i', $id);
        mysqli_stmt_execute($select_name);
        mysqli_stmt_bind_result($select_name, $fname, $lname);
        mysqli_stmt_fetch($select_name);
        mysqli_stmt_close($select_name);

        return $fname . " " . $lname;

    }
}
?>
