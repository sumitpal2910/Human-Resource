<?php

require_once "../controllers/leave.controller.php";
require_once "../models/leave.model.php";

require_once "../controllers/leave-types.controller.php";
require_once "../models/leave-types.model.php";

class EmployeeLeaveAjax
{
    /**===================================================
     *      SHOW EMPLOYEE LEAVE IN DATATABLE
     * ====================================================*/
    public $employeeId;
    public function ajaxShowEmployeeLeave()
    {
        $item1 = "employee_id";
        $value1 = $this->employeeId;
        $item2 = NULL;
        $value2 = NULL;
        $allLeaves = LeaveController::ctlrShowEmployeeLeave($item1, $value1, $item2, $value2);

        $jsonData = '{
            "data":[';

        if ($allLeaves) {
            foreach ($allLeaves as $key => $leave) {
                // SHOW LEAVE TYPE
                $ltItem = "id";
                $ltValue = $leave['leave_type_id'];
                $leaveType = LeaveTypeController::ctlrShowLeaveType($ltItem, $ltValue);

                // STATUS
                $currDate = date("Y-m-d");
                switch ($leave['status']) {
                    case 'pending':
                        switch ($leave['apply_date']) {
                            case $currDate:
                                $status = "<h5><span class='badge badge-primary'>New</span></h5>";
                                break;

                            default:
                                $status = "<h5><span class='badge badge-warning'>Pending</span></h5>";
                                break;
                        }
                        break;
                    case 'approved':
                        $status = "<h5><span class='badge badge-success'>Approved</span></h5>";
                        break;

                    case 'rejected':
                        $status = "<h5><span class='badge badge-danger'>Rejected</span></h5>";
                        break;
                }

                // BUTTONS
                $id = $leave['id'];
                $button = "<div class='row'><button title='View / Edit' class='btn btn-outline-info btn-sm btnEditEmployeeLeave' id='$id' data-target='#modalEditEmployeeLeave' data-toggle='modal'><i class='fas fa-edit'></i></button>";
                $button .= "<button title='Delete' class='btn btn-outline-danger btn-sm ml-2 btnDeleteLeave' id='$id'><i class='fas fa-trash'></i></button></div>";

                $jsonData .= '[
                    "' . ($key + 1) . '",
                    "' . $leaveType['type'] . '",
                    "' . $leave['start_date'] . '",
                    "' . $leave['end_date'] . '",
                    "' . $leave['number_of_day'] . '",
                    "' . $leave['reason'] . '",
                    "' . $status . '",
                    "' . $button . '"
                ],';
            }

            $jsonData = substr($jsonData, 0, -1);

            $jsonData .= ']}';
        }



        echo $jsonData;
        // print_r($allLeaves);
    }


    /**===================================================
     *      SHOW LEAVE 
     * ====================================================*/
    public $leaveId;
    public function ajaxShowLeave()
    {
        $item = "id";
        $value = $this->leaveId;
        $result = LeaveController::ctlrShowLeave($item, $value);
        echo json_encode($result);
    }

  
}

/**===================================================
 *      SHOW EMPLOYEE LEAVE IN DATATABLE
 * ====================================================*/
if (isset($_POST['employeeId'])) {
    $showLeave = new EmployeeLeaveAjax();
    $showLeave->employeeId = $_POST['employeeId'];
    $showLeave->ajaxShowEmployeeLeave();
}


/**===================================================
 *      SHOW LEAVE 
 * ====================================================*/
if (isset($_POST['leaveId'])) {
    $leave = new EmployeeLeaveAjax();
    $leave->leaveId = $_POST['leaveId'];
    $leave->ajaxShowLeave();
}




