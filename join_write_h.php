<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS -->
    <?php include_once $this->project_path."include/common_css.php"; ?>
    <link rel="stylesheet" href="<?php echo $this->project_path?>/css/join.css">

    <!-- JS -->
    <?php include_once $this->project_path."include/common_js.php";?>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src = "<?php echo $this->project_path?>js/join_h.js<?php echo $version?>"></script>
</head>
<body>
    <div class="wrap">
    <?php include_once $this->project_path."include/login_header.php"; ?>
        <div class="container">
            <div class="bd-xs join_container">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="cf" id = "join_form" onsubmit= "return false">
                            <div class="title">
                                <h6><span>LPN BANK</span>병원(기업)회원</h6>
                            </div>
<!-- 
                            <div class="col-md-12 easy_log_wrap">
                                <div class="col-md-4">
                                    <a href="javascript:;">
                                        <img src="<?php echo $this->project_path?>/images/i-naver.png" alt="">
                                        <span>네이버 회원가입</span>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:;">
                                        <img src="<?php echo $this->project_path?>/images/i-kakao.png" alt="">
                                        <span>카카오 회원가입</span>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:;">
                                        <img src="<?php echo $this->project_path?>/images/i-google.png" alt="">
                                        <span>구글 회원가입</span>
                                    </a>
                                </div>
                            </div> -->
                            
                            <div class="col-md-12">
                                <ul class="col-md-12 join_write">
                                    <li>
                                        <input class="other_width" id = "id" name = "id" type="text" placeholder="아이디">
                                        <input type="button" onclick = "id_check()" value="중복확인">
                                        <span id = "id_text"></span>
                                    </li>
                                    <li>
                                        <input type="password" id = "password" name = "password" placeholder="비밀번호">
                                        <span>6~16자 영문 소문자, 숫자, 특수기호 모든 문자 사용가능</span>
                                        <span id = "password_text"></span>
                                    </li>
                                    <li>
                                        <input type="password" id = "re_password" name = "re_password" placeholder="비밀번호 확인">
                                        <span>비밀번호를 한번 더 입력해주세요.</span>
                                        <span id = "re_password_text"></span>
                                    </li>
                                    <li>
                                        <input type="text" id = "manager" name ="manager" placeholder="담당자명">
                                        <span id = "manager_text"></span>
                                    </li>
                                    <li>
                                        <input type="text" id = "birth" name = "birth" placeholder="생년월일">
                                        <span>'-' 없이 입력해 주세요 예)19920101</span>
                                        <span id = "birth_text"></span>
                                    </li>
                                    <li>
                                        <input class="other_width" id = "phone" name = "phone" type="text" placeholder="휴대폰번호">
                                        <input type="button" value="인증번호 요청">
                                        <span id = "phone_text"></span>
                                    </li>
                                    <li>
                                        <input class="other_width" type="text" id = "phone_check" name = "phone_check" placeholder="인증번호입력">
                                        <input type="button" value="인증번호 확인">
                                        <span id = "phone_check_text"></span>
                                    </li>
                                    <li>
                                        <input type="email" id = "email" name = "email" placeholder="이메일">
                                        <span id = "email_text"></span>
                                    </li>
                                </ul>
                                <h6>병원(기업)정보</h6>
                                <ul class="col-md-12 join_write">
                                    <li>
                                        <input type="text" id = "hp_name" name = "hp_name" placeholder="병원(기업)명">
                                        <span id = "hp_name_text"></span>
                                    </li>
                                    <li>
                                        <input type="text" id = "hp_admin_name" name = "hp_admin_name" placeholder="대표자명">
                                        <span id = "hp_admin_name_text"></span>
                                    </li>
                                    <li>
                                        <input type="text" id = "hp_birth" name = "hp_birth" placeholder="회사 설립일">
                                        <span>'-' 없이 입력해 주세요 예)19920101</span>
                                        <span id = "hp_birth_text"></span>
                                    </li>
                                    <li>
                                        <input type="text" id = "business_num" name = "business_num" placeholder="사업자등록번호">
                                        <span id = "business_num_text"></span>
                                    </li>

                                    <li>
                                        <input type="text" id = "hp_call" name = "hp_call" placeholder="대표전화">
                                        <span>1544, 1588 등의 전화번호는 지역번호 + 국번(1544) + 전화번호 형식으로 등록해 주세요.</span>
                                        <span id = "hp_call_text"> </span>
                                    </li>
                                    <li>
                                        <input type="email" id = "hp_email" name = "hp_email" placeholder="이메일">
                                        <span id = "hp_email_text"> </span>
                                    </li>
                                    <li>
                                        <input class="other_width" style = "width:40% !important" id = "hp_zonecode" name = "hp_zonecode" type="text" placeholder="우편번호" readonly>
                                        <input type="button" onclick = "find_address()" value="우편번호">
                                        <input class="" id = "hp_address1" name = "hp_address1" type="text" placeholder="주소" readonly>
                                        <input type="text" id = "hp_address2" name = "hp_address2" placeholder="상세주소">
                                        <span id = "hp_address_text"></span>

                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-12">
                                <ul class="check_wrap">
                                    <li class="check_all">
                                        <label for="all_check">
                                            <input type="checkbox" id = "all_check">
                                            전체동의
                                        </label>
                                    </li>
                                    <li>
                                        <label for="check1">
                                            <input type="checkbox" id = "check1" name = "check">
                                            이용약관 동의<span class="col-r">(필수)</span>
                                        </label>
                                        <a href="javascript:;">내용보기></a>
                                    </li>
                                    <li>
                                        <label for="check2">
                                            <input type="checkbox" id = "check2" name = "check">
                                            개인정보 수집 및 이용 동의<span class="col-r">(필수)</span>
                                        </label>
                                        <a href="javascript:;">내용보기></a>
                                    </li>
                                    <li>
                                        <label for="check3">
                                            <input type="checkbox" id = "check3" name = "check">
                                            마케팅 정보 이메일 수신 동의<span class="col-b">(선택)</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="check4">
                                            <input type="checkbox" id = "check4" name = "check">
                                            마케팅 SNS 수신 동의<span class="col-b">(선택)</span>
                                        </label>
                                    </li>
                                    <li>
                                        <input type = "text" id = "hp_reception" name = "hp_reception" value = "">
                                        <input type="button" name = "" onclick = "reception_check()" value = "테스트">
                                    </li>
                                </ul>
                            </div>
                        </form>
                        
                        <div class="btn_wrap text-center cf">
                            <button class="btn" onclick = "join()">가입하기</button>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>