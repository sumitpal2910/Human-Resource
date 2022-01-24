<?php

require_once "../controllers/employees.controller.php";
require_once "../models/employees.model.php";

class EmployeeAjax
{
    /*===========================================
        SHOW EMPLOYEE
    ============================================== */
    public $employeeId;
    public function ajaxShowEmployee()
    {
        $item = "id";
        $value = $this->employeeId;
        $result = EmployeesController::ctlrShowEmployees($item, $value);
        echo json_encode($result);
    }
}


/*===========================================
        SHOW EMPLOYEE
============================================== */
if (isset($_POST['employeeId'])) {
    $employee = new EmployeeAjax();
    $employee->employeeId = $_POST['employeeId'];
    $employee->ajaxShowEmployee();
}
