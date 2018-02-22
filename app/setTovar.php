<?php
require "conectdb.php";
$cCategory = substr(htmlspecialchars(trim($_POST['category'])), 0, 100);
$inputName1 = substr(htmlspecialchars(trim($_POST['inputName1'])), 0, 50);
$inputName2 = substr(htmlspecialchars(trim($_POST['inputName2'])), 0, 50);
$inputPrice = substr(htmlspecialchars(trim($_POST['inputPrice'])), 0, 50);

$types = array('image/gif', 'image/png', 'image/jpeg');
$size = 1024000;


if($_SERVER['REQUEST_METHOD'] == 'GET') {
	
	$product = R::load( 'product', $id ); 

	$product -> name = $inputName1;
	$product -> secondname = $inputName2;
	$product -> price = $inputPrice;
	$product -> category = $cCategory;
	$product -> imagepath = $truePathToImage;

	R::store( $product );    // наш код
}


// Проверяем тип файла
if (!in_array($_FILES['picture']['type'], $types))
 die('wrong file extension. <a href="catalog.html">try again</a>');

// Проверяем размер файла
if ($_FILES['picture']['size'] > $size)
 die('Too many size. The size should be less than or equal to 1Mb. <a href="catalog.html">Try again</a>');


	move_uploaded_file (
		$_FILES["picture"]["tmp_name"],
		__DIR__.DIRECTORY_SEPARATOR.'img/img_cat/'.$_FILES["picture"]["name"]);

	$imgPath = __DIR__.DIRECTORY_SEPARATOR.'img/img_cat/'.$_FILES["picture"]["name"];

	$array_imgPath = explode("/", $imgPath);

	$stack = array($array_imgPath[5], $array_imgPath[6], $array_imgPath[7]);

	$truePathToImage = implode("/", $stack);

$tovar = R::dispense('product');
$tovar -> name = $inputName1;
$tovar -> secondname = $inputName2;
$tovar -> price = $inputPrice;
$tovar -> category = $cCategory;
$tovar -> imagepath = $truePathToImage;

R::store($tovar);


<script type="text/javascript">
	setTimeout('history.back()', 500);
</script>
?>