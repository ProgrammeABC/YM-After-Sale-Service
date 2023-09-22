
<?php
class EmployeeModel {
  private $conn;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function createEmployee($eid, $name, $tel, $qq, $password, $role) {
    $stmt = $this->conn->prepare("INSERT INTO employee (eid, name, tel, qq, password, role) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $eid, $name, $tel, $qq, $password, $role);
    return $stmt->execute();

}

public function getEmployees() {
$query = "SELECT * FROM employee";
$result = $this->conn->query($query);
$employees = array();
while ($row = $result->fetch_assoc()) {
$employees[] = $row;
}
return $employees;
}

public function getEmployeeById($id) {
$stmt = $this->conn->prepare("SELECT * FROM employee WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
return $result->fetch_assoc();
}

public function updateEmployeeAll($id, $eid, $name, $tel, $qq, $role,$password) {
$stmt = $this->conn->prepare("UPDATE employee SET eid = ?, name = ?, tel = ?, qq = ?, role = ?, password=? WHERE id = ?");
$stmt->bind_param("ssssisi", $eid, $name, $tel, $qq, $role, $password, $id);
return $stmt->execute();
}
public function updateEmployee($id, $eid, $name, $tel, $qq, $role) {
  // echo $id.$eid.$name.$tel.$qq.$role;
  $stmt = $this->conn->prepare("UPDATE employee SET eid = ?, name = ?, tel = ?, qq = ?, role = ? WHERE id = ?");
  $stmt->bind_param("ssssii", $eid, $name, $tel, $qq, $role, $id);
  return $stmt->execute();
}

public function deleteEmployee($id) {
$stmt = $this->conn->prepare("DELETE FROM employee WHERE id = ?");
$stmt->bind_param("i", $id);
return $stmt->execute();
}
}
