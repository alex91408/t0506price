<?php

include "./common/commonFun.php";
$servername = "localhost";
$port = "3306";
$username = "root";
$password = "12345";

 $conn = new PDO("mysql:host=$servername;port=$port;dbname=db_price", $username, $password);

 $sql = "SELECT * FROM table_price";
 $getData = $conn->prepare($sql);
 $getData->execute();
 $data = $getData->fetchAll(PDO::FETCH_ASSOC);
 dd($data);

?>