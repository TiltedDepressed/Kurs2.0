<?php
include("./Assets/functions/select.php");
include("./Assets/functions/Auth.php");
include("./Assets/functions/RegUser.php");
session_start();


ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);


$reg_Name = $_POST['RegForm_Name'];
$reg_Surname = $_POST['RegForm_Surname'];
$reg_Patronymic = $_POST['RegForm_Patronymic'];
$reg_Login = $_POST['RegForm_Login'];
$reg_Email = $_POST['RegForm_Email'];
$reg_telephoneNumber = $_POST['RegForm_telephoneNumber'];
$reg_Password = $_POST['RegForm_Password'];
$reg_btn = $_POST['RegForm_btn'];
$user_role = 2;

if (isset($reg_btn)){
   
if(!empty($reg_Name) && !empty($reg_Surname) && !empty($reg_Patronymic) && !empty($reg_Login) && !empty($reg_Email) && !empty($reg_telephoneNumber) && !empty($reg_Password))
{     
    RegistrationUser($connect, $user_role, $reg_Name,$reg_Surname,$reg_Patronymic,$reg_Login,$reg_Email,$reg_telephoneNumber,$reg_Password);
    header("Location:index.php");
}else{

}
}




$login = $_POST['Auth_Login'];

$password = $_POST['Auth_Password'];

$Auth_btn = $_POST['Auth_btn'];

if(isset($Auth_btn)){
   
    if(!empty($login) && !empty($password)) 
{
  $result =  Authorization($connect, $login, $password);   
  if(count($result) > 0){

   
    
  }else{
   echo "Пользователь не найден";
  }
}
else{
    
}
foreach ($result as $value) { 
    $_SESSION['user'] = [
        'Name' => $value['Name'],
        'IdUser' => $value['IdUser'],
        'UserRole' => $value['UserRole'],
        'Email' => $value['Email'],
        'telephoneNumber' => $value['telephoneNumber'],
    ];
    header("Location:index.php");
    }
}





$add_to_cart = $_POST['add_to_cart'];
if(isset($add_to_cart)){
    foreach (SelectedFood($connect,$add_to_cart) as $key => $value) 
        {    
        $session_array = array(
            'id' => $value['IdFood'],
            'name' => $value['FoodName'],
            'CountFood' => $value['CountFood'],
            'WeightFood' => $value['WeightFood'],
            'PriceFood' => $value['PriceFood'],
            'ImageFood' => $value['ImageFood'],

        );
    
        $_SESSION['cart'][] = $session_array; 
    }

}

if(isset($_POST['ClearBascket']) || isset($_POST['OrderBtn']))
{  
    unset($_SESSION['cart']);
}

if(isset($_POST['clearselectedbascket'])){
    foreach($_SESSION['cart'] as $key => $value){
        if($value['id'] == $_POST['clearselectedbascket']){
            unset($_SESSION['cart'][$key]);
        }
    } 
}

$OrderBtn = $_POST['OrderBtn'];

$add_order_name = $_POST['add_order_name'];

$add_order_date = $_POST['add_order_date'];

$add_order_adress = $_POST['add_order_adress'];

$add_order_phoneNumber = $_POST['add_order_phoneNumber'];

$add_order_email = $_POST['add_order_email'];

$order_status = 1;



