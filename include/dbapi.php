<?php   

include_once('config.inc');

class dbmysqli 
{
   function dbmysqli()
    {
  
    }

    function connect($db_username, $db_password,$db_name) 
    {
        $link = mysqli_connect("127.0.0.1", $db_username, $db_password,$db_name);
        if(!$link){
            die('Error 001: Could not connect...');
        }
        
        return $link;
    }

}
?>