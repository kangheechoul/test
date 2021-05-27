$(document).ready(function()
{
    $("#password").focus(function(){
        $("#password").blur(function(){
                password_check();
        })
    });

    $("#re_password").focus(function(){
        $("#re_password").blur(function(){
            re_password_check();
        })
    });

    $("#manager").focus(function(){
        $("#manager").blur(function(){
            name_check("manager");
        })
    });

    $("#hp_admin_name").focus(function(){
        $("#hp_admin_name").blur(function(){
            name_check("hp_admin_name");
        })
    });

    $("#birth").focus(function(){
        $("#birth").blur(function(){
            day_check("birth");
        })
    });

    $("#hp_birth").focus(function(){
        $("#hp_birth").blur(function(){
            day_check("hp_birth");
        })
    });

    $("#email").focus(function(){
        $("#email").blur(function(){
            email_check("email");
        })
    });

    $("#hp_email").focus(function(){
        $("#hp_email").blur(function(){
            email_check("hp_email");
        })
    });

    $("#phone").focus(function(){
        $("#phone").blur(function(){
            phone_check("phone");
        })
    });

    $("#hp_call").focus(function(){
        $("#hp_call").blur(function(){
            phone_check("hp_call");
        })
    });

    $("#hp_address2").focus(function(){
        $("#hp_address2").blur(function(){
            address_check();
        })
    });

    $("#all_check").on("change", function()
    {
        all_check(this);
    });

    $("input[name='check']").on("change", function()
    {
        all_check(this);
    });
    
})

function find_address()
{
    new daum.Postcode({
        
        oncomplete: function(data)
        {
            // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var roadAddr = data.roadAddress; // 도로명 주소 변수
            var extraRoadAddr = ''; // 참고 항목 변수

            // 법정동명이 있을 경우 추가한다. (법정리는 제외)
            // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
            if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                extraRoadAddr += data.bname;
            }
            // 건물명이 있고, 공동주택일 경우 추가한다.
            if(data.buildingName !== '' && data.apartment === 'Y'){
                extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
            }
            // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
            if(extraRoadAddr !== ''){
                extraRoadAddr = ' (' + extraRoadAddr + ')';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            obj.elem.hp_zonecode.value = data.zonecode;
            obj.elem.hp_address1.value = roadAddr + " " + extraRoadAddr;
        }
    }).open();
}

// 계정정보 -----
function id_check()
{
    var id_return = true;

    if(obj.elem.id.value == "")
    {
        obj.elem.id_text.innerHTML = "공백불가";
        obj.elem.id_text.className = "no_check_text";
        id_return = false;
        return false;
    }
    if(lb.id(obj.elem.id.value))
    {
        lb.ajax({
            type : "JsonAjaxPost",
            list : {
                ctl : "Hospital",
                param1 : "id_check",
                id : obj.elem.id.value,
            },
            havior : function(result)
            {
                result = JSON.parse(result);
                if(result.result == 1)
                {
                    if(result.value[0].count < 1)
                    {
                        obj.elem.id_text.innerHTML = "사용가능";
                        obj.elem.id_text.className = "check_text";
                        id_return = true;
                    }
                    else
                    {
                        obj.elem.id_text.innerHTML = "사용중인 아이디";
                        obj.elem.id_text.className = "no_check_text";
                        id_return = false;
                    }
                }
                else
                {
                    obj.elem.id_text.innerHTML = "오류";
                    obj.elem.id_text.className = "no_check_text";
                    id_return = false;
                }

            }
        })
    }
    else
    {
        obj.elem.id_text.innerHTML = "아이디 형식을 맞춰주세요";
        obj.elem.id_text.className = "no_check_text";
        id_return = false;
    }
    return id_return;
}

function password_check()
{
    if(obj.elem.password.value == "")
    {
        obj.elem.password_text.innerHTML = "공백불가";
        obj.elem.password_text.className = "no_check_text";
        return false;
    }
    else
    {
        if(lb.password(obj.elem.password.value))
        {
            obj.elem.password_text.innerHTML = "사용가능";
            obj.elem.password_text.className = "check_text";
            return true;
        }
        else
        {
            obj.elem.password_text.innerHTML = "사용불가";
            obj.elem.password_text.className = "no_check_text";
            return false;
        }
    }
}

