<?php
require "rb-mysql.php";

R::setup('mysql:host=127.0.0.1;dbname=rb_test', 'root', '');

if( !R::testConnection()){
	exit('Нет подключения к БД');
}

$id = $_GET['id'];

$tovars_ID1 = R::find('product', "category = ?", array($id));


?>