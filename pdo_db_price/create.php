<?php

include "../common/commonFun.php";
include 'db2.php';
 if(!empty($_GET['submit'])){
    $input = $_GET;
    $name =$input['name'];
    $location = $input['location'];
    $price = $input['price'];
    $pepole = $input['pepole'];
    $sql = "INSERT INTO table_price( id ,name , location , price , pepole ) VALUE ('id','$name','$location','$price','$pepole');";
    // dd($sql);
    $getData = $conn->prepare($sql);
    $getData->execute();
    $url = "./index.php?msg=add_ok";
    header("Location: $url");
}

$conn = null ;
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
h2{
text-align: center;
}

body{
    text-align: center;
    font-size: 24px;
    background: no-repeat center / 100%  url("../02.jpg") ;
    background-size:1920px 1000px;
    background-position:-30% -10%;
}
table{
    margin: auto;
}
    </style>
</head>
<body>
<h2>新增資料</h2>
<div class="right">
<a href="./index.php">回首頁</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <br>
<form action="" method="get">
<table class="center" border="2px" width="80%">
<tr>
<th>ID</th>
<th>店名</th>
<th> 區域</th>
<th> 營業額</th>
<th> 來客數</th>
</tr>

<tr >
<td>id</td>
<td ><input  type="text"  name="name" ></td>
<td>
<select name="location" id="location">
    <option value="北區">北區</option>
    <option value="中區">中區</option>
    <option value="南區">南區</option>
</select>
</td>
<td><input type="number" name="price" id="price"></td>
<td><input type="number" name="pepole" id="pepole"></td>
</tr>
<tr>
    
    <td colspan="7" align="center"><input type="submit" value="submit" name="submit"></td>
</tr>
    </table>
    </form>
</body>
</html>