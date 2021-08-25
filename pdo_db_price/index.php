<?php 
    include '../common/commonFun.php';
    include './db2.php';
    $input = $_GET;//get sort value 抓到

    //pagination
    // << 4 5 6 7 8 >> [ 26 ]
    $pagePer = 5; //每頁數量
    $pageNow = 1; //現在頁面

    //get page
    if(!empty($input['page'])){
        $pageNow = $input['page'];
        unset($input['page']);//這邊unset原因 因為下方分頁超連結 會再給他要去的page頁面        
    }
    // $input['test'] = "123456";
    // $input['test2'] = "55688";

    // dd($_SERVER['PHP_SELF']); // /t0514/pdo_db_price/index.php
    $basename = basename($_SERVER['PHP_SELF']); //最後的檔案名稱 ex: index.php
    // dd($basename);
    $urlVal = http_build_query($input); //把array 組成 GET value
    // dd($urlVal);
    $pageString = "./$basename?$urlVal";
    // dd($pageString);

    //分頁 這個我暫時拉上來 方便大家看 因為pageCount 在下面 所以要放下面
    //$urlVal 抓GET value
    // if(!empty($urlVal)){
    //     //有GET 變數 ex.sort=北區
    //     $pageStringFirst = $pageString."&page=1";
    //     $pageStringEnd = $pageString."&page=$pageCount";
    // }else{
    //     $pageStringFirst = $pageString."page=1";
    //     $pageStringEnd = $pageString."page=$pageCount";
    // }


    // dd('pageNow  = ');
    // dd($pageNow);
    // (2-1) * 2
    $pageStart = ($pageNow - 1) * $pagePer; //起始值


    //SQL LIMIT start,per(limit)
    $sqlLimit = " LIMIT $pageStart , $pagePer;";
    // $sqlLimit = "SELECT * FROM stores 
    // LIMIT 10,5;
    // ";

    // $sql = "SELECT * FROM stores ";
    // $sql = $sql . $sqlLimit;
    // dd($sql);



    //1.index.php select [5]
    //2.insert into [1]
    //3.update [6]
    //4.刪除  +  分頁面中 按北區 資料頁 只會出現北區 [3]
    //5.recovery  [4]
    //6.分區 [2]
    
    //1.前台
    //2.php
    // 2-1.sql 需要變數嗎 ?? 如何來的
    // 2-2.php 
    //3.補充 困難點 bug



    // if(empty($_GET['orderby'])){
    //     $orderby = "desc";
    //     $orderAtagString = "asc";
    // }else{
    //     if($_GET['orderby'] == "desc"){
    //         $orderby = "desc";
    //         $orderAtagString = "asc";
    //     }else{
    //         $orderby = "asc";
    //         $orderAtagString = "desc";
    //     }
    // }
    

    //沒有orderby  => desc
    if(empty($_GET['orderby'])){
        $orderby = "desc";
        $orderbyChange = "asc";
    }else{
        if($_GET['orderby'] == "desc"){
            $orderby = "desc";
            $orderbyChange = "asc";
            //orderby=desc => desc
        }else{
            //orderby=asc =>asc 
            $orderby = "asc";
            $orderbyChange = "desc";
        }
    }

    // $sortKey;
    // $sortValue;
    // $sql = "SELECT * FROM stores ORDER BY id $orderby";
    $sql = "SELECT * FROM table_price";
    $sql = $sql . $sqlLimit;

    $sqlCount =  "SELECT Count(*) AS page_count FROM table_price";
    $getDataCount = $conn->prepare($sqlCount);
    $getDataCount->execute();
    $dataCount = $getDataCount->fetch(PDO::FETCH_ASSOC);
    // dd($dataCount);
    $pageCount = $dataCount['page_count']; //總筆數 ex:100
    //總共會多少的頁碼 = 總筆數/每頁數量 ex:100/10 頁碼1 2 3 ... 10
    $pageCount = ceil($pageCount / $pagePer);
    
    // dd("pageNow  = $pageNow <br>");
    // dd("pagePer  = $pagePer <br>");
    // dd("pageStart  = $pageStart <br>");
    // dd("pageCount  = $pageCount <br>");


    if (!empty($_GET['sort'])) {
        $sort = $_GET['sort'];
        $sql = "SELECT * FROM table_price WHERE location = '$sort'";
    } 

    //$sql = "SELECT * FROM stores ORDER BY $sortKey $sortValue";
    //$sql = "SELECT * FROM stores ORDER BY id $orderby";

    dd($sql);
    $getData = $conn->prepare($sql);
    $getData->execute();
    $data = $getData->fetchAll(PDO::FETCH_ASSOC);
    //dd($data);
    $conn = null ; //關閉連線

    //分頁
    //$urlVal 抓GET value
    if(!empty($urlVal)){
        //有GET 變數 ex.sort=北區
        $pageStringFirst = $pageString."&page=1";
        $pageStringEnd = $pageString."&page=$pageCount";
    }else{
        $pageStringFirst = $pageString."page=1";
        $pageStringEnd = $pageString."page=$pageCount";
    }
