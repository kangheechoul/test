$(document).ready(function()
{
    page_init();
});

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
    $("#view_month").text(year + "-06-"+date);
    
}



function week(date)
{
    var week = new Array('일', '월', '화', '수', '목', '금', '토');

    var day = new Date(date).getDay();

    var label = week[day];
    return label;
}

function now_month()
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
    console.log(datas);

    if(calendar.children.length != 0)
    {
        while(calendar.children.length != 0)
        {
            calendar.removeChild(calendar.childNodes[0]);//헤더 자식노드 삭제
        }
    }
    var date_li = $("[data-week]");
    $("[data-week]").remove();
    console.log(date_li);
    
    var day = 1;
    var view_date = "";

    for(var i = 0; i < datas.week.week; i++)
    {
        //일주일 복사
        //var week_clone = date_li.find("[data-week]").clone();
        var week_clone = date_li.clone();
        //일주일 중
        var date_clone = week_clone.find("[data-date]");
        for(var j = 0; j < 7; j++)
        {
                date_clone = date_clone.clone();
                if(i == 0)
                {
                    if(datas.week.fd_week <= j)
                    {
                        view_date = datas.year + "-" + datas.month + "-" + make_date(day);
                        attr = date_clone.find("[data-attr]");
                        
                        attr.eq(0).html(view_date);
                        for(var c = 0; c < datas.value.length; c++)
                        {
                            exam_temp = datas.value[c].exam_date.split(" ");
                            if(view_date == exam_temp[0])
                            {
                                for(var a = 0; a < attr.length; a++)
                                {
                                   if (attr.eq(a).attr("data-attr") == "info")
                                    {
                                        attr.eq(a).html(datas.value[c].exam_date);
                                    }
                                }
                            }
                        }
                        console.log(view_date);
                        day++;
                    }
                }
                else if(i == datas.week.week -1)
                {
                    if(datas.week.ld_week >= j)
                    {
                        view_date = datas.year + "-" + datas.month + "-" + make_date(day);
                        attr = date_clone.find("[data-attr]");

                        attr.eq(0).html(view_date);
                        for(var c = 0; c < datas.value.length; c++)
                        {
                            exam_temp = datas.value[c].exam_date.split(" ");
                            if(view_date == exam_temp[0])
                            {
                                for(var a = 0; a < attr.length; a++)
                                {
                                   if (attr.eq(a).attr("data-attr") == "info")
                                    {
                                        attr.eq(a).html(datas.value[c].exam_date);
                                    }
                                }
                            }
                        }
                        console.log(view_date);
                        day++;
                    }
                }
                else
                {
                    if(day < datas.last_day)
                    {
                        view_date = datas.year + "-" + datas.month + "-" + make_date(day);
                        attr = date_clone.find("[data-attr]");
    
                        attr.eq(0).html(view_date);
                        for(var c = 0; c < datas.value.length; c++)
                        {
                            exam_temp = datas.value[c].exam_date.split(" ");
                            if(view_date == exam_temp[0])
                            {
                                for(var a = 0; a < attr.length; a++)
                                {
                                   if (attr.eq(a).attr("data-attr") == "info")
                                    {
                                        attr.eq(a).html(datas.value[c].exam_date);
                                    }
                                }
                            }
                        }
                        console.log(view_date);
                        day++;
                    }
                    else 
                    {
                        view_date = "";
                        attr = date_clone.find("[data-attr]");
    
                        attr.eq(0).html(view_date);
                    }
                }
                week_clone.append(date_clone);
        }
            $("#calendar").append(week_clone);
    }
}

function make_date(day)
{
    if(day < 10)
    {
        day = "0"+day;
    }
    return day;
}


function make_clone(attr, datas, clone)
{
    var temp = [];

    for(var k = 0; k < attr.length; k++)
    {
        temp.push(attr.eq(k).attr("data-attr"));
    }
    

    // for(var x =0; x < value.length; x++)
    // {
    //     exam_temp = value[x].exam_date.split(" ");
    //     if(exam_temp[0] == view_date)
    //     {
    //         console.log(value[x].exam_date);
    //     }
    // }
    return clone;
}