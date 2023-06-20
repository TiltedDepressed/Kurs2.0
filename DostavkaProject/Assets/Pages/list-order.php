
<?include("../functions/select.php");

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$idOrder = $_POST['orderStatusbtn'];

$orderStatusEditBtn = $_POST['orderStatusEditbtn'];

$selectOption = $_POST['StatusOrder'];



$orderIdd = $_POST['orderIdd'];

if(isset($orderStatusEditBtn)){


$result = EditOrderStatus($connect,$orderIdd,$selectOption );



}











?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список заказов</title>
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>
<?php
include("adminheader.php");
?> 


<div class="header__title">
    <div class="container">
        <p class="text">Список заказов</p>
        
    </div>
</div>


<div class="container">

<form action="#openOrderStatus" class="Form__auth" method="POST">
<div id="openModal" class="">
    <div class="modal-dialog2">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Список заказов</h3>
          <p><span>Фильтр:</span></p>
          <select name="filter" id="">
            <option value="1">По имени</option>
            <option value="2">По дате</option>
            <option value="3">По статусу заказа</option>
            <option value="4">По номеру телефона</option>
          </select>
          <input name="filter__input"type="text" class="modal-textarea">
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">
        <?php  
                foreach (SelectAllOrders($connect) as $key => $value) 
                {      
                    ?> 
                   <div class="modal-row2">
                    <p class="modal-text modal-row2__item"><?=$value['idOrder']?></p>
                    <p class="modal-text modal-row2__item"><?=$value['OrderStatusName']?></p>
                    <p class="modal-text modal-row2__item"><?=$value['Name']?></p>
                    <p class="modal-text modal-row2__item"><?=$value['Date']?></p>
                    <p class="modal-text modal-row2__item"><?=$value['Adress']?></p>
                    <p class="modal-text modal-row2__item"><?=$value['telephoneNumber']?></p>
                    <p class="modal-text modal-row2__item"><?=$value['Email']?></p>
                        <button  class="modal-input modal-row2__item" name="orderStatusbtn" value="<?=$value['idOrder']?>">Cтатус заказа</button>
                   </div>


                    <?php
            }
            ?> 
        </div>
      </div>
    </div>
  </div>
  </form>


</div>




</body>

<footer>

</footer>





<form action="#openModal" class="Form__auth" method="POST">
<div id="openOrderStatus" class="modal">
    <div class="modal-dialog2">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Изменение статуса заказа</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">
          
               
            <div class="modal-row">
            <?php
            foreach (SelectedOrders($connect, $idOrder) as $key => $value) 
            {      
              
                ?> 
            <input  type="text" value="<?=$value['idOrder']?>" name="orderIdd" class="modal-row3__item"></input>
      
            <p class="modal-text modal-row3__item"><?=$value['Name']?></p>
            <?php
            }
            ?> 
                  <select  class="modal-row3__item"  name="StatusOrder" id="">
                <option selected value="1">Новый заказ</option>
                <option value="2">Подтвердить заказ</option>
                <option value="3">Отменить заказ</option>
            </select>
             <button class="modal-input" name="orderStatusEditbtn" value="">Изменить</button>
            </div>
         
        <div class="modal-kostil">
               <a href="#openModal" class="modal-input"><span class="modal-text">Назад</span></a>
            </div> 
        </div>
      </div>
    </div>
  </div>
  </form>



</html>