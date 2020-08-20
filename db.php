<?php 

$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES uc
$pdo = new PDO('mysql:dbname=test_data;host=localhost', 'root', '',$pdo_options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);