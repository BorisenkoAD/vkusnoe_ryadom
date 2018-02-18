<?php
require "rb-mysql.php";

R::setup('mysql:host=127.0.0.1;dbname=rb_test', 'root', '');

if( !R::testConnection()){
	exit('Нет подключения к БД');
}
$cCategory = substr(htmlspecialchars(trim($_POST['category'])), 0, 100);
$inputName1 = substr(htmlspecialchars(trim($_POST['inputName1'])), 0, 50);
$inputName2 = substr(htmlspecialchars(trim($_POST['inputName2'])), 0, 50);
$inputPrice = substr(htmlspecialchars(trim($_POST['inputPrice'])), 0, 50);

R::freeze(false);

$path = 'img/img_cat/';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 if (!@copy($_FILES['picture']['tmp_name'], $path.$_FILES['picture']['name']))
  echo 'Что-то пошло не так в процессе загрузки файла(((((';
 else	
	$imgpath = $_FILES['picture']['name'];
}

$tovar = R::dispense('product');
$tovar -> name = $inputName1;
$tovar -> secondname = $inputName2;
$tovar -> price = $inputPrice;
$tovar -> category = $cCategory;
$tovar -> imagepath = $imgpath;

R::store($tovar);


?>
<script type="text/javascript">
             setTimeout('location.replace("/catalog.html")', 500);
        </script>