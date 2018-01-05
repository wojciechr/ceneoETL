<?php

require_once('db.php');
$query = 'SELECT * FROM products';
$result = $mysqli->query($query);

if($result->num_rows>0){
    $products = [];
    while ($row = $result->fetch_object()) {
        $products[] = $row;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Ceneo ETL</title>

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
                            <h4 class="title">Lista zapisanych komentarzy z portalu CENEO</h4>

                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Data zapisania</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($products as $product): ?>
                                        <tr>
                                            <td><?php echo $product->id; ?></td>
                                            <td>
                                                <a href="/ceneo/view-details.php?hash=<?= $product->hash;?>">
                                                <?php echo $product->name; ?>
                                                </a>
                                            </td>
                                            <td><?php echo date('d-m-Y', strtotime($product->created)); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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