function re_password_check()
{
    if(obj.elem.password.value == obj.elem.re_password.value)
    {
        obj.elem.re_password_text.innerHTML = "일치합니다";
        obj.elem.re_password_text.className = "check_text";
        return true;
    }
    else
    {
        obj.elem.re_password_text.innerHTML = "일치하지 않습니다";
        obj.elem.re_password_text.className = "no_check_text";
        return false;
    }
}

function day_check(string)
{
    var pattern = /(19[0-9][0-9]|20\d{2})(0[0-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])$/

    if(obj.elem[string].value == "")
    {
        obj.elem[string+"_text"].innerHTML = "공백불가";
        obj.elem[string+"_text"].className = "no_check_text";
        return false;
    }
    else
    {
        if(pattern.test(obj.elem[string].value))
        {
            obj.elem[string+"_text"].innerHTML = "사용가능";
            obj.elem[string+"_text"].className = "check_text";
            return true;
        }
        else
        {
            obj.elem[string+"_text"].innerHTML = "형식에 맞춰주세요";
            obj.elem[string+"_text"].className = "no_check_text";
            return false;
        }
    }
}

function name_check(string)
{
    var name_return = true;
    var check_obj = 
    {
        "name" : "특수문자",
        "str" : obj.elem[string].value,
    }
    var span = string + "_text";

    var pattern = /([^가-힣\x20])/i;

    if(obj.elem[string].value == "")
    {
        obj.elem[span].innerHTML = "공백불가";
        obj.elem[span].className = "no_check_text";
        name_return = false;
        return false;
    }

    if(!lb.reg(check_obj) && !pattern.test(check_obj["str"]))
    {
        if(string == "hp_name")
        {
        lb.ajax({
            type : "JsonAjaxPost",
            list : {
                ctl : "Hospital",
                param1 : "hospital_check",
                name : heck_obj["str"],
            },
            havior : function(result)
            {
                result = JSON.parse(result);
                if(result.result == 1)
                {
                    if(result.value[0].count < 1)
                    {
                        obj.elem[span].innerHTML = "가입 가능한 기업";
                        obj.elem[span].className = "check_text";
                        name_return = true;
                    }
                    else
                    {
                        obj.elem[span].innerHTML = "이미 가입한 기업입니다";
                        obj.elem[span].className = "no_check_text";
                        name_return = false;
                    }
                }
                else
                {
                    obj.elem[span].innerHTML = "오류";
                    obj.elem[span].className = "no_check_text";
                    name_return = false;
                }
            }
        })
        }
        else
        {
            obj.elem[span].innerHTML = "사용가능";
            obj.elem[span].className = "check_text";
            name_return = true;
        }
    }
    else
    {
        obj.elem[span].innerHTML = "사용불가";
        obj.elem[span].className = "no_check_text";
        name_return = false;
    }
    return name_return;
}

function phone_check(string)
{
    var pattern = /0([0-9]{2})-([0-9]{4})-([0-9]{4})/

    var span = string+"_text";

    var phone_return = true;
    
    if(obj.elem[string].value == "")
    {
        obj.elem[span].innerHTML = "공백불가";
        obj.elem[span].className = "no_check_text";
        return false;
    }

    if(pattern.test(obj.elem[string].value))
    {
        lb.ajax({
            type : "JsonAjaxPost",
            list : {
                ctl : "Hospital",
                param1 : "phone_check",
                type : string,
                phone : obj.elem[string].value,
            },
            havior : function(result)
            {
                result = JSON.parse(result);
                if(result.result == 1 )
                {
                    if(result.value[0].count < 1)
                    {
                        obj.elem[span].innerHTML = "사용가능";
                        obj.elem[span].className = "check_text";
                        phone_return = true;
                    }
                    else
                    {
                        obj.elem[span].innerHTML = "사용중";
                        obj.elem[span].className = "no_check_text";
                        phone_return = false;
                    }
                }
                else
                {
                    obj.elem[span].innerHTML = "오류";
                    obj.elem[span].className = "no_check_text";
                    phone_return = false;
                }
            }
        })
    }
    else
    {
        obj.elem[span].innerHTML = "사용불가";
        obj.elem[span].className = "no_check_text";
        phone_return = false;
    }
    return phone_return;
}

