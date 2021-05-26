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
    <script src = "js/calendar.js?version=<?php echo date("Y-m-d H:i:s");?>">></script>

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

    table {width:80%;margin-left:10%}
    td {border: 1px solid black; width:10%; height:100px;text-align:center}
    td div span{text-align:left; font-size:13px;height:25%}
    th {max-height:10%}
    .top{vertical-align:top;height:50%}
    .bot{vertical-align:bottom;height:50%}
    body {width:100%;height:100%; position:relative;}
    .month {text-align:center}

    </style>
</head>
<?php
include_once ("./head.php");
?>

<body>
<div class = "wrap">
    <div class = "month">
        <button type = "button" onclick = "month_prev()"><</button>
        <span id = "view_month">2021-06</span>
        <button type = "button" onclick = "month_next()">></button>
    </div>
    <div id = "calendar_div" class ="month">
        <table >
            <th class = "date_num sunday">일</th>
            <th class = "date_num weekday">월</th>
            <th class = "date_num weekday">화</th>
            <th class = "date_num weekday">수</th>
            <th class = "date_num weekday">목</th>
            <th class = "date_num weekday">금</th>
            <th class = "date_num saturday">토</th>

            <tbody id = "calendar" data-wrap = "calendar_wrap">
                <!-- <tr>
                    <td><div class = "top"><span>날짜</span></div><div class = "bot"><span >예약현황</span></div></td>
                    <td><div class = "top"><span>날짜</span></div><div class = "bot"><span >예약현황</span></div></td>
                    <td><div class = "top"><span>날짜</span></div><div class = "bot"><span >예약현황</span></div></td>
                    <td><div class = "top"><span>날짜</span></div><div class = "bot"><span >예약현황</span></div></td>
                    <td><div class = "top"><span>날짜</span></div><div class = "bot"><span >예약현황</span></div></td>
                    <td><div class = "top"><span>날짜</span></div><div class = "bot"><span >예약현황</span></div></td>
                    <td><div class = "top"><span>날짜</span></div><div class = "bot"><span >예약현황</span></div></td>
                </tr> -->
            </tbody>
        </table>
    </div>
</div>
    <div style = "display:none">
        <table>
            <tr data-week="calendar_week">
                <td data-date = "calendar_date"><div class = "top"><span data-attr = "date">날짜</span></div><div class = "bot"><span data-attr = "info">예약현황</span></div></td>
            </tr>
        </table>
    </div>
</body>
<?php include_once("./tail.php");?>