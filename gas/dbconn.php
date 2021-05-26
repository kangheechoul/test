<?php
define('BD_MYSQL_HOST', '203.235.58.3');
define('BD_MYSQL_USER', 'badasoft');
define('BD_MYSQL_PASSWORD', 'qkek_db_thvmxm_^^');
define('BD_MYSQL_DB', 'gas');
define('BD_MYSQL_SET_MODE', false);
//$db_host = '203.235.27.14';
$db_host = '203.235.58.3';
$db_user = 'badasoft';
$db_pass = 'qkek_db_thvmxm_^^';
$conn = new mysqli($db_host,$db_user,$db_pass,'gas');
mysqli_set_charset ($conn , "UTF8");
?>