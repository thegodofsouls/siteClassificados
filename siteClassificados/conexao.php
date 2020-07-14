<?php
     session_start();

     global $conn;
try
{   
    $host = "mysql:dbname=classificados;host=localhost";
    $user = "root";
    $pass = "";
    
    $conn = new PDO($host, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $error)
{
    echo 'erro: '.$error->getMessage();
    exit;
}
