<?php 
$pageRole=[0,2];
$workerInfo = isset($_SESSION['workerInfo']) ? $_SESSION['workerInfo'] : null;
if(null==$workerInfo||in_array($workerInfo->role,$pageRole)){

?><div class="container">
    <h2 style="text-align:center;">工程师订单管理</h2>
    <table id="orderTable" class="table table-striped">
      <thead>
        <tr>
          <th>编号</th>
          <th>创建时间</th>
          <th>状态</th>
          <th>加急</th>
          <th>变更状态</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
<!-- 引入jQuery等必要的前端资源 -->
<link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
<script src="/static/jquery-3.6.4.js"></script>
<script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function(){
      // 获取数据并填充表格
      getOrders()

    //引入状态文本
    <?php include_once("status.htm");  ?>
          // 修改订单状态

    $("#orderTable").on("click",".btn-update",function (){
        var orderId = $(this).attr("id");
        // alert("ss"+orderId)
        var $statusSelect = $('#statusSelect-' + orderId);
        var newStatus = $statusSelect.val();
        $.post("/opreate/index.php/updateOrderStatus?role=TSE", {orderId: orderId, newStatus: newStatus}, function(data) {
            if (data.success == true) {
                alert("修改成功！");
                getOrders();
            } else {
                alert("操作失败，请重试！");
            }
        }, "json");
    })

    function getOrders() {
        $.ajax({
          url: '/opreate/index.php/getOrder?type=processing',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            var html = '';
            var i=0;
            $.each(data, function(index, order) {
              var statusOptions = '<select id="statusSelect-' + order.id + '">';
              for(i=0;i<6;i++){
                if(order.orderStatus===""+i){
                    statusOptions += '<option value="'+i+'" selected>'+getOrderStatusText(""+i)+'</option>';
                }else{
                    statusOptions += '<option value="'+i+'">'+getOrderStatusText(""+i)+'</option>';
                }
                if(i===5){
                  i+=2;
                  statusOptions += '<option value="'+i+'">'+getOrderStatusText(""+i)+'</option>';
                }
              }
              statusOptions += '</select>';
              var urgent = order.urgent == 1 ? '是' : '否';
              if(order.urgent==1){
                html += '<tr class="bg-danger">';
              }else if(order.urgent==0){
                html += '<tr>';
              }
              html += '<td>' + order.orderNum + '</td>';
              html += '<td>' + order.createTime + '</td>';
              html += '<td>' + statusOptions + '</td>';
              html += '<td>' + urgent + '</td>';
              html += '<td><button class="btn btn-primary btn-update" id="' + order.id + '">变更</button></td>';
              html += '</tr>';
            });
            $('#orderTable tbody').html(html);
          },
          error: function(xhr, textStatus, errorThrown) {
            console.log(errorThrown);
          }
        });
    }
    });

  </script>
<?php  }else{
    echo "无权访问";
  } ?>
