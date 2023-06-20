<?php   

include("connect.php");

function SelectAllRolls($connect)
{
$sql = "SELECT * FROM `Food`";
$sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$sql_result->execute();
$result = $sql_result->fetchAll();
return $result;
}




function SelectAllOrders($connect){
 $sql = "SELECT * FROM `Orders` inner join `OrderStatus` on `Orders`.`OrderStatus` = `OrderStatus`.`OrderStatusId`";
$sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$sql_result->execute();
$result = $sql_result->fetchAll();
return $result;
}

function SelectedOrders($connect, $idOrder)
{
    
    $sql = "SELECT * FROM `OrderStatus` inner join `Orders` on `Orders`.`OrderStatus` = `OrderStatus`.`OrderStatusId` where `Orders`.`idOrder` = $idOrder ";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute();
    $result = $sql_result->fetchAll();
    return $result;
}

function EditOrderStatus($connect, $idOrder, $idOrderStatus)
{
    $sql = "UPDATE `Orders` SET `OrderStatus`= :OrderStatus where `idOrder`= :idOrder";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute(["OrderStatus" => $idOrderStatus, "idOrder" => $idOrder]);
    return true;
    
}

function SelectAllFood($connect){
    $sql = "SELECT * FROM `Food` inner join `TypeFood` on `Food`.`TypeFood` = `TypeFood`.`idType`";
   $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
   $sql_result->execute();
   $result = $sql_result->fetchAll();
   return $result;
   }

   function SelectedFood($connect, $idFood)
{
    $sql = "SELECT * FROM `Food` where `IdFood` = $idFood";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute();
    $result = $sql_result->fetchAll();
    return $result;
}

   

   function AddFood($connect,$TypeFood,$FoodName,$PriceFood,$WeightFood,$CountFood,$ImageFood){
   $sql = "INSERT INTO `Food`(`TypeFood`, `FoodName`, `PriceFood`, `WeightFood`, `CountFood`, `ImageFood`) 
   VALUES (:TypeFood, :FoodName, :PriceFood, :WeightFood, :CountFood, :ImageFood)";
   $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
   $sql_result->execute(["TypeFood" => $TypeFood,"FoodName" => $FoodName,"PriceFood" => $PriceFood,
   "WeightFood" => $WeightFood,"CountFood" => $CountFood,"ImageFood" => $ImageFood]);
   return true;
   }



  function TovarEdit($connect,$editTovar_id,$editTovar_category,$editTovar_name,$editTovar_price,$editTovar_weight,$editTovar_count,$editTovar_image){
    $sql = "UPDATE `Food` SET `TypeFood`= :TypeFood, `FoodName`= :FoodName, `PriceFood`= :PriceFood, `WeightFood`= :WeightFood, `CountFood`= :CountFood, `ImageFood`= :ImageFood WHERE `IdFood`= :IdFood";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute(["TypeFood" => $editTovar_category, "FoodName" => $editTovar_name, "PriceFood" => $editTovar_price, 
    "WeightFood" => $editTovar_weight, "CountFood" => $editTovar_count, "ImageFood" => $editTovar_image, "IdFood" => $editTovar_id]);
    return true;
  }

   function DeleteFood($connect, $idFood){
    
    $sql = "DELETE FROM `Food` WHERE `IdFood` = $idFood";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute();
    return true;

   }

   function SelectAllTovarCategory($connect){
    $sql = "SELECT * FROM `TypeFood`";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute();
    $result = $sql_result->fetchAll();
    return $result;
   }

 

 function AddTovarCategory($connect, $TypeName, $Discription){
  $sql = "INSERT INTO `TypeFood` (`TypeName`, `Discription`) VALUES (:TypeName, :Discription)";
   $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
   $sql_result->execute(["TypeName" => $TypeName,"Discription" => $Discription]);
   return true;
   }
   
   
   function DeleteCategory($connect, $idType){
    
    $sql = "DELETE FROM `TypeFood` WHERE `IdType` = $idType";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute();
    return true;
   }

   function EditCategory($connect, $idType, $name)
{
    $sql = "UPDATE `TypeFood` SET `TypeName`= :TypeName where `idType` = :idType";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute(["TypeName" => $name, "idType" => $idType]);
    return true;
    
}


function SelectedCategory($connect, $idCategory)
{
    $sql = "SELECT * FROM `TypeFood` where `idType` = $idCategory";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute();
    $result = $sql_result->fetchAll();
    return $result;
}


function AddOrder($connect,$userId,$order_status,$add_order_name,$add_order_date,$add_order_adress,$add_order_phoneNumber,$add_order_email){
    $sql = "INSERT INTO `Orders`(`idUser`, `OrderStatus`, `Name`, `Date`, `Adress`, `telephoneNumber`, `Email`) 
    VALUES (:idUser, :TypeFood, :FoodName, :PriceFood, :WeightFood, :CountFood, :ImageFood)";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute(["idUser" => $userId,"TypeFood" => $order_status,"FoodName" => $add_order_name,"PriceFood" => $add_order_date,
    "WeightFood" => $add_order_adress,"CountFood" => $add_order_phoneNumber,"ImageFood" => $add_order_email]);
    return true;
    }

function MyOrders($connect,$idUser){
    $sql = "SELECT * FROM `Orders` inner join `OrderStatus` on `Orders`.`OrderStatus` = `OrderStatus`.`OrderStatusId` where `IdUser` = $idUser";
    $sql_result = $connect ->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sql_result->execute();
    $result = $sql_result->fetchAll();
    return $result;
}




?>