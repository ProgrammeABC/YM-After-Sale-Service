<?php session_start(); 
    $workerInfo = isset($_SESSION['workerInfo']) ? $_SESSION['workerInfo'] : null;
    if(null==$workerInfo){
        echo '<script>alert("未登录！");location.href=\'/employee/\'</script>';
    }
?>
<!DOCTYPE html>
<html>
  <head>    
    <meta charset="utf-8">
    <title>玉米手机售后服务系统</title>
    <!-- 加载Bootstrap样式表 -->
    <link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .container{
            padding-top:5px;
        }
        .col-10{
            padding-top:55px;
        }
        .col-2{
            height:100%;
            /* margin-left:200px; */
            padding-top:100px;
        }
        .leftbar{
            width:100px;
        }
        #topbar{
            position: fixed;
            top:0;
            width:100%;
            /* float:flex; */
        }
    </style>  
</head>
  <body>
  <nav id="topbar" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-size: 16px;">
                <img class="rounded" src="/static/img/yumi.png" alt="Logo" width="36" height="36" class="d-inline-block align-text-top">
                玉米手机售后服务系统
            </a>
        <a class="nav-link" id="logout" href="#">退出</a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <ul class="nav nav-pills flex-column flex-sm-row leftbar">
 <?php
    if(1==$workerInfo->role||0==$workerInfo->role){
        ?>
        <li class="nav-item">
            <a id="latest" class="nav-link" href="order?n=latest">最新订单</a>
        </li>
        <li class="nav-item">
            <a id="waitEnd" class="nav-link" href="order?n=waitEnd">待结订单</a>
        </li>
        <li class="nav-item">
            <a id="search" class="nav-link" href="order?n=search">查询订单</a>
        </li>
        <li class="nav-item">
            <a id="create" class="nav-link" href="order?n=create">创建订单</a>
        </li>


        <?php
    }
    if(2==$workerInfo->role){
        ?>
        <li class="nav-item">
        <a id="create" class="nav-link" href="order?n=create">创建订单</a>
        </li>
        <?php
    }
    if(2==$workerInfo->role||0==$workerInfo->role){
        ?>
        <li class="nav-item">
            <a id="processing" class="nav-link" href="order?n=processing">处理订单</a>
        </li>
        <?php
    }
    if(0==$workerInfo->role){
        ?>
        <li class="nav-item">
            <a id="m0" class="nav-link" href="manage?n=m0">员工管理</a>
        </li>
        <?php
    }

 ?>
                </ul>
            </div>
            <div class="col-10 vh-100">
                <?php  require_once 'server/router.php';?>
            </div>
        </div>
    </div>

    <!-- 加载jQuery和Bootstrap JavaScript文件 -->
    <script src="/static/jquery-3.6.4.js"></script>
    <script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
    <script>
        function getQueryVariable(variable)
        {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                var pair = vars[i].split("=");
                if(pair[0] == variable){return pair[1];}
            }
            return(false);
        }
        $(document).ready(function(){
            $(".leftbar>li").find("a").removeClass("active");
            // alert(getQueryVariable("n"));
            $("#"+getQueryVariable("n")).addClass("active")
            // if("pg1"===getQueryVariable(n))
        })
        $("#logout").click(function(){
            $.post("/opreate/index.php/logout",{"reqType":"logout"});
            alert("退出成功！");
            location.href="/employee/";
        })
        // $(".leftbar>li").click(function(){
        //     $(".leftbar>li").find("a").removeClass("active")
        //     $("#"+$(this).children("a").attr("id")).addClass("active")
        // })
    </script>
  </body>
</html>




