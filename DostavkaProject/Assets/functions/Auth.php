<?php

include("connect.php");
function Authorization($connect, $login, $password){
    $sql = "SELECT * FROM `User` WHERE `Login` = :Login && `Password` = :Password";
   $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute(["Login" => $login,"Password" => $password]);
    $result = $sql_result->fetchAll();
    return $result;
}



?>