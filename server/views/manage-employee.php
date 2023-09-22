<h2 style="text-align:center;">员工信息管理</h2>
<!--员工列表-->
<table id="employee-list" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>工号</th>
      <th>姓名</th>
      <th>电话</th>
      <th>QQ</th>
      <th>角色</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<!--编辑员工弹出框-->
<div id="edit-employee-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-employee-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="edit-employee-form">
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-employee-modal-label">编辑员工</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="eid" class="col-sm-3 col-form-label">工号：</label>
            <div class="col-sm-9">
            <input type="text" class="form-control uneditable-input" name="eid" disabled>
              <input type="hidden" class="form-control uneditable-input" name="eid" required>
            </div>
          </div>
          <div class="form-group row">
                <label for="reset-pwd" class="col-sm-3 col-form-label">密码：</label>
                <div class="col-sm-9">
                <div class="input-group">
                <input type="text" id="reset-pwd" class="form-control pwd-input" name="password" value="******">
                  <button type="button" class="btn btn-outline-secondary" onclick="generateRandomString('reset-pwd');">重置密码</button>
                  <button type="button" class="btn btn-outline-secondary" onclick="copyToClipboard('reset-pwd');">复制</button>
                </div>
                </div>
            </div>
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">姓名：</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="tel" class="col-sm-3 col-form-label">电话：</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="tel" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="qq" class="col-sm-3 col-form-label">QQ：</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="qq" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="role" class="col-sm-3 col-form-label">角色：</label>
            <div class="col-sm-9">
              <select class="form-control" name="role" required>
                <option value="" selected>请选择角色</option>
                <option value="0">管理员</option>
                <option value="1">客服代表</option>
                <option value="2">工程师</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close" data-dismiss="modal">取消</button>
          <button type="submit" class="btn btn-primary">保存</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--创建员工弹出框-->
<div id="create-employee-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-employee-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="create-employee-form">
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-employee-modal-label">创建员工</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--创建员工表单-->
            <div class="form-group row">
                <label for="eid" class="col-sm-3 col-form-label">工号：</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="eid" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="pwd" class="col-sm-3 col-form-label">密码：</label>
                <div class="col-sm-9">
                <div class="input-group">
                <input type="text" id="pwd" class="form-control pwd-input" name="password" required>
                  <button type="button" class="btn btn-outline-secondary" onclick="generateRandomString('pwd');">生成密码</button>
                  <button type="button" class="btn btn-outline-secondary" onclick="copyToClipboard('pwd');">复制</button>
                </div>
                
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">姓名：</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="tel" class="col-sm-3 col-form-label">电话：</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="tel" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="qq" class="col-sm-3 col-form-label">QQ：</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="qq" required>
            </div>

            </div>
            <div class="form-group row">
                <label for="role" class="col-sm-3 col-form-label">角色：</label>
                <div class="col-sm-9">
                <select class="form-control" name="role" required>
                    <option value="" selected>请选择角色</option>
                    <option value="0">管理员</option>
                    <option value="1">客服代表</option>
                    <option value="2">工程师</option>
                </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close" data-dismiss="modal">取消</button>
          <button type="submit" class="btn btn-primary">保存</button>
        </div>
      </form>
    </div>
  </div>
</div>

<p style="text-align:center;"><button type="button" id="btn-create-employee" class="btn btn-primary">+添加员工</button></p>






<!-- jQuery -->
<script src="/static/jquery-3.6.4.js"></script>
<script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
<link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
<!-- Employee Management script -->
<script>
      // 生成10位随机密码
    function generateRandomString(id) {
      // console.log($(this).parents("input").prop("id"));
        var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var result = '';
        for (var i = 0; i < 10; i++) {
            result += chars[Math.floor(Math.random() * chars.length)];
        }
        document.getElementById(id).value = result;
        copyToClipboard(id)
    }

    // 复制文本框内容到剪贴板
    function copyToClipboard(id) {
        var ePwd = document.getElementById(id);
        ePwd.select();
        document.execCommand("copy");
        alert("已复制密码：" + ePwd.value + " 到剪贴板，请妥善保管！");
    }
  // 获取员工列表并展示
