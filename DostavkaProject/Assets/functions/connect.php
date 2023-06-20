<?php

$user = "root";

$password = "";

$dns = "mysql:dbname=Magazin;host=127.0.0.1:3306";

$connect = new PDO($dns, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, ));


?>