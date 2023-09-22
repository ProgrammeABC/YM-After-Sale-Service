<?php
//用户服务端
    main();
    // 入口

    function main(){
        if(empty($_POST['reqType'])){
            echo "{\"statusCode\":\"EMPTY_REQ\"}";
        }else if("getData"==$_POST['reqType']){
            getData();
        }else if("logout"==$_POST['reqType']){
            logout();
        }else if("updateUrgent"==$_POST['reqType']){
            updateUrgent();
        }else if("login"==$_POST['reqType']){
            login();
        }
    }
    function getData(){
        session_start();
        if(!empty($_SESSION['userInfo'])){
            $userInfo_0 = $_SESSION['userInfo'];
            $qq = "";
            $uid = 0;
            $uid = $userInfo_0->id;
            $qq = $userInfo_0->orderNum;
            include 'connect.php';
            // echo $uid.$qq;
            $sql="select * from user where orderNum=".$qq." and id=".$uid;
            // echo $sql;
            $result = $con->query($sql);
            if($result->num_rows > 0){
                // echo "1";
                $userInfo =['id'=> -1,'createTime'=>'','orderNum'=>'','orderStatus'=>-1,'urgent'=>0,'changeTime'=>''];
                while($row = mysqli_fetch_object($result)){
                    $userInfo = $row;
                    session_start();
                    //开启session
                    $userInfo->queryPwd="";
                    // 去除敏感信息——密码
                    $_SESSION["userInfo"] = $userInfo;
                    //存入session
                    mysqli_close($con);
                    //关闭链接
                    echo json_encode(["statusCode"=>"OK","dataBody"=>$userInfo]);
                }
            }else{
                echo "{\"statusCode\":\"usernotfound\"}";
            }
        }else{
            echo "{\"statusCode\":\"usernotfound\"}";
        }
    }
    function logout(){
        session_start();
        unset($_SESSION['userInfo']);
        // session_destroy();
    }
    function updateUrgent(){
        session_start();
        if(!empty($_SESSION['userInfo'])){
            $userInfo_0 = $_SESSION['userInfo'];
            $qq = "1327677268";
            $qq = $userInfo_0->orderNum;
            include 'connect.php';
            $sql="UPDATE user SET urgent = 1 WHERE orderNum = ".$qq;
            mysqli_query($con,$sql);
            mysqli_close($con);
        }else{
            echo "{\"statusCode\":\"usernotfound\"}";
        }
    }
    function login(){
        $qq = $_POST["reqData"]["qq"];
        $pwd = $_POST["reqData"]["pwd"];
        // echo $qq;
        // 获取前端传输的订单号和查询密码
        include 'connect.php';
        // 引入数据库链接
        $sql="select * from user where orderNum='$qq' and queryPwd='$pwd'";
        $result = $con->query($sql);
        if($result->num_rows > 0){
            $userInfo = array('id'=> -1,'createTime'=>'','orderNum'=>'','orderStatus'=>-1,'urgent'=>0,'changeTime'=>'');
            while($row = mysqli_fetch_object($result)){
                $userInfo = $row;

                session_start();
                //开启session
                $userInfo->queryPwd="";
                $_SESSION["userInfo"] = $userInfo;
                //存入session
                // echo json_encode($userinfo);
                echo "{\"orderNum\":\"$userInfo->orderNum\"}";
            }
        }else{
            echo "{\"statusCode\":\"usernotfound\"}";
        }
    }
?>