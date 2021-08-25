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
    // dd($data);
}else{
    // dd('hello edit form');
    $input = $_GET;
    $id = $input['id'];
    $name = $input['name'];
    $location = $input['location'];
    $price = $input['price'];
    $pepole = $input['pepole'];

    dd($input);
    $sql = "UPDATE table_price SET name = '$name', location='$location' , price = '$price', pepole = '$pepole' WHERE id = '$id'";
  
    $updateData = $conn->prepare($sql);
    $updateData->execute();
    $url = "./index.php?msg=edit_ok";
     header("Location: $url");
     echo "update ok <br>";

    // $sql = "SELECT * FROM table_price WHERE id = '$id'";
    // $getData = $conn->prepare($sql);
    // $getData->execute();
    // $data = $getData->fetch(PDO::FETCH_ASSOC); 
    // echo "select ok<br>";
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
body{
    text-align: center;
}
td{
    text-align: center;
}
table{
    margin: auto;
}
    </style>
</head>
<body>
<h2>修改資料</h2>
<a href="./index.php">回首頁</a>
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
<td>
    <?= $data['id']; ?>
</td>
<td ><input  width="50%" type="text"  name="name" id="name" value="<?= $data['name'];?>" ></td>
<td>
<select name="location" id="location">
    <option value="<?= $data['location']; ?>"><?= $data['location'];?></option>
    <option value="北區">北區</option>
    <option value="中區">中區</option>
    <option value="南區">南區</option>
</select>
</td>
<td><input type="number" name="price" id="price" value = "<?= $data['price'];?>" ></td>
<td><input type="number" name="pepole" id="pepole" value = "<?= $data['pepole'];?>"></td>
</tr>
<tr>
    <td colspan="7" align="center">
   
     <input type="hidden" name= "id" value="<?=$data['id'];?>"> 
    <input type="submit" value="submit" name="submit">
    </td>
</tr>
    </table>
    </form>
</body>
</html>