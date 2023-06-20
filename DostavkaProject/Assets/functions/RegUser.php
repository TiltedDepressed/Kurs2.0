<?php
include("connect.php");

function RegistrationUser($connect, $user_role, $name,$surname, $patronymic, $login, $password, $email, $telephoneNumber){

$sql = "INSERT INTO `User`(`UserRole`, `Name`,`Surname`, `Patronymic`, `Login`, `Password`, `Email`, `telephoneNumber`) VALUES (:UserRole, :Name,:Surname,:Patronymic,:Login,:Password,:Email, 
:telephoneNumber)";
$sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$sql_result->execute(["UserRole" => $user_role,"Name" => $name,"Surname" => $surname, "Patronymic" => $patronymic,"Login" => $login,"Password" => $password,"Email" => $email, 
"telephoneNumber" => $telephoneNumber]);
return true;
}


?>