<?php 
$pageRole=[0,1];
$workerInfo = isset($_SESSION['workerInfo']) ? $_SESSION['workerInfo'] : null;
if(null==$workerInfo||in_array($workerInfo->role,$pageRole)){

?>
<br>
<div class="row queryOrUpdate">
        <div class="input-group mb-3">
            <input type="text" value="10000" id="text-searchByOrderNum" class="form-control" placeholder="请输入订单号" aria-label="请输入订单号" aria-describedby="btn-searchByOrderNum">
            <button class="btn btn-primary" type="button" id="btn-searchByOrderNum">查询</button>
        </div>
    </div>
    <table class="table">
        <thead>
          <tr class="table-primary">
            <th scope="col" width="40px">#</th>
            <th scope="col">订单号</th>
            <th scope="col" width="100px">密码</th>
            <th scope="col">订单状态</th>
            <th scope="col" width="60px">加急</th>
            <th scope="col" width="100px">客服</th>
            <th scope="col" width="100px">工程师</th>
            <th scope="col">创建时间</th>
            <th scope="col">修改时间</th>
            <!-- <th scope="col">修改</th> -->
          </tr>
        </thead>
        <tbody id="orderInfoList">
        </tbody>
    </table>
<!-- 引入jQuery等必要的前端资源 -->
<script src="/static/jquery-3.6.4.js"></script>
<script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
<link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
    <script>
      $(document).ready(function(){
    });
    $("#btn-searchByOrderNum").click(function(){
        // alert("ok")
        hideCollapse()
        queryByOrderNum()
    })
    function queryByOrderNum(){
        
        orderNum = $("#text-searchByOrderNum").val()
        // alert("aa"+orderNum)
        $.post("/opreate/index.php/getOrder?type=byOrderNum",{
            "reqType":"queryByOrder",
            "reqData":{"orderNum":orderNum}
        },
        function(responData){
            if(null===responData){
            }else if("OK"===responData.statusCode){
                $("#orderInfoList>tr").remove()
                // alert(responData.dataBody.length)
                // ol1 = responData.data
                var html = "";
                $.each(responData.dataBody, function(index, item) {
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
                    // html += "<td><button type='button' class='btn btn-primary get-pwd-btn' data-id='" + item.id + "'>取密</button></td>";
                    html += "</tr>";
                });
                $("#orderInfoList").append(html)
                // // tableRowGene(lenth(ol1))
                // $("#update-orderNum").val(ol1.orderNum)
                // $("#update-orderStatus").val(ol1.orderStatus);
                // $("#update-CSSid").val(ol1.CSSid)
                // $("#update-TSEid").val(ol1.TSEid)
                // $("#updata-urgent2").removeAttr("checked");
                // $("#updata-urgent1").removeAttr("checked");
                // if(1==ol1.urgent){
                //   $("#updata-urgent2").attr("checked","")
                // }else if(0==ol1.urgent){
                //   $("#updata-urgent1").attr("checked","")
                // }
            }else{
              alert("未查到");
            }
        },"JSON")
        
    }

    function hideCollapse(){
      $("#orderUpdateCollapse").removeClass("show")
    }
    //引入状态文本
    <?php include_once("status.htm");  ?>
    
    
    // 获取加急文本
    function getUrgentText(urgent) {
        return urgent == 1 ? "是" : "否";
    }
    </script>
<?php  }else{
    echo "无权访问";
  } ?>