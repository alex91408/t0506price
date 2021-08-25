<?php
include '../common/commonFun.php';
include './db2.php';
$input = $_GET;
$id = $input['id'];
$sql = "DELETE FROM table_price WHERE id = '$id';";
// dd($sql);
$delData = $conn->prepare($sql);
$delData->execute();
$url = $_SERVER['HTTP_REFERER'];
$_SESSION['msg'] = "del_id_$id";

header("Location: $url");
?>