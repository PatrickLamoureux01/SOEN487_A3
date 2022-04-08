<?php

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

        if ($check = mysqli_stmt_fetch($validate)) {
            return 1;
        } else {
            return 0;
        }
        mysqli_stmt_close($validate);
    }
}
?>
