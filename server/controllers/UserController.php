<?php

class UserController {
    
    public function getLatestOrderDo() {
        // 接收参数
        $page = isset($_POST["page"]) ? $_POST["page"] : 1;
        $size = isset($_POST["size"]) ? $_POST["size"] : 10;
        // 连接到数据库
        require_once('../server/connect.php');

        // 查询总记录数
        $sql = "SELECT COUNT(*) AS total FROM user";
        $result = $con->query($sql);
        $total = 0;
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $total = $row["total"];
        }
        }

        // 查询数据
        $offset = ($page - 1) * $size;
        $sql = "SELECT * FROM user ORDER BY createTime DESC LIMIT {$offset}, {$size}";
        $result = $con->query($sql);

        // 返回结果
        if ($result->num_rows > 0) {
        $list = array();
        while ($row = $result->fetch_assoc()) {
        unset($row['queryPwd']);
        $list[] = $row;
        
        }
        
        // array_replace("")
        echo json_encode(array("status" => 1, "data" => array("total" => $total, "list" => $list)));
        } else {
        echo json_encode(array("status" => 0));
        }

        $con->close();
        
    }
    public function getOrder($type) {
        require_once('../server/connect.php');
        session_start();
        if("finish"===$type){
            $eid = isset($_SESSION["workerInfo"]) ? $_SESSION["workerInfo"]->eid : "testkf01";
            // 接收参数
            $page = isset($_POST["page"]) ? $_POST["page"] : 1;
            $size = isset($_POST["size"]) ? $_POST["size"] : 10;
            // 连接到数据库
            

            // 查询总记录数

            $sql = "SELECT COUNT(*) AS total FROM user where orderStatus = 5 and CSSid like '{$eid}'";
            // echo $sql;
            if($_SESSION["workerInfo"]->role==0){
                $sql = "SELECT COUNT(*) AS total FROM user where orderStatus = 5";
            }
            $result = $con->query($sql);
            $total = 0;
            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $total = $row["total"];
            }
            }

            // 查询数据
            $offset = ($page - 1) * $size;
            $sql = "SELECT * FROM user where orderStatus = 5 and CSSid like '{$eid}' ORDER BY createTime DESC LIMIT {$offset}, {$size}";
            if($_SESSION["workerInfo"]->role==0){
                $sql = "SELECT * FROM user where orderStatus = 5 ORDER BY createTime DESC LIMIT {$offset}, {$size}";
            }
            $result = $con->query($sql);

            // 返回结果
            if ($result->num_rows > 0) {
            $list = array();
            while ($row = $result->fetch_assoc()) {
            unset($row['queryPwd']);
            $list[] = $row;
            
            }
            
            // array_replace("")
            echo json_encode(array("status" => 1, "data" => array("total" => $total, "list" => $list)));
            } else {
            echo json_encode(array("status" => 0));
            }
        }else if("processing"===$type){
            $eid = isset($_SESSION["workerInfo"]) ? $_SESSION["workerInfo"]->eid : "testgcs01";
            // 查询订单数据

            $sql = "SELECT id, createTime, orderNum, orderStatus, urgent FROM
                    (SELECT * FROM user WHERE TSEid = '{$eid}' AND orderStatus NOT IN (5,6,7)  
                    GROUP BY urgent,id)as a ORDER BY a.createTime ASC LIMIT 15";
                    // echo $sql;
            if($_SESSION["workerInfo"]->role==0){
                $sql = "SELECT id, createTime, orderNum, orderStatus, urgent FROM
                (SELECT * FROM user WHERE orderStatus NOT IN (5,6,7)  
                GROUP BY urgent,id)as a ORDER BY a.createTime ASC LIMIT 15";
                // echo $sql;
            }
            $result = $con->query($sql);
            $data = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            // 返回json数据
            header('Content-Type: application/json');
            echo json_encode($data);
        }else if("byOrderNum"===$type){
            if(!empty($_POST["reqData"])){
                $orderNum = $_POST["reqData"]["orderNum"];
                // echo $orderNum;
                // include 'connect.php';
                $sql="select * from user where orderNum=".$orderNum;
                $result = $con->query($sql);
                if($result->num_rows > 0){
                    // echo "1";
                    $userInfo =['id'=> -1,'createTime'=>'','orderNum'=>'','orderStatus'=>-1,'urgent'=>0,'changeTime'=>''];
                    $userList=array();
                    while($row = mysqli_fetch_object($result)){
                        $userInfo = $row;
                        session_start();
                        //开启session
                        $userInfo->queryPwd="";
                        // 去除敏感信息——密码
                        $_SESSION["userInfo"] = $userInfo;
                        //存入session
                        
                        //关闭链接
                        $userList[]=$userInfo;
                    }
                    echo json_encode(["statusCode"=>"OK","dataBody"=>$userList]);
                    // mysqli_close($con);
                }else{
                    echo "{\"statusCode\":\"usernotfound\"}";
                }
            }else{
                echo "{\"statusCode\":\"reqError\"}";
            }
        }


        $con->close();
        
    }
    
    public function updateOrderStatus($userRole) {
        // 数据库连接配置
        require_once('../server/connect.php');
        if("tse"===$userRole){
            // 设置字符集
            // $con->set_charset('utf8mb3');

            // 获取POST参数并更新订单状态
            if (isset($_POST['orderId']) && isset($_POST['newStatus'])) {
            $orderId = $_POST['orderId'];
            $newStatus = $_POST['newStatus'];

            $stmt = $con->prepare("UPDATE user SET orderStatus = ?, changeTime = CURRENT_TIMESTAMP WHERE id = ?");
            $stmt->bind_param('ii', $newStatus, $orderId);
            if ($stmt->execute()) {
                $result = array('success' => true);
            } else {
                $result = array('success' => false, 'message' => '更新订单状态失败：' . $conn->error);
            }
            $stmt->close();
            } else {
            $result = array('success' => false, 'message' => '参数不正确！');
            }

            // 返回json数据
            header('Content-Type: application/json');
            echo json_encode($result);
        }else if("css"===$userRole){
            // 接收参数
            $id = isset($_POST["id"]) ? $_POST["id"] : "";


            // 检查连接
            if ($con->connect_error) {
                die("连接失败: " . $con->connect_error);
            }

            // 更新数据
            $sql = "UPDATE user SET orderStatus=6 WHERE id={$id}";
            if ($con->query($sql) === TRUE) {
                echo json_encode(array("status" => 1));
            } else {
                echo json_encode(array("status" => 0));
            }
        }


        $con->close();
    }

    public function createOrderDo(){
        require_once('../server/connect.php');
        
        // 接收参数
        $orderNum = isset($_POST["orderNum"]) ? $_POST["orderNum"] : "";
        $queryPwd = isset($_POST["queryPwd"]) ? hash("sha256",$_POST["queryPwd"]) : "";
        $imei = isset($_POST["imei"]) ? $_POST["imei"] : null;
        $urgent = isset($_POST["urgent"]) ? $_POST["urgent"] : 0;
// echo $queryPwd;
        // 插入数据
        $sql = "INSERT INTO user (orderNum, queryPwd, urgent,createTime,imei) VALUES ('{$orderNum}', '{$queryPwd}', {$urgent}, sysdate(),{$imei})";
        // echo $sql;
        if ($con->query($sql) === TRUE) {
            echo json_encode(array("status" => 1));
        } else {
            echo json_encode(array("status" => 0));
        }

        $con->close();

    }
    public function searchOrderDo(){
        if(!empty($_POST["reqData"])){
            $orderNum = $_POST["reqData"]["orderNum"];
            // echo $orderNum;
            include 'connect.php';
            $sql="select * from user where orderNum=".$orderNum;
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
            echo "{\"statusCode\":\"reqError\"}";
        }
    }
    public function updatePwd(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        // echo $id;
        $newPwd = isset($_POST['newPwd']) ? strval($_POST['newPwd']) : "";
        // echo $_POST['newPwd'];
        include 'connect.php';
        // $sha256pwd = hash("sha256",newpwd)
        $sql = "UPDATE user SET queryPwd='$newPwd' WHERE id=$id";
        if ($con->query($sql) === TRUE) {
            // 返回新密码
            echo json_encode(array(
                'code' => 0,
                'msg' => '',
                'data' => $newPwd
            ));
        } else {
            echo json_encode(array(
                'code' => 1,
                'msg' => '修改密码失败！',
                'data' => ''
            ));
        }

        // 关闭数据库连接
        $con->close();
        }
    
}
