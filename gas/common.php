<?php
session_start();
/*******************************************************************************
** 공통 변수, 상수, 코드
*******************************************************************************/
error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );

// 보안설정이나 프레임이 달라도 쿠키가 통하도록 설정
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

if (!defined('BD_SET_TIME_LIMIT')) define('BD_SET_TIME_LIMIT', 0);
@set_time_limit(BD_SET_TIME_LIMIT);

if( version_compare( PHP_VERSION, '5.2.17' , '<' ) ){
    die(sprintf('PHP 5.2.17 or higher required. Your PHP version is %s', PHP_VERSION));
}

//==========================================================================================================================
// extract($_GET); 명령으로 인해 page.php?_POST[var1]=data1&_POST[var2]=data2 와 같은 코드가 _POST 변수로 사용되는 것을 막음
// 081029 : letsgolee 님께서 도움 주셨습니다.
//--------------------------------------------------------------------------------------------------------------------------
$ext_arr = array ('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST',
                  'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS',
                  'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS');
$ext_cnt = count($ext_arr);
for ($i=0; $i<$ext_cnt; $i++) {
    // POST, GET 으로 선언된 전역변수가 있다면 unset() 시킴
    if (isset($_GET[$ext_arr[$i]]))  unset($_GET[$ext_arr[$i]]);
    if (isset($_POST[$ext_arr[$i]])) unset($_POST[$ext_arr[$i]]);
}
//==========================================================================================================================


function g5_path()
{
    $chroot = substr($_SERVER['SCRIPT_FILENAME'], 0, strpos($_SERVER['SCRIPT_FILENAME'], dirname(__FILE__)));
    $result['path'] = str_replace('\\', '/', $chroot.dirname(__FILE__));
    $server_script_name = preg_replace('/\/+/', '/', str_replace('\\', '/', $_SERVER['SCRIPT_NAME']));
    $server_script_filename = preg_replace('/\/+/', '/', str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']));
    $tilde_remove = preg_replace('/^\/\~[^\/]+(.*)$/', '$1', $server_script_name);
    $document_root = str_replace($tilde_remove, '', $server_script_filename);
    $pattern = '/.*?' . preg_quote($document_root, '/') . '/i';
    $root = preg_replace($pattern, '', $result['path']);
    $port = ($_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443) ? '' : ':'.$_SERVER['SERVER_PORT'];
    $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '') . '://';
    $user = str_replace(preg_replace($pattern, '', $server_script_filename), '', $server_script_name);
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    if(isset($_SERVER['HTTP_HOST']) && preg_match('/:[0-9]+$/', $host))
        $host = preg_replace('/:[0-9]+$/', '', $host);
    $host = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*]/", '', $host);
    $result['url'] = $http.$host.$port.$user.$root;
    return $result;
}

$g5_path = g5_path();

include_once($g5_path['path'].'/config.php');   // 설정 파일

unset($g5_path);
//==============================================================================
// SQL Injection 등으로 부터 보호를 위해 sql_escape_string() 적용
//------------------------------------------------------------------------------
// magic_quotes_gpc 에 의한 backslashes 제거
// if (get_magic_quotes_gpc()) {
//     $_POST    = array_map_deep('stripslashes',  $_POST);
//     $_GET     = array_map_deep('stripslashes',  $_GET);
//     $_COOKIE  = array_map_deep('stripslashes',  $_COOKIE);
//     $_REQUEST = array_map_deep('stripslashes',  $_REQUEST);
// }

// // sql_escape_string 적용
// $_POST    = array_map_deep(BD_ESCAPE_FUNCTION,  $_POST);
// $_GET     = array_map_deep(BD_ESCAPE_FUNCTION,  $_GET);
// $_COOKIE  = array_map_deep(BD_ESCAPE_FUNCTION,  $_COOKIE);
// $_REQUEST = array_map_deep(BD_ESCAPE_FUNCTION,  $_REQUEST);

// 완두콩님이 알려주신 보안관련 오류 수정
// $member 에 값을 직접 넘길 수 있음
$config = array();
$member = array();
$board  = array();
$group  = array();
$bd     = array();
$qaconfig = array();
$bd_debug = array('php'=>array(),'sql'=>array());
//==============================================================================