function email_check(string)
{
    var email = 
    {
        "name" : "email",
        "str" : obj.elem[string].value,
    };

    var span = string + "_text";
    
    var email_return = true;

    // 사용중 체크 필요
    if(obj.elem[string].value == "")
    {
        obj.elem[span].innerHTML = "공백불가";
        obj.elem[span].className = "no_check_text";
        email_return = false;
    }

    if(lb.reg(email))
    {
        lb.ajax({
            type : "JsonAjaxPost",
            list : {
                ctl : "Hospital",
                param1 : "email_check",
                email : obj.elem[string].value,
                type : string,
            },
            havior : function(result)
            {
                result = JSON.parse(result);
                if(result.result == 1)
                {
                    if(result.value[0].count < 1)
                    {
                        obj.elem[span].innerHTML = "사용가능";
                        obj.elem[span].className = "check_text";
                        email_return = true;
                    }
                    else
                    {
                        obj.elem[span].innerHTML = "사용중인 이메일입니다";
                        obj.elem[span].className = "no_check_text";
                        email_return = false;
                    }
                }
                else
                {
                    obj.elem[span].innerHTML = "오류";
                    obj.elem[span].className = "no_check_text";
                    email_return = true;
                }
            }
        })
    }
    else
    {
        obj.elem[span].innerHTML = "형식에 맞춰주세요";
        obj.elem[span].className = "no_check_text";
        email_return = false;
    }
    return email_return;
}

function address_check()
{
    if(obj.elem.hp_zonecode.value == "" || obj.elem.hp_address1.value == ""|| obj.elem.hp_address2.value == "")
    {
        obj.elem.hp_address_text.innerHTML = "공백불가";
        obj.elem.hp_address_text.className = "no_check_text";
        return false;
    }
    else
    {
        obj.elem.hp_address_text.innerHTML = "사용가능";
        obj.elem.hp_address_text.className = "check_text";
        return true;
    }
}
// --------- 계정정보

//체크박스 검사
function reception_check()
{
    var check_arr = new Array();

    $("input[name='check']:checked").each(function(i, ele)
    {
        index = $(ele).index("input:checkbox[name='check']");
        check_arr.push(index);
    });

    if(check_arr.includes(0) == true  && check_arr.includes(1) == true)
    {
        obj.elem.hp_reception.value = check_arr;
        return true;
    }
    else
    {
        obj.elem.hp_reception.value = "";
        alert("필수 항목에 동의해주세요");
        return false;
    }
}

function all_check(ele)
{
    var id = ele.id;
     
    if(id == "all_check")
    {
        if($("#all_check").is(":checked"))
        {
            $("input[name='check']").prop("checked",true);
        }
        else
        {
            $("input[name='check']").prop("checked",false);
        }
    }
    else
    {
        check_length = $("input[name='check']:checked").length;
        if(check_length == 4)
        {
            $("#all_check").prop("checked", true);
        }
        else
        {
            $("#all_check").prop("checked", false);
        }
    }
}

function join()
{
    if(!id_check())
    {
        id.focus();
        return false;
    }
    else if(!password_check())
    {
        password.focus();
        return false;
    }
    else if(!re_password_check())
    {
        re_password.focus();
        return false;
    }
    else if(!name_check("manager"))
    {
        manager.focus();
        return false;
    }
    else if(!day_check("birth"))
    {
        birth.focus();
        return false;
    }
    else if(!phone_check("phone"))
    {
        phone.focus();
        return false;
    }
    else if(!email_check("email"))
    {
        email.focus();
        return false;
    }
    else if(!name_check("hp_name"))
    {
        hp_name.focus();
        return false;
    }
    else if(!name_check("hp_admin_name"))
    {
        hp_admin_name.focus();
        return false;
    }
    else if(!business_num_check())
    {
        business_num.focus();
        return false;
    }
    else if(!phone_check("hp_call"))
    {
        hp_call.focus();
        return false;
    }
    else if(!email_check("hp_email"))
    {
        hp_email.foucs();
        return false;
    }
    else if(!address_check())
    {
        hp_address2.focus();
        return false;
    }
    else if(!reception_check())
    {
        obj.elem.all_check.focus();
        return false;
    }
    else
    {
        join_submit();
    }
}

function join_submit()
{

    lb.ajax({
        type  : "AjaxFormPost",
        list : {
            ctl : "Hospital",
            param1 : "join",
        },
        action : "index.php",
        elem : lb.getElem("join_form"),
        havior : function(result)
        {
            result = JSON.parse(result);
            console.log(result)
        }
    })
}