function getEmployees() {
  $.ajax({
    url: "/opreate/index.php/getEmployees",
    type: "GET",
    dataType: "json",
    success: function(data) {
      var employees = data;
      var employeeRows = '';
      $.each(employees, function(index, employee) {
        employeeRows += '<tr>';
        employeeRows += '<td>' + employee.id + '</td>';
        employeeRows += '<td>' + employee.eid + '</td>';
        employeeRows += '<td>' + employee.name + '</td>';
        employeeRows += '<td>' + employee.tel + '</td>';
        employeeRows += '<td>' + employee.qq + '</td>';
        employeeRows += '<td>' + getEmployeeRoleText(employee.role) + '</td>';
        employeeRows += '<td>';
        employeeRows += '<button class="btn btn-sm btn-primary edit-employee-btn" data-id="' + employee.id + ' "data-eid="' + employee.eid + '">维护</button> ';
        employeeRows += '<button class="btn btn-sm btn-danger delete-employee-btn" data-id="' + employee.id + '" data-eid="' + employee.eid + '">删除</button>';
        employeeRows += '</td>';
        employeeRows += '</tr>';
      });
      $('#employee-list tbody').html(employeeRows);
    },
    error: function(xhr, status, errorThrown) {
      alert("获取员工列表失败：" + errorThrown);
    }
  });
}

// 创建员工记录
$('#create-employee-form').submit(function(event) {
  event.preventDefault();
  var formData = $(this).serialize();
  $.ajax({
    url: "/opreate/index.php/createEmployee",
    type: "POST",
    data: formData,
    success: function(data) {
      alert("创建员工记录成功！");
      $('#create-employee-form')[0].reset();
      $('#create-employee-modal').modal('hide');
      getEmployees();
    },
    error: function(xhr, status, errorThrown) {
      alert("创建员工记录失败：" + errorThrown);
    }
  });
});

// 编辑员工记录
$('#edit-employee-form').submit(function(event) {
  event.preventDefault();
  var formData = $(this).serialize();
  $.ajax({
    url: "/opreate/index.php/editEmployee",
    type: "POST",
    data: formData,
    success: function(data) {
      alert("尝试编辑员工记录成功！");
      $('#edit-employee-form')[0].reset();
      $('#edit-employee-modal').modal('hide');
      getEmployees();
    },
    error: function(xhr, status, errorThrown) {
      alert("编辑员工记录失败：" + errorThrown);
    }
  });
});

// 显示编辑员工弹出框
$('#employee-list').on('click', '.edit-employee-btn', function() {
  if("root"===$(this).data('eid')){
    alert("root不允许修改！")
  }else{
    var id = $(this).data('id');
  $.ajax({
    url: "/opreate/index.php/getEmployeeByID",
    type: "POST",
    dataType: "json",
    data: { id: id },
    success: function(data) {
      $('#edit-employee-form input[name=id]').val(data.id);
      $('#edit-employee-form input[name=eid]').val(data.eid);
      $('#edit-employee-form input[name=name]').val(data.name);
      $('#edit-employee-form input[name=tel]').val(data.tel);
      $('#edit-employee-form input[name=qq]').val(data.qq);
      $('#edit-employee-form select[name=role]').val(data.role);
      $('#edit-employee-modal').modal('show');
    },
    error: function(xhr, status, errorThrown) {
      alert("获取员工信息失败：" + errorThrown);
    }
  });
  }
});

// 关闭编辑员工弹出框
$('#edit-employee-modal .close').click(function() {
  $('#edit-employee-modal').modal('hide');
});
$('#edit-employee-modal .close').click(function() {
  $('#edit-employee-modal').modal('hide');
});

// 删除员工记录
$('#employee-list').on('click', '.delete-employee-btn', function() {
  var id = $(this).data('id');
  if("root"===$(this).data('eid')){
    alert("root不允许修改！")
  }else{
    if (confirm("确认删除该员工记录吗？删除前请确定无关联售后单，否则删除指令不生效！")) {
    $.ajax({
      url: "/opreate/index.php/deleteEmployee",
      type: "POST",
      data: { id: id },
      success: function(data) {
        alert("尝试删除员工记录成功！");
        getEmployees();
      },
      error: function(xhr, status, errorThrown) {
        alert("删除员工记录失败：" + errorThrown);
      }
    });
  }
  }
});
// 打开创建员工弹出框
$('#btn-create-employee').click(function() {
    $('#create-employee-modal').modal('show');
});
// 关闭创建员工弹出框
$('#create-employee-modal .close').click(function() {
  $('#create-employee-modal').modal('hide');
});
$('#create-employee-modal .close').click(function() {
  $('#create-employee-modal').modal('hide');
});
// 页面加载时获取员工列表
$(document).ready(function() {
  getEmployees();
});
    // 获取员工角色文本
    function getEmployeeRoleText(status) {
        switch (status) {
            case "0": return "管理员";
            case "1": return "客服代表";
            case "2": return "工程师";
            default: return "";
        }
    }
</script>