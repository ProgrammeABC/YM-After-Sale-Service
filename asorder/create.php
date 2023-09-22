<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>创建售后单</title>

</head>
<body>
  <?php include("../static/part/nav.htm");?>
    <div class="container body-container">
        <div style="height:50px;width:100%;"></div>
    <h1 style="text-align:center;">创建售后服务单</h1>
    <hr>
    <form id="orderForm">
      <div class="form-group">
        <label for="orderNum">用户QQ</label>
        <input type="text" class="form-control" id="orderNum" name="orderNum" required>
      </div>
      <hr>
      <div class="form-group">
        <label for="queryPwd">查询密码</label>
        <div class="input-group">
          <input type="text" class="form-control" id="queryPwd" name="queryPwd" required>
          <button type="button" class="btn btn-outline-secondary" onclick="generateRandomString();">生成密码</button>
          <button type="button" class="btn btn-outline-secondary" onclick="copyToClipboard();">复制</button>
        </div>
      </div>
      <hr>
      <div class="form-group">
        <label for="imei">设备IMEI1</label>
        <input type="text" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" id="imei" name="imei" required>
        <span id="imei-check" name="imei-check">💠auto-check</span>
      </div>
      <hr>
      <!-- <div class="form-group">
        <label for="urgent">是否加急</label>
        <select class="form-control" id="urgent" name="urgent">
          <option value="0">否</option>
          <option value="1">是</option>
        </select>
      </div>
      <hr> -->
      <p style="text-align:center;"><button type="submit" class="btn btn-primary" id="commit" disabled>提交订单</button></p>
      
    </form>
    </div>
    <?php include("../static/part/foot.htm");?>
    <script src="/static/jquery-3.6.4.js"></script>
    <script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
    <link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // 生成6位随机字符串
        function generateRandomString() {
            var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var result = '';
            for (var i = 0; i < 6; i++) {
                result += chars[Math.floor(Math.random() * chars.length)];
            }
            document.getElementById("queryPwd").value = result;
            copyToClipboard()
        }
    
        // 复制文本框内容到剪贴板
        function copyToClipboard() {
            var queryPwd = document.getElementById("queryPwd");
            queryPwd.select();
            document.execCommand("copy");
            alert("已复制查询密码：" + queryPwd.value + " 到剪贴板，请妥善保管！");
        }
    
    
        $(document).ready(function() {
          // $("#commit").attr("disabled","disabled")
            $("#orderForm").submit(function(event) {
                event.preventDefault();
                
                var orderNum = $("#orderNum").val();
                var queryPwd = $("#queryPwd").val();
                var urgent = 0;
                var imei = $("#imei").val();
                
                $.post("/opreate/index.php/createOrderDo", {orderNum: orderNum, queryPwd: queryPwd, urgent: urgent,imei: imei}, function(data) {
                    if (data.status == 1) {
                        alert("订单提交成功！");
                        window.location.href = "/asorder/login.php";
                    } else {
                        alert("订单提交失败，请重试！");
                    }
                }, "json");
            });
            $("#imei").on('input',function(){
              getDeviceInfo($("#imei").val())
            })
        });
        function getDeviceInfo(imei){
        $.get("/server/warranty.php", {imei: imei,reqType:"api"}, function(data) {
          data = JSON.parse(data);  
            if (data["message"] != "0") {
                // 显示结果
                
                // $("#deviceInfo").html(data["model"]+"(IMEI:"+imei+")");
                // console.log("1"+data["model"]+"(IMEI:"+imei+")")
                $("#imei-check").html("💫请核对机型是否为："+data["model"])
                $("#commit").removeAttr("disabled","disabled")
            } else {
                $("#imei-check").html("❌不存在的IMEI")
                $("#commit").attr("disabled","disabled")
            }
        });
    }
    </script>
</body>
</html>