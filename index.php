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

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/ceneo/index.php" class="simple-text">
                    Ceneo ETL
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="/ceneo/index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Pobieranie komentarzy</p>
                    </a>
                </li>
                <li>
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
                            <h4 class="title">Pobierz komentarze z Ceneo.pl</h4>
                        </div>
                        <form>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control url-input" placeholder="Np. https://www.ceneo.pl/47499844" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="submit" class="submit-form btn btn-info btn-fill pull-left" style="margin-right: 10px;">Pobierz i zapisz</button>

                                    <button type="submit" class="extract-form btn btn-warning btn-fill pull-left" style="margin-right: 10px;">E</button>
                                    <button type="submit" class="transform-form btn btn-danger btn-fill pull-left" disabled="disabled" style="margin-right: 10px;">T</button>
                                    <button type="submit" class="submit-form btn btn-success btn-fill pull-left" disabled="disabled">L</button>
									<a href="/ceneo/export.php" class="btn btn-success" role="button" style="margin-right: 10px;">Eksport do CSV</a>
									<a href="/ceneo/delete.php" class="btn btn-success" role="button" style="margin-right: 10px;">Czyszczenie bazy</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12 extract-wrapper" style="display:none;">
                    <div class="card" style="float:left; width:100%;">
                        <div class="header">
                            <h4 class="title">Extract: </h4>
                        </div>
                        <div class="extract-box" style="padding: 15px;height: 200px;overflow-y: scroll;overflow-x: hidden;border: 1px solid #ccc;margin: 15px;"></div>
                    </div>
                </div>

                <div class="col-md-12 comments-wrapper" style="display:none;">
                    <div class="card" style="float:left; width:100%;">
                        <div class="header">
                            <h4 class="title title-product">Komentarze do produktu: </h4>
                        </div>
                        <div class="comment-box"></div>
                    </div>
                </div>

            </div>
        </div>

        <div style="display: none;">
            <div class="comment-template" style="padding: 15px 0px;border-bottom: 1px dashed #e8e2e2;float: left;width: 100%;">
                <div class="col-md-3">
                    <span class="user-name" style="width: 100%;float:left;"></span>
                    <span class="recommend" style="width: 100%;float:left;"></span>
                    <span class="stars" style="width: 100%;float:left;"></span>
                    <span class="date" style="width: 100%;float:left;"></span>
                </div>
                <div class="col-md-9">
                    <div class="col-md-12"><span class="text"></span></div>
                    <div class="col-md-6"><br><br>Zalety<br><span class="pros"></span></div>
                    <div class="col-md-6"><br><br>Wady<br><span class="cons"></span></div>
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

<script type="text/javascript">

    $(document).on('click', '.submit-form', function(e){
        e.preventDefault();
        var product;
        var current = $(this);
        current.text('Pobieram...');
        var url = $(document).find('.url-input').val();

        $(document).find('.comments-wrapper').hide();
        $(document).find('.comment-box').html('');
        $.ajax({
            url: "comments.php?url="+url+"&type=save",
            cache: false,
            success: function(html){
                var data = jQuery.parseJSON(html);

                window.location.replace("/ceneo/view-details.php?hash="+data);
            }
        });

    });

    $(document).on('click', '.extract-form', function(e){
        e.preventDefault();
        var product;
        var current = $(this);
        var url = $(document).find('.url-input').val();
        $(document).find('.extract-wrapper').hide();
        $(document).find('.extract-box').html('');

        $.ajax({
            url: "/ceneo/comments.php?url="+url+"&type=get",
            cache: false,
            success: function(html){
                var data = jQuery.parseJSON(html);

                $(document).find('.extract-wrapper').show();
                $(document).find('.extract-box').html(data);
                $(document).find('.transform-form').attr('disabled', false);
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Pobrano kod strony."
                },{
                    type: 'info',
                    timer: 4000
                });
            }
        });

    });

    $(document).on('click', '.transform-form', function(e){
        e.preventDefault();
        var product;
        var current = $(this);
        var url = $(document).find('.url-input').val();

        $(document).find('.comments-wrapper').hide();
        $(document).find('.comment-box').html('');
        $.ajax({
            url: "comments.php?url="+url+"&type=list",
            cache: false,
            success: function(html){
                var data = jQuery.parseJSON(html);

                $.each( data, function( key, value ) {
                    product = value.product
                    var clone = $(document).find('.comment-template').clone();
                    clone.removeClass('comment-template');
                    clone.find('.user-name').text(value.name);
                    clone.find('.text').text(value.text);
                    clone.find('.recommend').text(value.recommended);
                    clone.find('.stars').text('Ocena: '+value.stars);
                    clone.find('.date').text(value.time);
                    if(value.pros && value.pros.length)
                        clone.find('.pros').html(value.pros.replace(/\                    /g, "<br />"));
                    if(value.cons && value.cons.length)
                        clone.find('.cons').text(value.cons);
                    clone.appendTo('.comments-wrapper .card .comment-box');
                });
                $(document).find('h4.title-product').text('Komentarze do produktu: '+product)
                $(document).find('.comments-wrapper').show();
                $(document).find('.submit-form').attr('disabled', false);
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Pobrano komentarze."

                },{
                    type: 'info',
                    timer: 4000
                });
            }
        });

    });

    $(document).ready(function(){



    });
</script>

</html>





