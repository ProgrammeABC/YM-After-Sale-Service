<!doctype html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>服务单服务与管理系统</title>
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
          服务单服务与管理系统
        </h4>
      </div>
      <br>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <!-- <form name="loginForm"> -->
              <div class="row mb-4">
                <label for="username" class="col-sm-3 col-form-label">账号</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="username">
                </div>
              </div>
              <div class="row mb-4">
                <label for="password" class="col-sm-3 col-form-label">密码</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" id="password">
                </div>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="userTypeRadioOptions" id="userType-CSS" value="1" checked>
                <label class="form-check-label" for="userType-CSS">客服代表</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="userTypeRadioOptions" id="userType-TSE" value="2">
                <label class="form-check-label" for="userType-TSE">工程师</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="userTypeRadioOptions" id="userType-Admin" value="0">
                <label class="form-check-label" for="userType-Admin">管理员</label>
              </div>
                <h1>
                    <a type="button" class="btn btn-primary" id="login-btn">登录系统</a>
                </h1>
            <!-- </form> -->
        </div>
    </div>
    </div>
    <?php include("../static/part/foot.htm");?>
    <script src="/static/jquery-3.6.4.js"></script>
    <script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        
      });
      $("#login-btn").click(function(){
        if($("#password").val()===""){
          alert("请输入密码！");
        }else{
          username = $("#username").val()
          pwd = CryptoJS.SHA256($("#password").val()).toString()
          userType = $('input:radio:checked').val()
          // alert(userType)
          jQuery.ajax({ 
            url: "/opreate/index.php/login", 
            type:"post",
            dataType: "json", 
            data:{
              "reqType":"login",
              "reqData":{
                "username":username,
                "password":pwd,
                "userType":userType,
              },
            },
            success: function(results) { 
              // alert("1");
              if(results.statusCode==="usernotfound"){
                alert("账号和密码不匹配或角色有误！")
              }else if(results.username===username){
                alert("欢迎！")
                location.href="/employee.php/";
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