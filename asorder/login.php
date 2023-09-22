<!doctype html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>自助服务单进度查询系统</title>
    <link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="/crypto-js-4.1.1/crypto-js.js"></script>
    <link href="/static/css/login.css" rel="stylesheet">
  </head>
  <body>
  <?php include("../static/part/nav.htm");?>
    <div class="container body-container">
      <div class="row">
        <h4 class="title">
          <img class="rounded" src="/static/img/yumi.png" height="52px" width="52px">
          自助服务单进度查询系统
        </h4>
      </div>
      <br>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form name="loginForm" action="/server/login.php" method="post">
              <div class="row mb-4">
                <label for="outputqq" class="col-sm-3 col-form-label">QQ号</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="outputqq">
                </div>
              </div>
              <div class="row mb-4">
                <label for="password" class="col-sm-3 col-form-label">密码</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" id="password">
                </div>
              </div>
                <h1>
                    <a type="button" class="btn btn-primary" id="query-btn">查询服务单</a>
                </h1>
            </form>
        </div>
        <div class="col-3">
          <div class="order-info">
            <div class="row">
              用户信息>>
            </div>
            <br>
            <img id="qqimg" class="rounded" src="#" height="50px" width="50px">
            <div class="row">
              <span id="qqname"></span>
            </div>   
            <div class="row">
              <span id="qqnum"></span>
            </div>
          </div>
            <br>
        </div>
    </div>
    </div>
    <?php include("../static/part/foot.htm");?>
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
        orderq = getQueryVariable("order")  
        if(!orderq){
          $(".order-info").hide()
          // $("#outputqq").val("请使用正确的链接")
        }else{
          $("#qqimg").attr("src","http://q1.qlogo.cn/g?b=qq&nk="+orderq+"&s=100")
          $("#outputqq").val(orderq)
          $("#qqnum").append("QQ:"+orderq)
          var qqname = null;
          jQuery.ajax({ 
          url: "https://api.usuuu.com/qq/"+orderq, 
          dataType: "json", 
          success: function(results) { 
            $("#qqname").append(results.data.name)
          }});
        }
      });
      $("#query-btn").click(function(){
        if($("#password").val()===""){
          alert("请输入密码！");
        }else{
          qqnum = $("#outputqq").val()
          pwd = CryptoJS.SHA256($("#password").val()).toString()
          // alert(CryptoJS.SHA256('待加密字符串').toString())
          jQuery.ajax({ 
            url: "/server/user.php", 
            type:"post",
            dataType: "json", 
            data:{
              "reqType":"login",
              "reqData":{
                "qq":qqnum,
                "pwd":pwd
              },
            },
            success: function(results) { 
              // alert("1");
              if(results.statusCode==="usernotfound"){
                alert("链接或密码有误！")
              }else if(results.orderNum===qqnum){
                alert("欢迎！")
                location.href="user.html";
              }else{
                alert("未知错误！")
              }
              // $("#kfname").append(results.orderNum)
          }});
        }
        
      });
    </script>
  </body>
</html>