if(isset($OrderBtn)){
    if($_SESSION['user']['IdUser'] != 3 && $_SESSION['user']['IdUser'] != '' ){
        $authorized__USER_ID = $_SESSION['user']['IdUser'];
        AddOrder($connect,$authorized__USER_ID,$order_status,$add_order_name,$add_order_date,$add_order_adress,$add_order_phoneNumber,$add_order_email);
        header("Location:index.php");
    }if($_SESSION['user']['IdUser'] == ''){
        $unauthorized__USER__ID = 3;
        AddOrder($connect,$unauthorized__USER__ID,$order_status,$add_order_name,$add_order_date,$add_order_adress,$add_order_phoneNumber,$add_order_email);
        header("Location:index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Food</title>
    <link rel="icon" href="./img/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
   <header class="header">
     <?php
     include("./Assets/Pages/userheader.php");
     ?>
   </header>
   <div class="header__title">
    <div class="container">
        <img src="./img/logo.svg" width="92" alt="Суши и пицца">
        <p class="text">Доставка Еды</p>
        <p class="text">Оперативно и вкусно</p>        
    </div>
</div>

<div class="container">
    <nav class="nav">        
        <ul class="nav-list">
            <li class="nav-list__item">
                <a href="#!" class="nav-list__link nav-list__link--active">Новинки</a>
            </li>
            <li class="nav-list__item">
                <a href="#!" class="nav-list__link">Популярное</a>
            </li>
            <li class="nav-list__item">
                <a href="#!" class="nav-list__link nav-list__link-active">Роллы</a>
            </li>
            <li class="nav-list__item">
                <a href="#!" class="nav-list__link">Пицца</a>
            </li>
            <li class="nav-list__item">
                <a href="#!" class="nav-list__link">Бургеры</a>
            </li>
            <li class="nav-list__item">
                <a href="#!" class="nav-list__link">Салаты</a>
            </li>
            <li class="nav-list__item">
                <a href="#!" class="nav-list__link">Десерты</a>
            </li>
        </ul>
     </nav>
</div>
<ol class="base-grid-container">
    <div class="container">
    <?php  
                foreach (SelectAllRolls($connect, $idRoll) as $key => $value) 
                {      
                    ?>  
<li class="base-grid-container__item">
    <form action="#addBascket" method="POST">
    <div class="card" data-productContainer>
   <img class="product-img" src="./img/roll/<?=$value['ImageFood']?>" alt="<?=$value['FoodName']?>">
   <div class="card-body">
<h4 class="item-title"><?=$value['FoodName']?></h4>
<p><small><?=$value['CountFood']?> шт.</small></p>
<div class="details-wrapper">
   <div class="items counter-wrapper">
   <div class="items__control" data-quantityMinus>-</div>
	<div class="items__current" data-quantity>1</div>
	<div class="items__control" data-quantityPlus>+</div>
   </div>
   <div class="price">
       <div class="price__weight"><?=$value['WeightFood']?>г.</div>
       <div class="price__currency"><?=$value['PriceFood']?> ₽</div>
   </div>
</div>
<button name="add_to_cart" class="btn btn-outline-warning" value="<?=$value['IdFood']?>">+ в корзину</button>
   </div>
   </form>
</div>
</li>
<?php
            }
            ?>
</div>
</ol>
<script src="./js/jquery-3.6.4.js"></script>
<script src="./js/main.js"></script>
</body>
<footer class="footer">
    <div class="container">
        <div class="footer__wrapper">     
        <ul class="social">
            <li class="social__item">
                <a href="#!"><img src="./img/icons/vk.svg" alt="Link"></a>
            </li>
            <li class="social__item">
                <a href="#!"><img src="./img/icons/instagram.svg" alt="Link"></a>
            </li>
            <li class="social__item">
                <a href="#!"><img src="./img/icons/twitter.svg" alt="Link"></a>
            </li>
            <li class="social__item">
                <a href="#!"><img src="./img/icons/linkedIn.svg" alt="Link"></a>
            </li>
        </ul>
         <div class="copyrigth">
            <p><a href="https://vk.com/zvezdaparada">© 2023 Dostavka-Food.com</a></p>
         </div>
        </div>
    </div>
</footer>
<form action="index.php" class="Form__auth" method="POST">
<div id="openModal" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Авторизация</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">
            <div class="modal-row">
                <p class="modal-text">Логин</p>
                <input type="text" class="modal-textarea" name="Auth_Login">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Пароль</p>
                <input type="text" class="modal-textarea" name="Auth_Password">
            </div>    
            <div class="modal-kostil">
                <input class="modal-input" type="submit" name="Auth_btn" value="Вход">
            </div>    
            <div class="modal-kostil">
               <a href="#openModalReg" class="modal-input"><span class="modal-text">Зарегестрироваться</span></a>
            </div>    
        </div>
      </div>
    </div>
  </div>
  </form>

  <form action="#Bascket" method="POST">
  <div id="addBascket" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Товар добавлен в корзину</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">    
            <div class="modal-kostyl bigtext">
                <p class="modal-text">Товар добавлен в корзину</p>    
                </div>  
                <div class="modal-kostyl"> 
                    <dov class="modal-row">       
               <input type="Submit" class="modal-input"  name="RegForm_btn" value="В корзину"></input>
               <a href="index.php" class="modal-input">Продолжить покупки</a>
               </dov>
               </div>    
        </div>
      </div>
    </div>
  </div>
  </form>

  <form 
  action="index.php" 
  method="POST">
  <div id="Bascket" class="modal">
    <div class="modal-dialog2">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Корзина</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">

<?
 if(!empty($_SESSION['cart'])){

?>

        <div class="modal-row">
        <?php
            if($_SESSION['user']['IdUser'] != ''):
                ?>
                 <p>Привет</p>  
                 <input type="text" class="modal-textarea" name="add_order_name" value="<?=$_SESSION['user']['Name']?>">
                 </div>  
            <div class="modal-row">
                <p class="modal-text">Дата</p>
                <input type="date" class="modal-textarea" name="add_order_date">
            </div>  
            <div class="modal-row">
                <p class="modal-text">Адресс</p>
                <input type="text" class="modal-textarea" name="add_order_adress">
            </div>  
            <div class="modal-row">
                <p class="modal-text">Номер телефона</p>
                <input type="text" class="modal-textarea" name="add_order_phoneNumber" value="<?=$_SESSION['user']['telephoneNumber']?>">
            </div>  
            <div class="modal-row">
                <p class="modal-text">Почта</p>
                <input type="text" class="modal-textarea" name="add_order_email" value="<?=$_SESSION['user']['Email']?>">
            </div>   
           <?php
           endif;
           ?>
           <?php
            if($_SESSION['user']['IdUser'] == ''):
                ?>
                <p class="modal-text">Ваше имя</p>
                <input type="text" class="modal-textarea" name="add_order_name">
                </div>  
            <div class="modal-row">
                <p class="modal-text">Дата</p>
                <input type="date" class="modal-textarea" name="add_order_date">
            </div>  
            <div class="modal-row">
                <p class="modal-text">Адресс</p>
                <input type="text" class="modal-textarea" name="add_order_adress">
            </div>  
            <div class="modal-row">
                <p class="modal-text">Номер телефона</p>
                <input type="text" class="modal-textarea" name="add_order_phoneNumber">
            </div>  
            <div class="modal-row">
                <p class="modal-text">Почта</p>
                <input type="text" class="modal-textarea" name="add_order_email">
            </div>  
                <?php
           endif;
           ?>
           

        
          <?
        }
          ?>
           
           
       

            <?if(!empty($_SESSION['cart'])){

            foreach($_SESSION['cart'] as $key => $value){         
            ?>    
            <div class="modal-kostyl">
            <div class="modal-row2 blackborder">
                
                <p class="modal-text modal-row2__item"><?=$value['name']?></p>        
                <p class="modal-text modal-row2__item">Количество: <?=$value['CountFood']?>шт.</p>        
                <p class="modal-text modal-row2__item">Вес: <?=$value['WeightFood']?>г.</p>
                <p class="modal-text modal-row2__item">Цена: <?=$value['PriceFood']?>₽</p>                   
                <img src="./img/roll/<?=$value['ImageFood']?>" alt="<?=$value['ImageFood']?>" class="modal-text modal-row2__item"></img>
                <button class="modal-input"  name="clearselectedbascket" value="<?=$value['id']?>">Удалить</button>         
            </div>  
            <?
            $totalprice = $totalprice + $value['PriceFood'];
           }
           
       
        ?> 
            </div> 
            <div class="modal-kostyl"> 
                    <div class="modal-row">       
                    <p class="modal-text modal-row2__item">Итоговая стоимость заказа: <?=$totalprice?>₽</p>                
               </div>
               </div>    
            <div class="modal-kostyl"> 
                    <div class="modal-row">       
                    <p>Количество товаров в корзине: <?=count($_SESSION['cart'])?></p>
               </div>
               </div>    
                <div class="modal-kostyl"> 
                    <div class="modal-row">       
               <input type="Submit" class="modal-input modal-row2__item buscketbuttons"  name="OrderBtn" value="Оформить заказ"></input>
               <input type="Submit" class="modal-input modal-row2__item buscketbuttons"  name="ClearBascket" value="Очистить"></input>
               <a href="index.php" class="modal-input modal-row2__item buscketbuttons">Продолжить покупки</a>
               </div>
               </div> 
               <?
                }
               ?>   
        </div>
       
      </div>
    </div>
  </div>
  </form>



<form action="index.php" method="POST">
  <div id="openModalReg" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Регистрация</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">    
            <div class="modal-row">
                <p class="modal-text">Имя</p>
                <input type="text" class="modal-textarea" name="RegForm_Name">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Фамилия</p>
                <input type="text" class="modal-textarea" name="RegForm_Surname">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Отчество</p>
                <input type="text" class="modal-textarea"  name="RegForm_Patronymic">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Логин</p>
                <input type="text" class="modal-textarea" name="RegForm_Login">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Почта</p>
                <input type="text" class="modal-textarea" name="RegForm_Email">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Номер телефона</p>
                <input type="text" class="modal-textarea" name="RegForm_telephoneNumber">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Пароль</p>
                <input type="text" class="modal-textarea" name="RegForm_Password">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Повторите пароль</p>
                <input type="text" class="modal-textarea">
            </div>    
            <div class="modal-kostil">
                
                <input type="checkbox"class="modal-checkBox">
                <p class="modal-text">Согласие с правилами</p>
            </div>      
            <div class="modal-kostil">
               <input type="Submit" class="modal-input"  name="RegForm_btn" value="Зарегестрироваться"></input>
            </div>    
        </div>
      </div>
    </div>
  </div>
  </form>




  <form action="index.php" class="Form__auth" method="POST">
<div id="MyOrders" class="modal">
    <div class="modal-dialog2">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Мои заказы</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">
        <?php  
                foreach (MyOrders($connect, $_SESSION['user']['IdUser']) as $key => $value) 
                {      
                    ?> 
                   <div class="modal-row2">
                    <p class="modal-text modal-row3__item">Статус заказа: <?=$value['OrderStatusName']?></p>
                    <p class="modal-text modal-row3__item">Дата: <?=$value['Date']?></p>
                    <p class="modal-text modal-row3__item">Адресс: <?=$value['Adress']?></p>
                    <p class="modal-text modal-row3__item">Номер телефона: <?=$value['telephoneNumber']?></p>
                    <p class="modal-text modal-row3__item">Почта: <?=$value['Email']?></p>                   
                   </div>
                    <?php
            }
            ?>        
            <div class="modal-kostil">
               <a href="index.php" class="modal-input"><span class="modal-text">Назад</span></a>
            </div>    
        </div>
      </div>
    </div>
  </div>
  </form>






</html>
