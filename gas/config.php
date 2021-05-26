<?php

/********************
    상수 선언
********************/

if (PHP_VERSION >= '5.1.0') {
    //if (function_exists("date_default_timezone_set")) date_default_timezone_set("Asia/Seoul");
    date_default_timezone_set("Asia/Seoul");
}

/********************
    경로 상수
********************/

/*
보안서버 도메인
회원가입, 글쓰기에 사용되는 https 로 시작되는 주소를 말합니다.
포트가 있다면 도메인 뒤에 :443 과 같이 입력하세요.
보안서버주소가 없다면 공란으로 두시면 되며 보안서버주소 뒤에 / 는 붙이지 않습니다.
입력예) https://www.domain.com:443/gnuboard5
*/
define('BD_DOMAIN', '');
define('BD_HTTPS_DOMAIN', '');

// 디버깅 상수, 실제 서버운영시 false 로 설정해 주제요.
define('BD_DEBUG', false);

// Set Databse table default engine is Databse default_storage_engine, If you want to use MyISAM or InnoDB, change to MyISAM or InnoDB.
define('BD_DB_ENGINE', '');

// Set Databse table default Charset
// utf8, utf8mb4 등 지정 가능 기본값은 utf8, 설치전에 utf8mb4 으로 수정시 모든 테이블에 이모지 입력이 가능합니다. utf8mb4 는 mysql 또는 mariadb 5.5 버전 이상을 요구합니다.
define('BD_DB_CHARSET', 'utf8');

/*
www.sir.kr 과 sir.kr 도메인은 서로 다른 도메인으로 인식합니다. 쿠키를 공유하려면 .sir.kr 과 같이 입력하세요.
이곳에 입력이 없다면 www 붙은 도메인과 그렇지 않은 도메인은 쿠키를 공유하지 않으므로 로그인이 풀릴 수 있습니다.
*/
define('BD_COOKIE_DOMAIN',  '');

define('BD_DBCONFIG_FILE',  'dbconn.php');

// URL 은 브라우저상에서의 경로 (도메인으로 부터의)
if (BD_DOMAIN) {
    define('BD_URL', BD_DOMAIN);
} else {
    if (isset($g5_path['url']))
        define('BD_URL', $g5_path['url']);
    else
        define('BD_URL', '');
}

if (isset($g5_path['path'])) {
    define('BD_PATH', $g5_path['path']);
} else {
    define('BD_PATH', '');
}

//==============================================================================


//==============================================================================
// 사용기기 설정
// pc 설정 시 모바일 기기에서도 PC화면 보여짐
// mobile 설정 시 PC에서도 모바일화면 보여짐
// both 설정 시 접속 기기에 따른 화면 보여짐
//------------------------------------------------------------------------------
define('BD_SET_DEVICE', 'both');

define('BD_USE_MOBILE', false); // 모바일 홈페이지를 사용하지 않을 경우 false 로 설정
define('BD_USE_CACHE',  true); // 최신글등에 cache 기능 사용 여부


/********************
    시간 상수
********************/
// 서버의 시간과 실제 사용하는 시간이 틀린 경우 수정하세요.
// 하루는 86400 초입니다. 1시간은 3600초
// 6시간이 빠른 경우 time() + (3600 * 6);
// 6시간이 느린 경우 time() - (3600 * 6);
define('BD_SERVER_TIME',    time());
define('BD_TIME_YMDHIS',    date('Y-m-d H:i:s', BD_SERVER_TIME));
define('BD_TIME_YMD',       substr(BD_TIME_YMDHIS, 0, 10));
define('BD_TIME_HIS',       substr(BD_TIME_YMDHIS, 11, 8));

// 입력값 검사 상수 (숫자를 변경하시면 안됩니다.)
define('BD_ALPHAUPPER',      1); // 영대문자
define('BD_ALPHALOWER',      2); // 영소문자
define('BD_ALPHABETIC',      4); // 영대,소문자
define('BD_NUMERIC',         8); // 숫자
define('BD_HANGUL',         16); // 한글
define('BD_SPACE',          32); // 공백
define('BD_SPECIAL',        64); // 특수문자

// SEO TITLE 문단 길이
define('BD_SEO_TITEL_WORD_CUT', 8);        // SEO TITLE 문단 길이

// 퍼미션
define('BD_DIR_PERMISSION',  0755); // 디렉토리 생성시 퍼미션
define('BD_FILE_PERMISSION', 0644); // 파일 생성시 퍼미션

// 모바일 인지 결정 $_SERVER['HTTP_USER_AGENT']
define('BD_MOBILE_AGENT',   'phone|samsung|lgtel|mobile|[^A]skt|nokia|blackberry|BB10|Android|sony');

// SMTP
// lib/mailer.lib.php 에서 사용
define('BD_SMTP',      '127.0.0.1');
define('BD_SMTP_PORT', '25');


/********************
    기타 상수
********************/

// 암호화 함수 지정
// 사이트 운영 중 설정을 변경하면 로그인이 안되는 등의 문제가 발생합니다.
// 5.4 버전 이전에는 sql_password 이 사용됨, 5.4 버전부터 기본이 create_hash 로 변경
define('BD_STRING_ENCRYPT_FUNCTION', 'sql_password');
// define('BD_STRING_ENCRYPT_FUNCTION', 'create_hash');
define('BD_MYSQL_PASSWORD_LENGTH', 41);         // mysql password length 41, old_password 의 경우에는 16

// SQL 에러를 표시할 것인지 지정
// 에러를 표시하려면 TRUE 로 변경
define('BD_DISPLAY_SQL_ERROR', FALSE);

// escape string 처리 함수 지정
// addslashes 로 변경 가능
define('BD_ESCAPE_FUNCTION', 'sql_escape_string');

// sql_escape_string 함수에서 사용될 패턴
//define('BD_ESCAPE_PATTERN',  '/(and|or).*(union|select|insert|update|delete|from|where|limit|create|drop).*/i');
//define('BD_ESCAPE_REPLACE',  '');

// 게시판에서 링크의 기본개수를 말합니다.
// 필드를 추가하면 이 숫자를 필드수에 맞게 늘려주십시오.
define('BD_LINK_COUNT', 2);

// 썸네일 jpg Quality 설정
define('BD_THUMB_JPG_QUALITY', 90);

// 썸네일 png Compress 설정
define('BD_THUMB_PNG_COMPRESS', 5);

// 모바일 기기에서 DHTML 에디터 사용여부를 설정합니다.
define('BD_IS_MOBILE_DHTML_USE', false);

// MySQLi 사용여부를 설정합니다.
define('BD_MYSQLI_USE', true);

// Browscap 사용여부를 설정합니다.
define('BD_BROWSCAP_USE', true);

// 접속자 기록 때 Browscap 사용여부를 설정합니다.
define('BD_VISIT_BROWSCAP_USE', false);

// ip 숨김방법 설정
/* 123.456.789.012 ip의 숨김 방법을 변경하는 방법은
\\1 은 123, \\2는 456, \\3은 789, \\4는 012에 각각 대응되므로
표시되는 부분은 \\1 과 같이 사용하시면 되고 숨길 부분은 ♡등의
다른 문자를 적어주시면 됩니다.
*/
define('BD_IP_DISPLAY', '\\1.♡.\\3.\\4');

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {   //https 통신일때 daum 주소 js
    define('BD_POSTCODE_JS', '<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>');
} else {  //http 통신일때 daum 주소 js
    define('BD_POSTCODE_JS', '<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>');
}
?>