// multi-dimensional array에 사용자지정 함수적용
function array_map_deep($fn, $array)
{
	if(is_array($array)) {
		foreach($array as $key => $value) {
			if(is_array($value)) {
				$array[$key] = array_map_deep($fn, $value);
			} else {
				$array[$key] = call_user_func($fn, $value);
			}
		}
	} else {
		$array = call_user_func($fn, $array);
	}

	return $array;
}

// PHP 4.1.0 부터 지원됨
// php.ini 의 register_globals=off 일 경우
@extract($_GET);
@extract($_POST);
@extract($_SERVER);

//==============================================================================
// 공통
//------------------------------------------------------------------------------

include_once(BD_PATH.'/lib/hook.lib.php');    // hook 함수 파일
include_once(BD_PATH.'/lib/get_data.lib.php');    // 데이타 가져오는 함수 모음

$dbconfig_file = BD_PATH.'/'.BD_DBCONFIG_FILE;

if (file_exists($dbconfig_file)) {
    include_once($dbconfig_file);
	include_once (BD_PATH."/lib/common.lib.php");    // 공통 라이브러리

    $connect_db = sql_connect(BD_MYSQL_HOST, BD_MYSQL_USER, BD_MYSQL_PASSWORD) or die('MySQL Connect Error!!!');
    $select_db  = sql_select_db(BD_MYSQL_DB, $connect_db) or die('MySQL DB Error!!!');

    // mysql connect resource $g5 배열에 저장 - 명랑폐인님 제안
    $bd['connect_db'] = $connect_db;

    sql_set_charset(BD_DB_CHARSET, $connect_db);
    if(defined('BD_MYSQL_SET_MODE') && BD_MYSQL_SET_MODE) sql_query("SET SESSION sql_mode = ''");

} else {
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>오류!</title>
</head>
<body>

	<div>오류</div>

</body>
</html>

<?php
    exit;
}
//==============================================================================


//==============================================================================
// SESSION 설정
//------------------------------------------------------------------------------
@ini_set("session.use_trans_sid", 0);    // PHPSESSID를 자동으로 넘기지 않음
@ini_set("url_rewriter.tags",""); // 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)

session_save_path(BD_SESSION_PATH);

if (isset($SESSION_CACHE_LIMITER))
    @session_cache_limiter($SESSION_CACHE_LIMITER);
else
    @session_cache_limiter("no-cache, must-revalidate");

ini_set("session.cache_expire", 180); // 세션 캐쉬 보관시간 (분)
ini_set("session.gc_maxlifetime", 10800); // session data의 garbage collection 존재 기간을 지정 (초)
ini_set("session.gc_probability", 1); // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
ini_set("session.gc_divisor", 100); // session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.

session_set_cookie_params(0, '/');
ini_set("session.cookie_domain", BD_COOKIE_DOMAIN);

if( ! class_exists('XenoPostToForm') ){
	class XenoPostToForm
	{
		public static function check() {
			return !isset($_COOKIE['PHPSESSID']) && count($_POST) && ((isset($_SERVER['HTTP_REFERER']) && !preg_match('~^https://'.preg_quote($_SERVER['HTTP_HOST'], '~').'/~', $_SERVER['HTTP_REFERER']) || ! isset($_SERVER['HTTP_REFERER']) ));
		}

		public static function submit($posts) {
			echo '<html><head><meta charset="UTF-8"></head><body>';
			echo '<form id="f" name="f" method="post">';
			echo self::makeInputArray($posts);
			echo '</form>';
			echo '<script>';
					echo 'document.f.submit();';
					echo '</script></body></html>';
			exit;
		}

		public static function makeInputArray($posts) {
			$res = array();
			foreach($posts as $k => $v) {
				$res[] = self::makeInputArray_($k, $v);
			}
			return implode('', $res);
		}

		private static function makeInputArray_($k, $v) {
			if(is_array($v)) {
				$res = array();
				foreach($v as $i => $j) {
					$res[] = self::makeInputArray_($k.'['.htmlspecialchars($i).']', $j);
				}
				return implode('', $res);
			}
			return '<input type="hidden" name="'.$k.'" value="'.htmlspecialchars($v).'" />';
		}
	}
}
?>