<?php

include "../common/commonFun.php";
include "./db2.php";

if (empty($_GET['submit'])) {
    $input = $_GET;
    $id = $input['id'];
    $sql = "SELECT * FROM table_price WHERE id = '$id' ";

    $getData = $conn->prepare($sql);
    $getData->execute();
  
    $data = $getData->fetch(PDO::FETCH_ASSOC);
    dd($data);
}else{
    dd('hello edit form');
    $sql = "UPDATE ....";
    dd($sql);
    $updateData = $conn->prepare($sql);
    $updateData->execute();
}

?>
