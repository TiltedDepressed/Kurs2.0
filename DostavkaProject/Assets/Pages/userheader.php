<?php

session_start();


if(isset($_POST['logOut__input'])){
    unset($_SESSION['user']);
}
?>
<div class="container container--header">
        <nav class="nav">
            <a href="./index.php" class="logo">
                <img src="./img/logo.svg" alt="logo">
            </a>
            <ul class="nav-list">
                <li class="nav-list__item">
                    <a href="#!" class="nav-list__link nav-list__link--active">Delivery Food</a>
                </li>
                <li class="nav-list__item">
                    <a href="#!" class="nav-list__link">Акции</a>
                </li>
                <li class="nav-list__item">
                    <a href="#!" class="nav-list__link nav-list__link-active">Меню</a>
                </li>
                <li class="nav-list__item">
                    <a href="#!" class="nav-list__link">Магазины</a>
                </li>
                <li class="nav-list__item">
                    <a href="#!" class="nav-list__link">Доставка</a>
                </li>
               
                <?php
            if($_SESSION['user']['UserRole'] == 1):
                ?>
                   <li class="nav-list__item">
                    <a href="./Assets/Pages/admin.php" class="nav-list__link adminPanel">AdminPanel</a>
                </li>
<?php
           endif;
           ?>
            </ul>
            <a href="#Bascket" class="buscet">              
                <img src="./img/bag_buy_cart_market_shop_shopping_tote_icon_123191.svg" alt="Корзина">
                <?php
                if(count($_SESSION['cart']) != 0){

               
                ?>
                <p class="bascketcounter"><?=count($_SESSION['cart'])?></p>

                <?php
                 }
                ?>
            </a>
           <?php
           if($_SESSION['user']['IdUser'] == ''):
           ?>
            <a href="#openModal"><span class="LogOutBtn">Sign In</span></a>
            <?php
           endif;
           ?>

           <?php
            if($_SESSION['user'] != '' && $_SESSION['user']['UserRole'] == 2 && $_SESSION['user']['UserRole'] != 3):
                ?>
                <form action="" method="POST">
                <a href="#MyOrders"><span class="LogOutBtn">Мои заказы</span></a>  
                <p><span class="blue_text"><?=$_SESSION['user']['Name']?></span><button name="logOut__input" class="LogOutBtn">Log Out</button></p> 
                </form> 
           <?php
           endif;
           ?>
 <?php
            if($_SESSION['user'] != '' && $_SESSION['user']['UserRole'] == 1 && $_SESSION['user']['UserRole'] != 3):
                ?>
                <a href="#MyOrders"><span class="LogOutBtn">Мои заказы</span></a>
                <form action="" method="POST"> 
                <p><span class="red_text"><?=$_SESSION['user']['Name']?></span> <button name="logOut__input" class="LogOutBtn">Log Out</button> </p>   
                </form> 
           <?php
           endif;
           ?>

         </nav>
     </div>