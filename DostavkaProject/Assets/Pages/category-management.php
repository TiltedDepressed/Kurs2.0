<?include("../functions/select.php");

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$addCategoryBtn = $_POST['AddCategoryinput'];
$addCategoryName = $_POST['Name'];
$addCategoryDiscription = $_POST['Discription'];

if(isset($addCategoryBtn)){
  AddTovarCategory($connect,$addCategoryName,$addCategoryDiscription);
  header("Location:category-management.php");
}


$deleteCategoryBtn = $_POST['DeleteCategory'];

if(isset($deleteCategoryBtn)){

  DeleteCategory($connect,$deleteCategoryBtn);
}

$EditCategoryBtn = $_POST['EditCategory'];

$editTovarCategory = $_POST['EDIT_NAME'];

if(isset($EditCategoryBtn)){
  EditCategory($connect,$EditCategoryBtn,$editTovarCategory);
  header("Location:category-management.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление категориями</title>
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>
<?php
include("adminheader.php");
?> 
<div class="header__title">
    <div class="container">
        <p class="text">Управление категориями</p>       
    </div>
</div>
<form action="#openEditCategory" method="POST">
  <div id="openCategory" class="">
    <div class="modal-dialog3">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Список категорий товаров</h3>
          <a href="#addCategoryy" class="modal-input">Добавить категорию</a>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">
          
        <?php  
                foreach (SelectAllTovarCategory($connect) as $key => $value) 
                {      
                    ?> 
           <div class="modal-row2">
            <input type="text" value="<?=$value['idType']?>">
            <input type="text" value="<?=$value['TypeName']?>">
            <button  class="modal-input krinjkt" name="EditCategory2" value="<?=$value['idType']?>">Изменить</button>
     
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


<form action="#openCategory" class="Form__auth" method="POST">
<div id="addCategoryy" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Добавить категорию</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">
            <div class="modal-row">
                <p class="modal-text">Название категории</p>
                <input type="text" class="modal-textarea" name="Name">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Описание</p>
                <input type="text" class="modal-textarea" name="Discription">
            </div>    
            <div class="modal-kostil">
              <div class="modal-row">
               <input type="submit" value="Добавить" name="AddCategoryinput" class="modal-input"></input>
               <a href="#openCategory" class="modal-input"><span class="modal-text">Назад</span></a>
               </div>
            </div>    
        </div>
      </div>
    </div>
  </div>
  </form>


  <form action="#openCategory" class="Form__auth" method="POST">
<div id="openEditCategory" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Редактирование категории</h3>
          <a href="#close" title="Close" class="close">×</a>
        </div>
        <div class="modal-body">
<?           foreach (SelectedCategory($connect, $_POST['EditCategory2']) as $key => $value) 
                {       ?>
            <div class="modal-row">
                <p class="modal-text">Название категории</p>
                <input type="text" class="modal-textarea" name="EDIT_NAME" placeholder="<?=$value['TypeName']?>">
            </div>    
            <div class="modal-row">
                <p class="modal-text">Описание</p>
                <input type="text" class="modal-textarea" name="Discription" placeholder="<?=$value['Discription']?>">
            </div>    
            <div class="modal-kostil">
              <div class="modal-row">
              <button  class="modal-input krinjkt" name="EditCategory" value="<?=$value['idType']?>">Изменить</button>
              <button  class="modal-input krinjkt" name="DeleteCategory" value="<?=$value['idType']?>">Удалить</button>
               <a href="#openCategory" class="modal-input"><span class="modal-text">Назад</span></a>
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







</html>