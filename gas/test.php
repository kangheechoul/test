<!-- 
[section_wrap]
type="num" 숫자로 체크
dot="loop" 도트 8 -> 1

[section]
data-type 단일(1), 다중(2),
data-answer 정답
data-Reg 순서대로 값만추가
data-max 정답개수[삭제]
data-null 앞뒤 공백 무시
data-partial 부분 점수

[ul]
col2 한줄에 2개~
-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" dir="ltr">
<head>
<title></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=768, height=1024"/>

<link rel="stylesheet" type="text/css" href="css/fonts/fonts.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/animate.css" />
<link rel="stylesheet" type="text/css" href="css/workbook.css" />

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript" src="js/DTCaliperSensor.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>
<body>
    <div class="section_wrap" type="num" dot="">
        <section class="focus" data-type="1" data-user="0" data-answer="1">
            <h1>대화를 듣고 (1개)</h1>
            <ul class="col2">
                <li>
                    <span>Have a nice day.</span>                
                </li>
                <li>                    
                    <span>Not bad, thanks.</span>                
                </li>
                <li>
                    <span>How do you do?</span>
                </li>
                <li>                    
                    <span>Nice to meet you.</span>                
                </li>
                <li>                    
                    <span>I’m from Korea. </span>
                </li>
            </ul>
            <div class="ddddd">힌트</div>
        </section>
        <section data-type="2" data-answer="1,2">
            <h1>
                대화를 듣고, 남자의 마지막 말에 이어질 여자의 응답으로 알맞은 것을 고르시오. (다중 순서x)                
            </h1>
            <ul class="col3">
                <li>                    
                    <span>Have a nice day.</span>
                </li>
                <li>                    
                    <span>Not bad, thanks.</span>
                </li>
                <li>                    
                    <span>How do you do?</span>
                </li>
                <li>                    
                    <span>Nice to meet you.</span>
                </li>
                <li>                    
                    <span>I’m from Korea. </span>
                </li>
            </ul>
            <div class="ddddd">2222</div>
        </section>  
        <section data-type="2" data-answer="1,4" data-Reg="0">
            <h1>
                대화를 듣고, 순서대로 고르시오. [1,4=o][4,1=x]                
            </h1>
            <ul class="col4">
                <li>                    
                    <span>Have a nice day.</span>
                </li>
                <li>                    
                    <span>Not bad, thanks.</span>
                </li>
                <li>                    
                    <span>How do you do?</span>
                </li>
                <li>                    
                    <span>Nice to meet you.</span>
                </li>
                <li>                    
                    <span>I’m from Korea. </span>
                </li>
            </ul>    
        </section>
        <section data-type="2" data-answer="1,4" data-max="2">
            <h1>
                대화를 듣고, 순서대로 고르시오. (최대 2개)                
            </h1>
            <ul class="col4">
                <li>                    
                    <span>Have a nice day.</span>
                </li>
                <li>                    
                    <span>Not bad, thanks.</span>
                </li>
                <li>                    
                    <span>How do you do?</span>
                </li>
                <li>                    
                    <span>Nice to meet you.</span>
                </li>
                <li>                    
                    <span>I’m from Korea.</span>
                </li>
            </ul>
        </section>
        <section data-type="3" data-answer="1">
            <h1>
                (aaa , bbb , ccc) 순서대로 모든 공백 무시
            </h1>
            <div>
                <input type="text" data-Tans="aaa" />
                <input type="text" data-Tans="bbb" />
                <input type="text" data-Tans="ccc" />
            </div>
        </section>
        <section data-type="3" data-answer="1" data-null="on">
            <h1>
                (ddd , eee , fff) 순서대로 앞뒤 공백 무시
            </h1>
            <div>
                <input type="text" data-Tans="ddd" />
                <input type="text" data-Tans="eee" />
                <input type="text" data-Tans="fff" />
            </div>
        </section>
        <section data-type="3" data-answer="1" data-idx="0" data-null="on">
            <h1>
                (ggg , hhh , iii) 순서x
            </h1>
            <div>
                <input type="text" data-Tans="ggg" />
                <input type="text" data-Tans="hhh" />
                <input type="text" data-Tans="iii" />
            </div>
        </section>
        <section data-type="3" data-answer="1" data-idx="0" data-null="on" data-partial="">
            <h1>
                (jjj , kkk , lll) 순서x , 부분 점수                
            </h1>
            <div>
                <input type="text" data-Tans="jjj" />
                <input type="text" data-Tans="kkk" />
                <input type="text" data-Tans="lll" />
            </div>
        </section>        
    </div>
    <div class="page_wrap">
        <span class="prev handler"></span>
        <div class="pageing_wrap">            
            <ul class="workbookpage"></ul>
        </div>        
        <span class="next handler"></span>
    </div>
    <span class="totlebtn"></span>
    <div id="total_s">0</div>

    <script>
        //<![CDATA[
        // 퀴즈 소스

        var all_check = 0;

        var tot_cnt = 0;
        var correct_cnt = 0;

        function initCaliper(obj, type, quizNum, num) {
            //,singlechoice
            //console.log( obj );

            var q_type = ["fillInTheBlank", "multipleChoice", "singleChoice", "trueFalse", "essay", "etc"];
            var q_type_desc = ["단답형 문제", "다중 선택형", "단일 선택형", "진위형", "서술형", "매칭형 등 기타"];
            //console.log( q_type[type] );

            /*
            data-q_type :
            단답형: fillInTheBlank 0
            다중 선택형: multipleChoice 1
            단일 선택형: singleChoice 2
            진위형: trueFalse 3
            서술형: essay 4
            매칭형 등 기타: “etc” 5
            */
            var itemText = "item_" + quizNum;

            var ans_obj = obj.find("[data-ans]");
            var ans_res = [];

            for (var i = 0; i < ans_obj.length; i++) {

                if (type == 1 || type == 2) {
                    //$(ans_obj[i]).data("ans")

                    if ($(ans_obj[i]).attr("data-ans") == "1")
                        ans_res.push(i + 1);
                }
                else {
                    ans_res.push($(ans_obj[i]).attr("data-ans"));

                }
            }

            var elem = "";
            elem += "<assessmentItem class='assessmentItem' data-qid='" + itemText + "' data-response-type='" + q_type[type] + "'>"
            elem += "   <itemBody class='itemBody'>"
            elem += "</itemBody>"
            elem += "<correctResponse class='correctResponse' style='display: none;'>" + ans_res.toString() + "</correctResponse>"
            elem += "</assessmentItem>"

            obj.attr("data-desc", q_type_desc[type] + " " + num);

            obj.before(elem);
            var ox = $("[data-qid=" + itemText + "]").find(".itemBody");

            obj.appendTo(ox);


        }

    </script>
</body>



</html>