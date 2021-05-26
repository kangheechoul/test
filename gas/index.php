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



    <script>
    $(document).ready(function(){
        $('.single-item').slick({
            infinite: true,
            arrows: false,
            dots:true,
            autoplay:true,
            autoplaySpeed: 2000
        });
        $('.pd-slide').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            arrows: false,
            dots:true,
            autoplay:true,
            autoplaySpeed: 1500,
            responsive: [
            {
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
            },
            {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
            }]
        });
    });


    </script>
    <style>
        .single-item, .slick-list, .slick-track{height:100% !important;}
    </style>
</head>
<?php include_once ("./head.php");
?>

<?php
$mAgent = explode("|", BD_MOBILE_AGENT);
$chkMobile = false;
for($i=0; $i<sizeof($mAgent); $i++){
	if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
		$chkMobile = true;
		break;
	}
}
if(!$chkMobile) {
?>
<script>
var popupEvent = "";
var windowObjHistorySearch = null;

<?php
	$sql = "SELECT * from popup_data WHERE pu_useYN='1'" ;
	$res = sql_query($sql);
	for ($i = 0; $row = sql_fetch_array($res); $i++) {
?>
	popupEvent = getCookie("popup<?php echo $row['pu_no']?>");
	if(!popupEvent){
		window.open("popup.php?pu_no=popup<?php echo $row['pu_no']?>","<?php echo $row['pu_no']?>","width=<?php echo $row['pu_width']?>,height=<?php echo $row['pu_height']?>,status=no,toolbar=0,menubar=no");
	}

<?php }?>

function getCookie(name) {
	var Found = false;
	var start, end;
	var i = 0;

	// cookie 문자열 전체를 검색
	while(i <= document.cookie.length) {
		 start = i;
		 end = start + name.length;
		 // name과 동일한 문자가 있다면
		 if(document.cookie.substring(start, end) == name) {
			 Found = true;
			 break;
		 }
		 i++;
	}

	// name 문자열을 cookie에서 찾았다면
	if(Found == true) {
		start = end + 1;
		end = document.cookie.indexOf(";", start);
		// 마지막 부분이라는 것을 의미(마지막에는 ";"가 없다)
		if(end < start)
			end = document.cookie.length;
		// name에 해당하는 value값을 추출하여 리턴한다.
		return document.cookie.substring(start, end);
	}
	// 찾지 못했다면
	return false;
}
</script>
<?php }?>
<body>
	
<button type= "button" onclick = "location.href='./scheduler.php'">스케줄러 이동
<button type= "button" onclick = "location.href='./calendar.php'">캘린더 이동


</body>
<?php include_once("./tail.php");?>