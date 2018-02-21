<?php

require "conectdb.php";

$user = R::dispense('user');
$user -> username = 'root';
$user -> password = '123';
R::store($user);

?>