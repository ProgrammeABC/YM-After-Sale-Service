$("#logout").click(function(){
    $.post("/server/user.php",{"reqType":"logout"});
    alert("退出成功！");
    location.href="/";
})
$("#refreshStatus").click(function(){
    location.href="/user.html";
})
$(document).ready(function(){
    $.post("/server/user.php",{reqType:"getData"},function(responData){
      if("usernotfound"==responData.statusCode){
        alert("登录态异常！")  
        location.href="/asorder/login.php";
      }
      data=responData.dataBody  
      orderq = data.orderNum;
        if(!orderq){
          alert("查询失败！")
          // location.href="/";
        }else{
          $("#qqimg").attr("src","http://q1.qlogo.cn/g?b=qq&nk="+orderq+"&s=100")
          $("#outputqq").val(orderq)
          $("#qqnum").append("("+orderq+")")
          var qqname = null;
          jQuery.ajax({ 
          url: "https://api.usuuu.com/qq/"+orderq, 
          dataType: "json", 
          success: function(results) { 
              $("#qqname").append(results.data.name+"，欢迎您！")
          }});
          var status = ["状态异常",0];
          
          switch(data.orderStatus){
              case "0":status=["已提交售后申请，排单中...",1];break;
              case "1":status=["工程师正在检测问题",20];break;
              case "2":status=["工程师将与您电联，请注意接听电话",50];break;
              case "3":status=["正在维修您的设备",60];break;
              case "4":status=["维修完毕，等待客户收货",80];break;
              case "5":status=["客户验收完毕",90];break;
              case "6":status=["售后单完成",100];break;
              case "7":status=["售后单取消",0];break;
              default:status=["状态异常",0];break;
          }
          $("#status").html(status[0])
          // alert(status[1])
          $("#statusBar").css("width",status[1]+"%");
          $("#statusBar").html(status[1]+"%");
          $("#changeTime").html(data.changeTime)
          if(data.urgent=="1"){
              $("#urgent").html("✅已加急")
              $("#btn-urgent").addClass("disabled")
              $("#btn-urgent").attr("aria-disabled","true")
          }
          $("#CSSid").html(data.CSSid)
          $("#TSEid").html(data.TSEid)
          $("#createTime").html(data.createTime)
          getDeviceInfo(data.imei);
        }

    },"json");
    $(document).ajaxError(function(){
        alert("数据获取失败！")
    })
});
$("#btn-urgent").click(function(){
    $.post("/server/user.php",{"reqType":"updateUrgent"})
    location.href="/asorder/user.html";
    alert("已加急催促！请耐心等待！")
})
function getDeviceInfo(imei){
    $.get("/server/warranty.php", {imei: imei,reqType:"api"}, function(data) {
        if (data.message != "0") {
            // 显示结果
            data = JSON.parse(data);
            $("#deviceInfo").html(data["model"]+"(IMEI:"+imei+")");
        } else {
            // 显示错误信息
            $("#result").html("<p class='error'>此IMEI不存在！</p>");
        }
    });
}