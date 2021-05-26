<?php 
include_once '../common.php';

$date = $_POST["date"];

$function = $_POST["function"];

if($function == "now_month")
{
    now_month();
}
else if($function == "prev_month")
{
    prev_month();
}
else if($function == "next_month")
{
    next_month();
}
else if($function == "insert")
{
    insert();
}

function now_month()
{
    $date = $_POST["date"];

    $post_year  = date("Y", strtotime($date));
    $post_month = date("m", strtotime($date));
    $make = mktime(0,0,0, $post_month, 1, $post_year);
    
    $now_month = strtotime("+0 month",$make);
    
    $year = date("Y", $now_month);
    $month = date("m", $now_month);
    $last_day = date("t", $now_month);

    $week = week($now_month);
    
    $sql = "select * from schedulers where 
    DATE(exam_date) BETWEEN  '$year-$month-01' and '$year-$month-$last_day' ORDER BY exam_date asc";
    
    $res= sql_query($sql);
    
    for($i= 0;$row = sql_fetch_array($res);$i++ )
    {
        foreach ($row as $key => $value)
        {
            $result["value"][$i][$key] = $value;
        }
    }
    
    $result["year"] = $year;
    $result["month"] = $month;
    $result["week"] = $week;
    $result["last_day"] = $last_day;
    
    echo json_encode($result);
}

function week($date)
{
    //$date = date("Y-m", ($date));

    $day = date("Y-m", $date);
    $date_fd = date("Y-m-01", $date);
    $fd_week = date("W", strtotime($date_fd));
    $fd = date("w", strtotime($date_fd));
    
    $date_ld = date("Y-m-t", $date);
    $ld_week = date("W", strtotime($date_ld));
    $ld = date("w", strtotime($date_ld));

    $week_count = $ld_week - $fd_week + 1;

    $week["week"] = $week_count;
    $week["fd_week"] = $fd;
    $week["ld_week"] = $ld;

    return $week;
}

function prev_month()
{
    $date = $_POST["date"];

    $post_year  = date("Y", strtotime($date));
    $post_month = date("m", strtotime($date));
    $make = mktime(0,0,0, $post_month, 1, $post_year);
    
    $prev_month = strtotime("-1 month",$make);
    
    $year = date("Y", $prev_month);
    $month = date("m", $prev_month);
    $last_day = date("t", $prev_month);

    $week = week($prev_month);
    
    $sql = "select * from schedulers where 
    DATE(exam_date) BETWEEN  '$year-$month-01' and '$year-$month-$last_day' ORDER BY exam_date asc";
    
    $res= sql_query($sql);
    
    for($i= 0;$row = sql_fetch_array($res);$i++ )
    {
        foreach ($row as $key => $value)
        {
            $result["value"][$i][$key] = $value;
        }
    }
    
    $result["year"] = $year;
    $result["month"] = $month;
    $result["week"] = $week;
    $result["last_day"] = $last_day;
    
    echo json_encode($result);
}

function next_month()
{
    $date = $_POST["date"];

    $post_year  = date("Y", strtotime($date));
    $post_month = date("m", strtotime($date));
    $make = mktime(0,0,0, $post_month, 1, $post_year);
    
    $next_month = strtotime("+1 month",$make);
    
    $year = date("Y", $next_month);
    $month = date("m", $next_month);
    $last_day = date("t", $next_month);

    
    $week = week($next_month);
    
    $sql = "select * from schedulers where 
    DATE(exam_date) BETWEEN  '$year-$month-01' and '$year-$month-$last_day' ORDER BY exam_date asc";
    
    $res= sql_query($sql);
    
    for($i= 0;$row = sql_fetch_array($res);$i++ )
    {
        foreach ($row as $key => $value)
        {
            $result["value"][$i][$key] = $value;
        }
    }
    
    $result["year"] = $year;
    $result["month"] = $month;
    $result["week"] = $week;
    $result["last_day"] = $last_day;
    
    echo json_encode($result);
}

function insert()
{
    $data = $_POST["data"];

    $result["data"] = $data;

    $sql = "select * from schedulers where exam_date like '".$data["date"]."%'";
    $res = sql_query($sql);
    $row = sql_num_rows($res);

    if($row != 0)
    {
        for($i = 0; $rows = sql_fetch_array($res); $i++)
        {
            $result["value"][$i] = $rows;
        }
    }
    else
    {
        $title = $data["title"];
        $exam_date = $data["date"]." ".$data["time"];
        $sql = "insert into schedulers(title, apply_date, exam_date) value ('$title', now(), '$exam_date')";
        $result["sql"] = $sql;
        $res = sql_query($sql);
        if($res)
        {
            $result["result"] = 1;
            $result["message"] = "신청성공";
        }
        else
        {
            $result["message"] = "오류";
        }
    }
    

    echo json_encode($result);
}


?>