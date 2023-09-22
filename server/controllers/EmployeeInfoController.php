<?php
require_once '../server/model/EmployeeModel.php';
class EmployeeInfoController{
    private $model;

    public function __construct($db) {
      $this->model = new EmployeeModel($db);
    }
  
    public function createEmployee($eid, $name, $tel, $qq, $password, $role) {
      $hashed_password = hash("sha256",$password);
      return $this->model->createEmployee($eid, $name, $tel, $qq, $hashed_password, $role);
    }
  
    public function getEmployees() {
      return $this->model->getEmployees();
    }
  
    public function getEmployeeById($id) {
      return $this->model->getEmployeeById($id);
    }
  
    public function updateEmployeeAll($id, $password, $eid, $name, $tel, $qq, $role) {
      $hashed_password = hash("sha256",$password);
      // echo 2;
      return $this->model->updateEmployeeAll($id, $eid, $name, $tel, $qq, $role,$hashed_password);
    }
    public function updateEmployee($id, $eid, $name, $tel, $qq, $role) {
      return $this->model->updateEmployee($id, $eid, $name, $tel, $qq, $role);
    }
  
    public function deleteEmployee($id) {
      return $this->model->deleteEmployee($id);
    }
}


?>