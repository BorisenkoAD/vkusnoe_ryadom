<?php 
require "rb-mysql.php";

R::setup('mysql:host=127.0.0.1;dbname=rb_test', 'root', 'hCmR2ARr');

if( !R::testConnection()){
	exit('Нет подключения к БД');
}

R::freeze(false);
?>