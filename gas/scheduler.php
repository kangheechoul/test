<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">

	<title></title>

	<!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
	<link rel="stylesheet" type="text/css" href="XEIcon-2.2.0/xeicon.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/responsive.css"/>
	<link rel="shortcyt icon" href="movmake-fa.ico" type="image/x-icon">


	<!-- SCRIPT -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/header.js"></script>


    <!-- SLICK -->
    <link rel="stylesheet" type="text/css" href="layout/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="layout/css/slick-theme.css"/>
    <script type="text/javascript" src="layout/js/slick.min.js"></script>
    <script src = "js/scheduler.js?version=<?php echo date("Y-m-d H:i:s");?>">></script>

    <style>
    #scheduler_div ul{float:left; margin:10px}
    #scheduler_div div{float:left; margin:10px;width:50%}

    #scheduler li div{width:100%;height:50px;border:1px solid #000000}
    #scheduler_div ul{list-style:none;width:30%}
    #scheduler_div ul li{margin-bottom:10px}
    .date_num span{display:block;text-align:center}

    .date_num.weekday{background-color:#F5FFFA}
    .date_num.weekday span{color:black;}
    .date_num.sunday{background-color:#FF4500}
    .date_num.sunday span{color:white}
    .date_num.saturday{background-color:#6495ED}
    .date_num.saturday span{color:white}

    .insert {width:30%;height:100%}
    .insert input{width:300px;height:30px;font-size:15px}
    </style>
</head>
<?php
include_once ("./head.php");
?>

<body>
    <button type = "button" onclick = "month_prev()"><</button>
	<span id = "view_month">2021-06</span>
    <button type = "button" onclick = "month_next()">></button>

    <div id = "scheduler_div">
        <ul id = "scheduler">
            <!-- <li data-copy = "date_li">
                <div class = "date_num">
                    <span data-attr = "date">2021-05-20</span>
                    <span data-attr = "info">바다소프트 예약</span>
                </div>
            </li> -->
        </ul>

        <div class = "insert" >
            <form onsubmit="return false;" id = "scheduler_form">
            <input type = "text" id = "title" value = "">
            <input type = "date" id = "date">
            <input type = "time" id = "time">
            </form>
        </div>
        <button onclick = "insert_scheduler()">스케줄 추가
    </div>



    <div style = "display:none">
        <ul>
            <li data-copy = "date_li">
                <div class = "date_num" data-attr = "week">
                    <span data-attr = "date">2021-05-20</span>
                    <span data-attr = "info"></span>
                </div>
            </li>
        </ul>
    </div>
</body>
<?php include_once("./tail.php");?>