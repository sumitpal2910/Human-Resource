<?php

require_once "../controllers/leave-types.controller.php";
require_once "../models/leave-types.model.php";

class LeaveTypeDataTableAjax
{
    /*==========================================
     *      SHOW LEAVE TYPE IN DATATABLE
    ============================================ */
    static public function ajaxShowLeaveTypeDataTable()
    {
        $item = NULL;
        $value = NULL;
        $result = LeaveTypeController::ctlrShowLeaveType($item, $value);

        $jsonData = '{
            "data":[';

        foreach ($result as $key => $data) {
            $id = $data['id'];

            // BUTTONS
            $button = "<div class='row'><button class='btn btn-info btn-sm btnEditLeaveType' data-toggle='modal' data-target='#modalEditLeaveType' id='$id'><i class='fas fa-edit'></i> View / Edit</button>";
            $button .= "<button class='btn btn-danger btn-sm ml-3 btnDeleteLeaveType' id='$id'><i class='fas fa-trash'></i> Delete</button></div>";

            $jsonData .= '[
                    "' . ($key + 1) . '",
                    "' . $data['type'] . '",
                    "' . $data['number_of_day'] . '",
                    "' . $button . '"
                ],';
        }

        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= '] }';

        echo $jsonData;
    }
}

/*==========================================
     *      SHOW LEAVE TYPE IN DATATABLE
    ============================================ */
$leaveType = new LeaveTypeDataTableAjax();
$leaveType->ajaxShowLeaveTypeDataTable();
