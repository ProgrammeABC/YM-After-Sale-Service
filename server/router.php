<?php

// 导入控制器文件
require_once 'controllers/UserController.php';
require_once 'controllers/EmployeeController.php';


// 路由配置
$url = $_SERVER['REQUEST_URI'];
//User
if ($url == '/opreate/index.php/getLatestOrderDo') {
    (new UserController)->getLatestOrderDo();
}else if ($url == '/opreate/index.php/updateOrderStatus?role=CSS') {
    (new UserController)->updateOrderStatus("css");
}else if ($url == '/opreate/index.php/updatePwd') {
    (new UserController)->updatePwd();
}else if($url == '/opreate/index.php/createOrderDo'){
    (new UserController)->createOrderDo();
}else if($url == '/opreate/index.php/getOrder?type=finish'){
    (new UserController)->getOrder("finish");
}else if($url == '/opreate/index.php/getOrder?type=processing'){
    (new UserController)->getOrder("processing");
}else if($url == '/opreate/index.php/getOrder?type=byOrderNum'){
    (new UserController)->getOrder("byOrderNum");
}
else if($url == '/opreate/index.php/updateOrderStatus?role=TSE'){
    (new UserController)->updateOrderStatus("tse");
}else if($url == '/employee.php/order?n=latest'){
    require_once 'server/views/latest-order.php';
}else if($url == '/employee.php/order?n=search'){
    require_once 'server/views/search-order.php';
}else if($url == '/employee.php/order?n=create'){
    require_once 'server/views/create-order.php';
}else if($url == '/employee.php/order?n=waitEnd'){
    require_once 'server/views/finish-order.php';
}else if($url == '/employee.php/order?n=processing'){
    require_once 'server/views/processing-order.php';
}else if($url == '/employee.php/'){
    require_once 'server/views/welcome.php';
}else if($url == '/employee.php'){
    echo "<a href=\"/employee.php/\">请求有误，请点此进入系统</a>";
}
//Employee
if($url == '/opreate/index.php/logout'){
    (new EmployeeController)->logout();
}
else if ($url == '/opreate/index.php/login') {
    (new EmployeeController)->login();
}
else if ($url == '/opreate/index.php/getEmployees') {
    (new EmployeeController)->getEmployees();
}
else if ($url == '/opreate/index.php/getEmployeeByID') {
    (new EmployeeController)->getEmployeeByID();
}
else if ($url == '/opreate/index.php/deleteEmployee') {
    (new EmployeeController)->deleteEmployee();
}
else if ($url == '/opreate/index.php/createEmployee') {
    (new EmployeeController)->createEmployee();
}
else if ($url == '/opreate/index.php/editEmployee') {
    (new EmployeeController)->editEmployee();
}
// else if ($url == '/opreate/index.php/updatePwd') {
//     (new UserController)->updatePwd();
// }else if($url == '/opreate/index.php/createOrderDo'){
//     (new UserController)->createOrderDo();
// }else if($url == '/opreate/index.php/getOrder?type=finish'){
//     (new UserController)->getOrder("finish");
// }else if($url == '/opreate/index.php/getOrder?type=processing'){
//     (new UserController)->getOrder("processing");
// }else if($url == '/opreate/index.php/updateOrderStatus?role=TSE'){
//     (new UserController)->updateOrderStatus("tse");
// }else if($url == '/employee.php/login'){
//     require_once '../employee/login.html';
// }else if($url == '/employee.php/order?n=search'){
//     require_once 'server/views/search-order.php';
// }else if($url == '/employee.php/order?n=create'){
//     require_once 'server/views/create-order.php';
// }else if($url == '/employee.php/order?n=waitEnd'){
//     require_once 'server/views/finish-order.php';
// }
else if($url == '/employee.php/manage?n=m0'){
    require_once 'server/views/manage-employee.php';
}
?>
