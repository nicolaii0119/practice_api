<?php
    require_once "../Class/User.php";
    $u=new User();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $op=$_POST['op'];
        if($op=='login'){
            $idnum=$_POST['idnum'];
            $password=$_POST['password'];
            $data=$u->login($idnum,$password);
            if($row=$data->fetch_assoc()){
                echo json_encode(
                    ['success'=>true,
                    'message'=>'Login successful',
                    'icon'=>'success']
                );
            }else{
                echo json_encode(
                    ['success'=>false,
                    'message'=>'Invalid ID Number or Password',
                    'icon'=>'error']
                );
            }
        }
    }
?>