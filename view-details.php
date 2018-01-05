<?php

require_once('db.php');
$hash = $mysqli->real_escape_string($_GET['hash']);;

if(empty($hash)){
    echo 'Nieprawidłowy HASH!';
    exit;
}

$query = 'SELECT * FROM products WHERE hash = "'.$hash.'"';
$result = $mysqli->query($query);
$product = $result->fetch_object();

$query = 'SELECT * FROM comments WHERE product_hash = "'.$hash.'"';
$result = $mysqli->query($query);

if($result->num_rows>0){
    $comments = [];
    while ($row = $result->fetch_object()) {
        $comments[] = $row;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Komentarze do produktu <?php echo $product->name; ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/ceneo/index.php" class="simple-text">
                    Ceneo ETL
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="/ceneo/index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Pobieranie komentarzy</p>
                    </a>
                </li>
                <li class="active">
                    <a href="/ceneo/list.php">
                        <i class="pe-7s-user"></i>
                        <p>Zapisane komentarze</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">


        <div class="content">
            <div class="container-fluid">

                <div class="col-md-12">
                    <div class="card" style="float:left; width:100%;">
                        <div class="header">
                            <h4 class="title">Lista komentarzy do produktu: <?php echo $product->name; ?></h4>

                            <?php foreach($comments as $comment): ?>
                                <div class="comment-template" style="padding: 15px 0px;border-bottom: 1px dashed #e8e2e2;float: left;width: 100%;">
                                    <div class="col-md-3">
                                        <span class="user-name" style="width: 100%;float:left;"><?= $comment->user; ?></span>
                                        <span class="recommend" style="width: 100%;float:left;"><?= $comment->recommended; ?></span>
                                        <span class="stars" style="width: 100%;float:left;"><?= $comment->stars; ?></span>
                                        <span class="date" style="width: 100%;float:left;"><?= $comment->date; ?></span>
										<div class="form-group">
										<a href="/ceneo/export_txt.php?hash=<?= $product->hash;?>" class="btn btn-success" role="button">Eksport do .txt
										</a>
										</div>
										
                                    </div>
                                    <div class="col-md-9">
                                        <div class="col-md-12"><span class="text"><?= $comment->comment; ?></span></div>
                                        <div class="col-md-6"><br><br>Zalety<br><span class="pros"><?= $comment->pros; ?></span></div>
                                        <div class="col-md-6"><br><br>Wady<br><span class="cons"><?= $comment->cons; ?></span></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
							
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>





