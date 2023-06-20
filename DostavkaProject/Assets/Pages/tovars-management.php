

<?include("../functions/select.php");

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$addTovarBtn = $_POST['addTovarBtn'];

$tovarCategory = $_POST['addTovar_category'];

$tovarName = $_POST['addTovar_name'];

$tovarPrice = $_POST['addTovar_price'];

$tovarCount = $_POST['addTovar_count'];

$tovarWeight = $_POST['addTovar_weight'];

$tovarImage = $_FILES['addTovar_image']['name'];


if(isset($addTovarBtn))
{
  if(!empty($_FILES['addTovar_image'])){
    $file = $_FILES['addTovar_image'];
    $name = $file['name'];
    $pathFile = '../../img/roll/'.$name;
    if(move_uploaded_file($file['tmp_name'], $pathFile)){
      AddFood($connect,$tovarCategory,$tovarName,$tovarPrice,$tovarWeight,$tovarCount,$tovarImage);
      header("Location:tovars-management.php");    
    }
  
  }
   
}



$idFood = $_POST['EditFood'];

$editTovarBtn = $_POST['EditFood'];

if(isset($editTovarBtn)){
    $result = SelectedFood($connect,$editTovarBtn);
}

$tovar__edit = $_POST['tovar__edit'];

$editTovar_id = $_POST['editTovar_id'];

$editTovar_category = $_POST['editTovar_category'];

$editTovar_name = $_POST['editTovar_name'];

$editTovar_price = $_POST['editTovar_price'];

$editTovar_weight = $_POST['editTovar_weight'];

$editTovar_count = $_POST['editTovar_count'];

$editTovar_image = $_FILES['editTovar_image']['name'];





if(isset($tovar__edit)){

  if(!empty($_FILES['editTovar_image'])){
    $file = $_FILES['editTovar_image'];
    $name = $file['name'];
    $pathFile = '../../img/roll/'.$name;
    if(move_uploaded_file($file['tmp_name'], $pathFile)){
      TovarEdit($connect,$editTovar_id,$editTovar_category,$editTovar_name,$editTovar_price,$editTovar_weight,$editTovar_count,$editTovar_image);
      
    }
  }
  
}


$tovar__delete = $_POST['tovar__delete'];

$editTovar_id = $_POST['editTovar_id'];

if(isset($tovar__delete)){
  DeleteFood($connect,$editTovar_id);
}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление товарами</title>
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>
<?php
include("adminheader.php");
?> 
<div class="header__title">
    <div class="container">
        <p class="text">Управление товарами</p>
    </div>
</div>


<form action="#openModalEditTovar" method="POST" enctype="multipart/form-data">
<div id="openFood" class="">
    <div class="modal-dialog2">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Список товаров</h3>
          <a class="modal-text"href="#openModalAddTovar">Добавить товар</a>
          <p><span>Фильтр:</span></p>
          <select name="filter" id="">
            <option value="1">По имени</option>
            <option value="2">По цене</option>
            <option value="3">По типу</option>
          </select>
          <input name="filter__input"type="text" class="modal-textarea">
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">
        <?php  
                foreach (SelectAllFood($connect) as $key => $value) 
                {      
                    ?> 
                   <div class="modal-row2">
                    <p class="modal-text modal-row2__item"><?=$value['IdFood']?></p>
                    <p class="modal-text modal-row2__item"><?=$value['FoodName']?></p>
                    <p class="modal-text modal-row2__item">Цена: <?=$value['PriceFood']?></p>
                    <p class="modal-text modal-row2__item">Вес: <?=$value['WeightFood']?></p>
                    <p class="modal-text modal-row2__item">Кол-во: <?=$value['CountFood']?></p>
                    <img src="../../img/roll/<?=$value['ImageFood']?>" alt="Картинка">
                    <p class="modal-text modal-row2__item"><?=$value['ImageFood']?></p>
                    <div class="modal-column">                    
                    <button  class="modal-input" name="EditFood" value="<?=$value['IdFood']?>">Редактировать</button>                   
                    </div>                    
                   </div>
                    <?php
            }
            ?> 
        </div>
      </div>
    </div>
  </div>
  </form>




</body>
<footer>

</footer>

<form action="#openFood" method="POST" enctype="multipart/form-data">
  <div id="openModalAddTovar" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Добавление товара</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">    
            <div class="modal-row">
                <p class="modal-text">Категория товара</p>
                <input type="text" class="modal-textarea" name="addTovar_category">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Название</p>
                <input type="text" class="modal-textarea" name="addTovar_name">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Цена</p>
                <input type="text" class="modal-textarea"  name="addTovar_price">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Кол-во</p>
                <input type="text" class="modal-textarea" name="addTovar_count">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Вес</p>
                <input type="text" class="modal-textarea" name="addTovar_weight">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Картинка</p>
                <input type="file" class="modal-textarea" name="addTovar_image">
            </div>    
            <div class="modal-kostil">
                <div class="modal-row">
               <button class="modal-input"  name="addTovarBtn">Добавить</button>
               <a  class="modal-input" href="#openFood">Назад</a>
               </div>
            </div>    
        </div>
      </div>
    </div>
  </div>
  </form>



<form action="#openFood" method="POST" enctype="multipart/form-data">
  <div id="openModalEditTovar" class="modal">
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Редактирование товара</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">    
            <div class="modal-row">
            <?php  
                foreach (SelectedFood($connect,$idFood) as $key => $value) 
                {      
                    ?>
                <p class="modal-text">ID</p>
                <input type="text" class="modal-textarea" name="editTovar_id" value="<?=$value['IdFood']?>" placeholder="">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Категория еды</p>
                <input type="text" class="modal-textarea" name="editTovar_category" value="<?=$value['TypeFood']?>" placeholder="<?=$value['TypeFood']?>">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Название</p>
                <input type="text" class="modal-textarea" name="editTovar_name" value="<?=$value['FoodName']?>" placeholder="<?=$value['FoodName']?>">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Цена</p>
                <input type="text" class="modal-textarea"  name="editTovar_price" value="<?=$value['PriceFood']?>" placeholder="<?=$value['PriceFood']?>">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Вес</p>
                <input type="text" class="modal-textarea" name="editTovar_weight" value="<?=$value['WeightFood']?>" placeholder="<?=$value['WeightFood']?>">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Количество</p>
                <input type="text" class="modal-textarea" name="editTovar_count" value="<?=$value['CountFood']?>" placeholder="<?=$value['CountFood']?>">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Картинка</p>         
                <input type="file" class="modal-textarea" name="editTovar_image">
            </div>
            <div class="modal-kostil">        
                <img src="../../img/roll/<?=$value['ImageFood']?>" alt="">
            </div>
            <?php
            }
            ?>     
            <div class="modal-kostil">
                <div class="modal-row">
                           
              <button class="modal-input" name="tovar__edit">Изменить</button>
              <button class="modal-input" name="tovar__delete">Удалить</button>
               <a class="modal-input"href="#openFood">Назад</a>
               </div>
            
             
            </div>    
        </div>
      </div>
    </div>
    
  </div>
  
</form>


</html>