?>

<?php
        //strArr
        $strArr = [
            "自由店-全新官方購網站上線營運中！",
            "雙十連假 正常營業！",
            " 7/6-7/7官方網站系統維修通知！",
            
        ];
        //echo count($strArr);

        
        
    

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="./myJs.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      body{
    text-align: center;
    font-size: 24px;
    background: no-repeat center/130% url("../01.jpg");
          }
    td {
        height: 80px;
        width: 80px;
        text-align: center;
    }

    .center {
        /* margin-left: auto;
        margin-right: auto; */
        margin: auto;
        text-align: center;
        }



    #example1 {
        border: 2px solid grey;
        border-radius: 25px;
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

    h2 {
        font-family: Verdana;
    }
    </style>
</head>

<body>
    <div class="center">
        <h2>餐飲店家資料</h2>
        <h5 style="margin-bottom:18px"></h5>
    </div>

    <?php if(!empty($_GET['msg'])):?>
    <div class="alert alert-success">
        <strong>Success!</strong> <?= $_GET['msg']?>
    </div>
    <?php endif;?>

    <div class="center">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./recover.php">回復資料庫</a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./index.php">回首頁</a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./sort.php">分區資料</a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./create.php">單筆新增</a>

    </div>
    <br>

    <table class="center" border="1px" width="80%">
        <tr>
            <!--  < ?= 等於  < ?php echo -->
            <!-- <th><a href="./index.php?orderby=<?= $orderAtagString?>">ID</a></th> -->
            <th><a href="./index.php?orderby=<?= $orderbyChange?>">ID</a></th>
            <th>店名</th>
            <th>區域</th>
            <th>營業額</th>
            <th>來客數</th>
            <th>修改/刪除</th>

        </tr>
        <?php foreach ($data as $key => $value) :?>
        <tr>
            <td><?= $value['id'];?></td>
            <!-- <td><a href="./edit.php?id=<?= $value['id'];?>"><?= $value['id'];?></a></td> -->
            <td><?= $value['name'];?></td>
            <td><?= $value['location'];?></td>
            <td><?= $value['price'];?></td>
            <td><?= $value['pepole'];?></td>
            <td>
                <a href="./edit.php?id=<?= $value['id'];?>" class="btn btn-success" role="button">修改</a>
                <a href="./del.php?id=<?= $value['id'];?>" class="btn btn-danger" role="button">刪除</a>

            </td>
        </tr>
        <?php endforeach;?>


        <tr>
            <!-- <td colspan="7">By failing to prepare, you are preparing to fail. </td> -->

            <td colspan="7">
                <!-- <p>
                <img src="https://unsplash.it/300/200" alt="" width="300px" height="200px">
            </p> -->
                <div id="example1">
                    <p>
                        <?= $strArr[0]?>
                    </p>
                </div>
            </td>

        </tr>
    </table>

    <br><br><br>
    <!-- pagination 分頁 -->
    <div class="container">
        <ul class="pagination justify-content-center">
            <!-- 最前一頁 -->
            <li class="page-item"><a class="page-link" href="<?= $pageStringFirst;?>">&lt;&lt;</a></li>
            <!-- <li class="page-item"><a class="page-link" href="./index.php?<?= "page=1";?>">&lt;&lt;</a></li> -->
            <?php 
                $iStart = 1;
                $iStart = $pageNow - 2; //5 放到中間 所以-2
                if($iStart < 2){
                    $iStart = 1;
                }
                $iEnd = $iStart + 4; // 1 2 3 4 5
                 if($iEnd >= ($pageCount + 2)){
                     $iStart = $pageNow - 4;
                     $iEnd = $pageCount;
                 }elseif($iEnd >= ($pageCount + 1)){
                     $iStart = $pageNow - 3;
                     $iEnd = $pageCount;
                 }
                 if ($pageCount < 5) {
                     $iStart = 1 ;
                     $iEnd = $pageCount;
                 }
                 

            ?>
           
            <?php for ($i=$iStart; $i <= $iEnd ; $i++) :?> 
            <?php if($i == $pageNow):?>
                <li class="page-item active"><a class="page-link" href="./index.php?<?= "page=$i";?>"><?= $i?></a></li>
            <?php else:?>

                <li class="page-item"><a class="page-link" href="./index.php?<?= "page=$i";?>"><?= $i?></a></li>
            <?php endif;?>
            <?php endfor;?>
            
            <!-- 最後一頁 -->
            <li class="page-item"><a class="page-link" href="<?= $pageStringEnd;?>">&gt;&gt;</a></li>
            <!-- <li class="page-item"><a class="page-link" href="./index.php?<?= "page=$pageCount";?>">&gt;&gt;</a></li> -->
        </ul>
    </div>
</body>

</html>