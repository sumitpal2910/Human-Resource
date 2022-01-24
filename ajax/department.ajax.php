<?php

require_once "../controllers/department.controller.php";
require_once "../models/department.model.php";

class DepartmentAjax
{
    /*================================================
        FETCH DESIGNATION ACCORING TO DEPARTMENT ID 
    ================================================== */
    public $deptId;
    public function ajaxShowDesignation()
    {
        $item = "id";
        $value = $this->deptId;
        $result = DepartmentController::ctlrShowDepartment($item, $value);
        echo json_encode($result);
    }
}


/*================================================
        FETCH DESIGNATION ACCORING TO DEPARTMENT ID 
    ================================================== */
if (isset($_POST['departmentId'])) {
    $desg = new DepartmentAjax();
    $desg->deptId = $_POST['departmentId'];
    $desg->ajaxShowDesignation();
}
