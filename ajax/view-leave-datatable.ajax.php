<?php

require_once "../controllers/leave.controller.php";
require_once "../models/leave.model.php";

require_once "../controllers/employees.controller.php";
require_once "../models/employees.model.php";

require_once "../controllers/leave-types.controller.php";
require_once "../models/leave-types.model.php";

class ShowLeaveAjax
{
    /**======================================================
     *      SHOW LEAVE IN DATATABLE
     * =======================================================*/
    public function ajaxShowLeave()
    {
        $lItem = NULL;
        $lValue = NULL;
        $leaves = LeaveController::ctlrShowLeave($lItem, $lValue);

        $jsonData = '{
                "data":[';
        foreach ($leaves as $key => $leave) {
            $eItem = "id";
            $eValue = $leave['employee_id'];
            $employee = EmployeesController::ctlrShowEmployees($eItem, $eValue);

            $ltItem = "id";
            $ltValue = $leave['leave_type_id'];
            $leaveType = LeaveTypeController::ctlrShowLeaveType($ltItem, $ltValue);

            // NAME AND IMAGE
            if ($employee['image']) {
                $img = "<img src='" . $employee['image'] . "' class='rounded-circle img-thumbnail' width='40px'>";
            } else {
                $img = "<img src='views/img/employees/default/default.jpg' class='rounded-circle img-thumbnail'  width='40px'>";
            }

            $currDate = date("Y-m-d");

            // REMAINING DAY TO GO
            $remainDay = 0;
            if ($currDate < $leave['start_date']) {
                $remainDay = (strtotime($leave['start_date']) - strtotime($currDate)) / (60 * 60 * 24);
            }


            // CALCULATE LEAVE DAYS
            $startDate = strtotime($leave['start_date']);
            $endDate = strtotime($leave['end_date']);
            $dayDiff = ($endDate - $startDate) / (60 * 60 * 24) + 1;

            // DAYS
            if ($leave['status'] === 'pending') {
                if ($currDate == $leave['start_date']) {
                    $days = $dayDiff . " Days <sup><span class='badge rounded-pill bg-warning text-white'>Today</span></sup>";
                } else {
                    $days = $dayDiff . " Days <sup><span class='badge rounded-pill bg-warning text-white'>$remainDay days left</span></sup>";
                }
            } else {
                $days = $dayDiff . " Days";
            }

            // STATUS
            switch ($leave['status']) {
                case 'pending':
                    switch ($leave['apply_date']) {
                        case $currDate:
                            $status = "<h5><span class='badge badge-primary adminLeaveStatus'>New</span></h5>";
                            break;

                        default:
                            $status = "<h5><span class='badge badge-warning adminLeaveStatus'>Pending</span></h5>";
                            break;
                    }
                    break;
                case 'approved':
                    $status = "<h5><span class='badge badge-success adminLeaveStatus'>Approved</span></h5>";
                    break;

                case 'rejected':
                    $status = "<h5><span class='badge badge-danger adminLeaveStatus'>Rejected</span></h5>";
                    break;
            }

            // BUTTONS
            $id = $leave['id'];
            $button = "<div class='row'><button title='Approve' class='btn btn-sm btn-outline-success btnApprovedLeave' id='$id'><i class='fas fa-check'></i></button>";
            $button .= "<button title='Reject' class='btn btn-sm btn-outline-danger ml-2 btnRejectedLeave' id='$id'><i class='fas fa-times'></i></button>";
            $button .= "<button title='View / Edit' class='btn btn-outline-info btn-sm ml-2 btnEditLeave' id='$id' data-target='#modalEditLeave' data-toggle='modal'><i class='fas fa-edit'></i></button>";
            $button .= "<button title='Delete' class='btn btn-outline-danger btn-sm ml-2 btnDeleteLeave' id='$id'><i class='fas fa-trash'></i></button></div>";

            $employeeDetail =  $img . " " . $employee['name'];
            $jsonData .= '[
                "' . $employee['code'] . '",
                "' . $employeeDetail . '",
                "' . $leaveType['type'] . '",
                "' . $leave['start_date'] . '",
                "' . $leave['end_date'] . '",
                "' . $days . '",
                "' . $leave['reason'] . '",
                "' . $leave['apply_date'] . '",
                "' . $status . '",
                "' . $button . '"
            ],';
        }
        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= ']}';
        echo $jsonData;
    }
}

$showLeave = new ShowLeaveAjax();
$showLeave->ajaxShowLeave();
