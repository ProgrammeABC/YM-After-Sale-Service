<?php session_start();  ?>
<style type="text/css">
    .container{
        text-align: center;
    }
    body {
      padding: 20px;
    }
    table {
      margin-top: 20px;
      border-collapse: collapse;
      color: #333;
    }
    th, td {
      padding: 10px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f8f9fa;
      font-weight: bold;
    }
</style>
<div class="container">
    <h1>欢迎使用售后服务工单管理系统</h1>
    <hr>
<?php 
    $workerInfo = isset($_SESSION['workerInfo']) ? $_SESSION['workerInfo'] : null;
    $wstr="";
    if(null!==$workerInfo){
        if(0==$workerInfo->role){
            $wstr.="管理员";
        }else if(1==$workerInfo->role){
            $wstr.="客服代表";
        }else if(2==$workerInfo->role){
            $wstr.="工程师";
        }
        $wstr.=(" ".$workerInfo->name."，您好！"); 
        echo '<h5 style="text-align:right;">'.$wstr.'</h5>';
    }
?>
<hr>
  <table class="table table-hover">
    <thead>
      <tr>
        <th colspan="2">系统信息</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>PHP版本</td>
        <td><?php echo phpversion(); ?></td>
      </tr>
      <tr>
        <td>MySQL版本</td>
        <td>
          <?php
            $conn = new mysqli('localhost', 'asdata', '113825');
            echo $conn->server_info;
            $conn->close();
          ?>
        </td>
      </tr>
      <tr>
        <td>当前域名</td>
        <td><?php echo $_SERVER['HTTP_HOST']; ?></td>
      </tr>
      <tr>
        <td>CPU信息</td>
        <td><?php echo get_cpu_count(); ?></td>
      </tr>
      <tr>
        <td>系统版本</td>
        <td><?php echo php_uname(); ?></td>
      </tr>
      <tr>
        <td>本机IP</td>
        <td><?php echo $_SERVER['REMOTE_ADDR']; ?></td>
      </tr>
      <tr>
        <td>远端IP</td>
        <td><?php echo $_SERVER['SERVER_ADDR']; ?></td>
      </tr>
      <tr>
        <td>远端时间</td>
        <td id="serverTime"></td>
      </tr>
      <tr>
        <td>本机时间</td>
        <td id="localTime"></td>
      </tr>
    </tbody>
  </table>

  <?php
    function get_cpu_count() {
        return $_SERVER['PROCESSOR_IDENTIFIER'];
    }
  ?>
</div>
<!-- 引入jQuery等必要的前端资源 -->
<script src="/static/jquery-3.6.4.js"></script>
<script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
<link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
<script>
    var timeDiff = 0;
    $(document).ready(function (){
        serverTime =new Date(<?php echo time(); ?> * 1000) ;
        var localTime = new Date();
        timeDiff = serverTime.getTime() - localTime.getTime();
        setInterval(updateTime, 1000);
    })
    function updateTime(){
        // var localTime = Date.now();
        // var nowServer = ;
        $("#serverTime").html(new Date(Date.now()+timeDiff))
        $("#localTime").html(new Date(Date.now()))
        // $("#serverTime").html()
    }
</script>