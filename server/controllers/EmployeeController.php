<?php

class EmployeeController{
    function getRole($roleVal){
        switch($roleVal){
            case 0:
                return "admin";
                break;
            case 1:
                return "css";
                break;
            case 2:
                return "tse";
                break;
            default:
                return "";
                break;
        }
    }
    function login(){
        if(!empty($_POST["reqData"])){
            $username = $_POST["reqData"]["username"];
            $password = $_POST["reqData"]["password"];
            $userType = $_POST["reqData"]["userType"];
            // echo $qq;
            // 获取前端传输的订单号和查询密码
            require_once '../server/connect.php';
            // 引入数据库链接
            if(empty($username)){
                echo "{\"statusCode\":\"reqError\"}";
            }else{
                // $role = getRole();
                $sql="select * from employee where eid='$username' and password='$password' and role=$userType";
                // $sql="select * from css where CSSid='$username' and password='$password' and role='$userType'";
                // echo $sql;
                $result = $con->query($sql);
                if(!empty($result->num_rows)){
                    $workerInfo = ["0"=>0];
                    while($row = mysqli_fetch_object($result)){
                        $workerInfo = $row;
                        session_start();
                        //开启session
                        $workerInfo->password="";
                        $_SESSION["workerInfo"] = $workerInfo;
                        //存入session
                        // echo json_encode($userinfo);
                        echo "{\"username\":\"$workerInfo->eid\"}";
                    }
                }else{
                    echo "{\"statusCode\":\"usernotfound\"}";
                }
            }
        } else{
            echo "{\"statusCode\":\"reqError\"}";
        }
        // echo "ok";
    }
    function logout(){
        session_start();
        unset($_SESSION['workerInfo']);
    }

    function getEmployees(){
        require_once '../server/connect.php';
        require_once 'EmployeeInfoController.php';
        $employeeInfoController = new EmployeeInfoController($con);

        $employees = $employeeInfoController->getEmployees();

        header('Content-Type: application/json');
        echo json_encode($employees);
    }
    function getEmployeeByID(){
        // 根据员工ID获取员工信息
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $db = new PDO('mysql:host=localhost;dbname=asdata;charset=utf8mb4', 'asdata', '113825');
            $stmt = $db->prepare("SELECT * FROM employee WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $employee = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($employee);
        }
    }
    function createEmployee(){
        require_once '../server/connect.php';
        require_once 'EmployeeInfoController.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $employeeInfoController = new EmployeeInfoController($con);
            $result = $employeeInfoController->createEmployee($_POST['eid'], $_POST['name'], $_POST['tel'], $_POST['qq'], $_POST['password'], $_POST['role']);
            if ($result) {
                echo 'success';
            } else {
                echo 'error';
            }
          }
    }
    function deleteEmployee(){
        require_once '../server/connect.php';
        require_once 'EmployeeInfoController.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employeeInfoController = new EmployeeInfoController($con);
            $result = $employeeInfoController->deleteEmployee($_POST['id']);
            if ($result) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }
    function editEmployee(){
        require_once '../server/connect.php';
        require_once 'EmployeeInfoController.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employeeInfoController = new EmployeeInfoController($con);
            if("******"!==$_POST['password']){
                // echo "1";
                // echo $_POST['password'];
                $result = $employeeInfoController->updateEmployeeAll($_POST['id'],$_POST['password'], $_POST['eid'], $_POST['name'], $_POST['tel'], $_POST['qq'], $_POST['role']);
            }else{
                // echo "2";
                $result = $employeeInfoController->updateEmployee($_POST['id'],$_POST['eid'], $_POST['name'], $_POST['tel'], $_POST['qq'], $_POST['role']);
            }
            if ($result) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }
}
?>