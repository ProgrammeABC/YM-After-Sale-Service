<?php
//数据库连接
$dbhost="127.0.0.1";
$dbuser="asdata";
$dbpwd="113825";
$dbname="asdata";
$con=mysqli_connect($dbhost,$dbuser,$dbpwd,$dbname);
// 检查连接
if (!$con)
{
    echo "db-error";
    // die("连接错误: " . mysqli_connect_error());
}else{
    // echo "ok";
}
?>