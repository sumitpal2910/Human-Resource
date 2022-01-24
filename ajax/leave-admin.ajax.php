<?php

require_once "../controllers/leave.controller.php";
require_once "../models/leave.model.php";

require_once "../controllers/leave-types.controller.php";
require_once "../models/leave-types.model.php";

class AdminLeaveAjax
{
    /**===================================================
     *      APPROVED LEAVE
     * ====================================================*/
    public $leaveId;
    public function ajaxAdminApproveLeave()
    {
        $id = $this->leaveId;
        $result = LeaveController::ctlrAdminApprovedLeave($id);
        echo $result;
    }


    /**===================================================
     *      REJECT LEAVE
     * ====================================================*/
    public function ajaxAdminRejectLeave()
    {
        $id = $this->leaveId;
        $result = LeaveController::ctlrAdminRejectLeave($id);
        echo $result;
    }


    /**===================================================
     *      REMAIN LEAVE 
     * ====================================================*/
    public $leaveEmployeeId;
    public function ajaxShowRemainLeave()
    {
        $employeeId = $this->leaveEmployeeId;
        $leave = LeaveController::ctlrGetRemainLeave($employeeId);

        echo $leave;
    }
}

/**===================================================
 *      APPROVED LEAVE
 * ====================================================*/
if (isset($_POST['approvedLeave'])) {
    $approve = new AdminLeaveAjax();
    $approve->leaveId = $_POST['approvedLeave'];
    $approve->ajaxAdminApproveLeave();
}

/**===================================================
 *      REJECT LEAVE
 * ====================================================*/
if (isset($_POST['rejectLeave'])) {
    $approve = new AdminLeaveAjax();
    $approve->leaveId = $_POST['rejectLeave'];
    $approve->ajaxAdminRejectLeave();
}


/**===================================================
 *      SHOW LEAVE 
 * ====================================================*/
if (isset($_POST['remainLeave'])) {
    $leave = new AdminLeaveAjax();
    $leave->leaveEmployeeId = $_POST['remainLeave'];
    $leave->ajaxShowRemainLeave();
}
