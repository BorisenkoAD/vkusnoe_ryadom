<?php
require "conectdb.php";
$id = $_GET['id'];
$tovars_ID1 = R::find('product', "category = ?", array($id));
?>