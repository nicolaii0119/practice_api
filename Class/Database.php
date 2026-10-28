<?php
    class Database{
        protected $conn;
        public function __construct(){
            if (file_exist(__DIR__ . "/../.env")){
                $_ENV =parse_ini_file(__DIR__ . "/../.env");
            }else{
                $_ENV =$_ENV ?: getenv();
            }


            //$_ENV = parse_ini_file(__DIR__ . "/../.env");

            $port=10125;
            $host=$_ENV['DB_HOST'];
            $un=$_ENV['DB_USERNAME'];
            $pass=$_ENV['DB_PASSWORD'];
            $db=$_ENV['DB_DATABASE'];

            $cert=__DIR__ .'/ca.pem';
            $this->conn=mysqli_init();

            $this->conn->ssl_set(NULL,NULL,$cert,NULL,NULL);
            $this->conn->real_connect($host,$un,$pass,$db,$port,NULL,MYSQLI_CLIENT_SSL);

        }
    }
?>