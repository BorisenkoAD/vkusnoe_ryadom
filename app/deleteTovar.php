<?php
require "conectdb.php";
error_reporting( E_ERROR );
$id = $_GET['id'];
$item = R::load( 'product', $id );
$file = $item->imagepath;
unlink($file);
R::trash($item);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>