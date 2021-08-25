<?php
include "../common/commonFun.php";
include "./db2.php";


    $sql="SELECT SUM(price) AS price , SUM(pepole) AS pepole,location FROM table_price GROUP BY  location";
   



// $sql = "SELECT * FROM table_price ORDER BY id $orderby";
$getData = $conn->prepare($sql);
$getData->execute();
  //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $data = $getData->fetchAll(PDO::FETCH_ASSOC);
// dd($data);
$conn = null ;  //關閉連線
?>

<?php
       $strArr = [
        "人生最美好的東西，就是他同別人的友誼。",
        "永遠記住，你自己決心成功比其它什麼都重要。",
        "記住，當人生的道路陡峭的時候，要保持沉著。",
        "不要有懷才不遇的想法。懷才不遇多半是自己造成的。",
        "人生最美好的東西，就是他同別人的友誼。",
        "永遠記住，你自己決心成功比其它什麼都重要。",
        "記住，當人生的道路陡峭的時候，要保持沉著。",
        "不要有懷才不遇的想法。懷才不遇多半是自己造成的。",
        "人生最美好的東西，就是他同別人的友誼。",
        "永遠記住，你自己決心成功比其它什麼都重要。",
        "記住，當人生的道路陡峭的時候，要保持沉著。",
        "不要有懷才不遇的想法。懷才不遇多半是自己造成的。"
];
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
    font-size: 24px;
    background: no-repeat center / 100%  url("../02.jpg") ;
    background-size:1920px 1050px;
    background-position:-30% -10%;
}
table{
    margin: auto;
}
a {
        text-decoration: none;
        color: inherit;
        
    }
div{
    padding: 15px;
}
    </style>
</head>
<body>
<h2>分區店家資料</h2>
<div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./create.php">新增店家資料</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./index.php">回首頁</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./recover.php">回復資料庫</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


</div>
<table class="center" border="2px" width="80%">
<tr>
    
    
    <th>  區域</th>
    <th> 營業額</th>
    <th>&nbsp;&nbsp;來客數</th>
</tr>
<?php foreach ($data as $key => $value) :?>
<tr>
<td><a href="./index.php?msg=<?= $value['location']."資料";?>&sort=<?= $value['location'];?>"><?= $value['location'];?></a></td>
            <!-- <td><?= $value['location'];?></td> -->
            <td><?= $value['price'];?></td>
            <td><?= $value['pepole'];?></td>
            
            <!-- <td><a href="./edit.php?id=<?= $value['id'];?>">修改</a> </td> -->
        </tr>
<?php endforeach;?>



</body>
</html>