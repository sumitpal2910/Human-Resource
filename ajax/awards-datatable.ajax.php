<?php

require_once "../controllers/awards.controller.php";
require_once "../models/awards.model.php";

require_once "../controllers/employees.controller.php";
require_once "../models/employees.model.php";

class AwardAjax
{
    /**===============================================
     *      SHOW AWARDS IN TABLE
     * ===============================================*/
    public function ajaxShowAwards()
    {
        $jsonData = '{
            "data": [';

        $item = NULL;
        $value = NULL;
        $result = AwardController::ctlrShowAward($item, $value);
        // print_r($result);
        foreach ($result as $key => $data) {
            $id = $data['id'];

            $item1 = "id";
            $value1 = $data['employee_id'];
            $emp = EmployeesController::ctlrShowEmployees($item1, $value1);

            // BUTTON
            $button = "<div class='row'><button class='btn btn-info btn-sm btnEditAward mr-2' awardId='$id' employeeId='" . $emp['id'] . "'><i class='fas fa-edit'></i> View / Edit</button>";
            $button .= "<button class='btn btn-danger btn-sm btnDeleteAward ml-2' awardId='$id'><i class='fas fa-trash'></i> Delete</button></div>";

            $jsonData .= '[
                "' . $emp['code'] . '",
                "' . $emp['name'] . '",
                "' . $data['name'] . '",
                "' . $data['gift'] . '",
                "' . $data['month'] . '",
                "' . $button . '"
            ],';
        }

        $jsonData = substr($jsonData, 0, -1);

        $jsonData .= ']
             }';

        echo $jsonData;
    }
}


/**===============================================
 *      SHOW AWARDS IN TABLE
 * ===============================================*/
$awards = new AwardAjax();
$awards->ajaxShowAwards();
