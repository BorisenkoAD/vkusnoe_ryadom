<?php
require "conectdb.php";
$id = $_GET['id'];
$item = R::load( 'product', $id );
$file = $item->imagepath;
unlink($file);
R::trash($item);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>