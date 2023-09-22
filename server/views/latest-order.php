<?php 
$pageRole=[0,1];
$workerInfo = isset($_SESSION['workerInfo']) ? $_SESSION['workerInfo'] : null;
if(null==$workerInfo||in_array($workerInfo->role,$pageRole)){

?><!-- 用户数据表格 -->
<div id="userTable"></div>

<!-- 分页 -->
<nav aria-label="Page navigation" class="w-100" style="position: fixed;bottom:0;">
<ul class="pagination" id="pagination" style="text-align:center;"></ul>
  
</nav>

<!-- 引入jQuery等必要的前端资源 -->
<script src="/static/jquery-3.6.4.js"></script>
<script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/crypto-js-4.1.1/crypto-js.js"></script>
<link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">

<script>
$(document).ready(function() {
    var currentPage = 1;
    var pageSize = 10;
    var totalPages = 0;
    
    // 获取用户数据
    getUserData(currentPage, pageSize);
    
    // 完成订单按钮点击事件
    $("#userTable").on("click", ".complete-btn", function() {
        var id = $(this).data("id");
        
        $.post("/server/updateOrderStatus.php", {id: id}, function(data) {
            if (data.status == 1) {
                alert("订单已完成！");
                getUserData(currentPage, pageSize);
            } else {
                alert("操作失败，请重试！");
            }
        }, "json");
    });
    
    // 分页按钮点击事件
    $("#pagination").on("click", ".page-link", function() {
        currentPage = $(this).data("page");
        getUserData(currentPage, pageSize);
    });
    
    // 获取用户数据
    function getUserData(page, size) {
        
        $.post("/opreate/index.php/getLatestOrderDo", {page: page, size: size}, function(data) {
            if (data.status == 1) {
                var html = "";
                $.each(data.data.list, function(index, item) {
                    html += "<tr>";
                    html += "<td>" + (index + 1) + "</td>";
                    html += "<td>" + item.orderNum + "</td>";
                    html += "<td>******</td>";
                    html += "<td>" + getOrderStatusText(item.orderStatus) + "</td>";
                    html += "<td>" + getUrgentText(item.urgent) + "</td>";
                    html += "<td>" + item.CSSid + "</td>";
                    html += "<td>" + item.TSEid + "</td>";
                    html += "<td>" + item.createTime + "</td>";
                    html += "<td>" + item.changeTime + "</td>";
                    html += "<td><button type='button' class='btn btn-primary get-pwd-btn' data-id='" + item.id + "'>取密</button></td>";
                    html += "</tr>";
                });
                
                $("#userTable").html("<table class='table'><thead><tr><th>#</th><th>编号</th><th>查询密码</th><th>状态</th><th>加急</th><th>客服id</th><th>工程师id</th><th>创建时间</th><th>变动时间</th><th>操作</th></tr></thead><tbody>" + html + "</tbody></table>");
                
                totalPages = Math.ceil(data.data.total / pageSize);
                var paginationHtml = "";
                for (var i = 1; i <= totalPages; i++) {
                    paginationHtml += "<li class='page-item" + (i == currentPage ? " active" : "") + "'><a class='page-link' href='javascript:;' data-page='" + i + "'>" + i + "</a></li>";
                }
                $("#pagination").html(paginationHtml);
            } else {
                alert("获取用户数据失败，请重试！");
            }
        }, "json");
    }
    
    //引入状态文本
    <?php include_once("status.htm");  ?>
    // 处理“获取密码”按钮点击事件
    // $("#userTable").on("click", ".complete-btn", function() {
    $('#userTable').on('click', '.get-pwd-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var pwd = generateRandomString();
            // var sha256Pwd = sha256(pwd);
            // alert(sha256Pwd);
            $.post('/opreate/index.php/updatePwd', {"id":id,"newPwd":sha256(pwd)}).done(function(data) {
            data = JSON.parse(data);
            if (data.code === 0) {
                copyToClipboard(pwd);
                alert('已将密码复制到剪贴板，原始密码为：' + pwd + '，SHA256值为：' + sha256(pwd));
            } else {
                alert('密码获取失败！');
            }
        });
    });
    function sha256(str) {
        return CryptoJS.SHA256(str).toString(CryptoJS.enc.Hex);
    }
    function generateRandomString() {
        var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var result = '';
        for (var i = 0; i < 6; i++) {
            result += chars[Math.floor(Math.random() * chars.length)];
        }
        return result;
        // document.getElementById("queryPwd").value = result;
    }
    
    // 获取加急文本
    function getUrgentText(urgent) {
        return urgent == 1 ? "是" : "否";
    }
    
});
    function copyToClipboard(text) {
    // 创建一个<textarea>元素
    var textarea = document.createElement('textarea');
    // 设置元素内容为需要复制的文本
    textarea.value = text;
    // 将元素添加到文档中
    document.body.appendChild(textarea);
    // 选中文本内容
    textarea.select();
    // 复制文本到剪切板
    document.execCommand('copy');
    // 移除元素
    document.body.removeChild(textarea);
    }


    </script>
<?php  }else{
    echo "无权访问";
  } ?>