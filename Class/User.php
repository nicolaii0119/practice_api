<?php
require_once "Database.php";
    class User extends Database{

        public function login($idnum,$password){
            $sql="select * from user where idnumber=? and password=?";
            $stmt=$this->conn->prepare($sql);
            $stmt->bind_param("ss",$idnum,$password);
            $stmt->execute();
            $result=$stmt->get_result();
            return $result;
        }
    }
?>
