<?php


class createCon
{
    var $host = 'localhost';
    var $user = 'root';
    var $pass = '';
    var $db = 'my_first_db';
    var $myConn;

    function connect() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        mysqli_set_charset($con, "utf8");

        if (!$con) {
            die('Could not connect to database!');
        } else {
            $this->myConn = $con;
            ;}
        return $this->myConn;
    }

    function close() {
        mysqli_close(myConn);
        echo 'Connection closed!';
    }

}



?>