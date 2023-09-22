<?php
include "connect.php";
$imei = $_GET["imei"];
$sql = "SELECT model, activeTime, warranty FROM warranty WHERE imei='$imei'";
$result = mysqli_query($con, $sql);
if(isset($_GET['reqType'])){
    // echo "5";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data = array(
            "model" => $row["model"],
            "activeTime" => $row["activeTime"],
            "warranty" => $row["warranty"]
        );
        echo json_encode($data);
    } else {
        $error = array("message" => "0");
        echo json_encode($error);
    }
}else{
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "手机型号：" . $row["model"] . "<br>";
        echo "激活时间: " . $row["activeTime"] . "<br>";
        echo "保修时长: " . $row["warranty"] . " 天<br>";
        echo "销售区域: 中华人民共和国(CN)";
    } else {
        echo "No matching record found.";
    }
}

// 关闭连接
mysqli_close($con);
?>
