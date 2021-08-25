<?php
include "../common/commonFun.php";
include "./db2.php";
$input = $_GET;

dd($_SERVER['PHP_SELF']);
$basename = basename($_SERVER['PHP_SELF']);
dd($basename);
$urlVal = http_build_query($input);
dd($urlVal);
$pageString = "./$basename?$urlVal";
dd($pageString);






// pagination
// << 45678 >> [26]
$pagePer = 2; //每頁數量
$pageNow = 1; //現在頁面




if(!empty($input['page'])){
    $pageNow = $input['page'];        
    unset($input['page']);
}
dd('pageNow  = ');
dd($pageNow);

$pageStart = ($pageNow - 1) * $pagePer; //起始值
// $pageStart = ($pagePer)
$sqlLimit = " LIMIT $pageStart , $pagePer;";
// $sqlLimt = "SELECT * FROM "
// $sqlLimt = "LIMIT 10,5;";
// $$sql = "Swp"










 if (empty($_GET['orderby'])) {
    $orderby = "desc";
    $orderAtagString = "asc";
}else{
    if ($_GET['orderby'] == "desc") {
        $orderby ="desc";
        $orderAtagString = "asc";
    } else { 
        $orderby = "asc";
        $orderAtagString= "desc";
    }
}

$sql = "SELECT * FROM table_price";
    $sql = $sql . $sqlLimit;

    $sqlCount =  "SELECT Count(*) AS page_total FROM table_price";
    $getDataCount = $conn->prepare($sqlCount);
    $getDataCount->execute();
    $dataCount = $getDataCount->fetch(PDO::FETCH_ASSOC);
    // dd($dataCount);
    $pageTotal = $dataCount['page_total']; //總筆數
    $pageCount = ceil($pageTotal / $pagePer);　// 總共會多少的頁碼  = 總筆數 / 每頁數量


    // if (!empty($_GET['sort'])) {
    //     $sort = $_GET['sort'];
    //     $sql = "SELECT * FROM table_price WHERE location = '$sort'";
    // } ;


    dd($sql);
    $getData = $conn->prepare($sql);
    $getData->execute();
    $data = $getData->fetchAll(PDO::FETCH_ASSOC);
    //dd($data);
    $conn = null ; //關閉連線
//  $sql = "SELECT * FROM table_price ORDER BY id $orderby";
// $getData = $conn->prepare($sql);
// $getData->execute();
//   //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//   $data = $getData->fetchAll(PDO::FETCH_ASSOC);
// // dd($data);
// $conn = null ;  //關閉連線
if(!empty($urlVal)){
    $pageStringFirst = $pageString."&page=1";
    $pageStringEnd = $pageString."&page=$page=$pageCount";
}else{
    $pageStringFirst = $pageString."page=1";
    $pageStringEnd = $pageString."page=$pageCount" ;
}
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
       body{
    text-align: center;
    font-size: 24px;
}
table{
    margin: auto;
}
a {
        text-decoration: none;
        color: inherit;
        font-size: 24px;
        /* color:royalblue; */
        /* color: cornflowerblue; */
    }

    a:hover {
        color: grey;
        text-decoration: none;
        cursor: pointer;
    }
    
    div.bb{
        margin: 50px;
        padding : 20px;
        
    }
    ul.pagination{
        margin: auto;
    }
    </style>

</head>
<body>
<h2>店家資料</h2>
<div class="bb">
<a href="./create.php">新增店家資料</a>
<a href="./index.php">回首頁</a>
<a href="./recover.php">回復資料庫</a>
<a href="./sort.php">分區資料</a>

</div>
<table class="center" border="2px" width="80%">
<tr>
    <th><a href="./index.php?orderby=<?= $orderAtagString?>">ID</a></th>
    <th>店名</th>
    <th>區域</th>
    <th>營業額</th>
    <th>來客數</th>
    <th>修改/刪除</th>
</tr>
<?php foreach ($data as $key => $value) :?>
<tr>
    <td><?= $value['id'];?></td>
    <td><?= $value['name'];?></td>
    <td><?= $value['location'];?></td>
    <td><?= $value['price'];?></td>
    <td><?= $value['pepole'];?></td>
    <td > <a href="./edit.php?id=<?= $value['id'];?>" class="btn btn-success" >修改</a>
         <a href="./del.php?id=<?= $value['id'];?>" class="btn btn-danger " role="button">刪除</a>
             </td>
</tr>
<?php endforeach;?>
</table>
<br><br><br>
<div class="container">
<ul class="pagination justify-content-center">
  <li class="page-item"><a class="page-link" href="./index.php<?= "page=1";?>">&lt;&lt;</a></li>
  <?php for ($i=1; $i <=5 ; $i++) :?>
  <?php if($i == $pageNow):?>
  <li class = "page-item active"><a class="page-link" href="#"><?= $i?></a></li>
  <?php else:?>

<li class="page-item"><a class="page-link" href="#"><?= $i?></a></li>
<?php endif;?>
<?php endfor;?>

    <li class="page-item"><a class="page-link" href="<?= $pageStringEnd;?>">&gt;&gt;</a></li>
</ul>
</div>

</body>
</html>