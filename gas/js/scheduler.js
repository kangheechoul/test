$(document).ready(function(){
    page_init();
})

function page_init()
{
    var today = new Date();

    var year = today.getFullYear();
    var month = today.getMonth() + 1;
    var date = today.getDate();

    if(month < 10)
    {
        month = "0" + month;
    }


    $("#view_month").text(year + "-"+ month + "-"+date);
    
    month_now();
}

function month_now()
{
    $.ajax({
        type : "POST",
        url : "controller/scheduler.php",
        data : {
            function : "now_month",
            date : $("#view_month").text(),
        },
        success : function(result)
        {
            result = JSON.parse(result);
            data_list(result);
        }
    })
}



function month_prev()
{
    $.ajax({
        type : "POST",
        url : "controller/scheduler.php",
        data : {
            function : "prev_month",
            date : $("#view_month").text(),
        },
        success : function(result)
        {
            result = JSON.parse(result);
            data_list(result);
        }
    })
}

function month_next()
{
    $.ajax({
        type : "POST",
        url : "controller/scheduler.php",
        data : {
            function : "next_month",
            date : $("#view_month").text(),
        },
        success : function(result)
        {
            result = JSON.parse(result);
            data_list(result);
        }
    })
}

function data_list(datas)
{
    if(scheduler.children.length != 0)
    {
        while(scheduler.children.length != 0)
        {
            scheduler.removeChild(scheduler.childNodes[0]);//헤더 자식노드 삭제
        }
    }

    var date_li = $("[data-copy]");
    var view_month = datas.year + "-" + datas.month + "-01";
    $("#view_month").text(view_month);

    //날짜 개수만큼 만들기
    for(var i = 0; i < datas.last_day; i ++)
    {
        var clone = date_li.clone();
        clone.attr("data-copy" ,"");
        clone2 = clone.find("[data-attr]");

       
        // copy 데이터의 data-attr 만큼 순환
        for(j=0; j < clone2.length; j++)
        {
            var name = clone2.eq(j).attr("data-attr");
            date = i+1;
            if(date < 10)
            {
                date = "0"+date;
            }

            var view_date = datas.year + "-" + datas.month+"-"+date;
            
            if(name == "date")
            {
                clone2.eq(j).text(view_date);
            }
            else if(name == "info")
            {
                if(datas.value != undefined)
                {
                    var value = datas.value;
                    for(k=0;k<value.length;k++)
                    {
                        arr_temp = value[k].exam_date.split(" ");
                        if(arr_temp[0] == view_date)
                        {
                            clone2.eq(j).text(arr_temp[1] + "예약");
                        }
                    }
                }
            }
            else if(name == "week")
            {
                if(week(view_date) == "일")
                {
                    clone2.eq(j).attr("class", clone2.attr("class")+" sunday");
                }
                else if(week(view_date) == "토")
                {
                    clone2.eq(j).attr("class", clone2.attr("class")+" saturday");
                }
                else
                {
                    clone2.eq(j).attr("class", clone2.attr("class")+" weekday");
                }
            }
        }
        $("#scheduler").append(clone);
    }
}

function week(date)
{
    var week = new Array('일', '월', '화', '수', '목', '금', '토');

    var day = new Date(date).getDay();

    var label = week[day];
    return label;
}



function insert_scheduler()
{
    var list = {};
    var data = scheduler_form.getElementsByTagName("input");

    for(i = 0; i < data.length; i++)
    {
        list[data[i].id] = data[i].value;
    }
    
    console.log(JSON.stringify(list));
    
    $.ajax({
        type : "POST",
        url : "controller/scheduler.php",
        data : {
            function : "insert",
            data : list,
        },
        success : function(result)
        {
            result = JSON.parse(result);
            console.log(result);
            if(result.result == 1)
            {
                location.reload();
            }
        }
    })
}



