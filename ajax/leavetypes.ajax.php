<?php

require_once "../controllers/leave-types.controller.php";
require_once "../models/leave-types.model.php";

class AjaxLeaveType
{
    /*=============================================
    *   SHOW LEAVE TYPE
    =============================================== */
    public $leaveTypeId;
    public function ajaxShowLeaveType()
    {
        $item = "id";
        $value = $this->leaveTypeId;
        $result = LeaveTypeController::ctlrShowLeaveType($item, $value);
        echo json_encode($result);
    }
}

/*=============================================
*   SHOW LEAVE TYPE
=============================================== */
if (isset($_POST['leaveTypeId'])) {
    $leaveType = new AjaxLeaveType();
    $leaveType->leaveTypeId = $_POST['leaveTypeId'];
    $leaveType->ajaxShowLeaveType();
}
