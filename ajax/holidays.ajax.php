<?php

require_once "../controllers/holidays.controller.php";
require_once "../models/holidays.model.php";

class HolidayAjax
{
    /*=============================================
    *   SHOW HOLIDAY USING MONTH
    =============================================== */
    public $month;
    public function ajaxShowHolidays()
    {
        $item = "month_no";
        $value = $this->month;

        $result = HolidayController::ctlrShowHoliday($item, $value);
        // echo json_encode($result);

        $jsonData = '{
            "data":[';
        foreach ($result as $key => $data) {
            $id = $data['id'];
            $date = substr($data['holiday_date'], -2) . " " . $data['month'] . " " . $data['year'];
            $button = "<button type='button' class='btn btn-danger btn-sm btnDeleteHoliday' id='$id'><i class='fas fa-trash'></i> Delete</button>";
            $jsonData .= '[
                "' . ($key + 1) . '",
                "' . $date . '",
                "' . $data['occasion'] . '",
                "' . $data['day'] . '",
                "' . $button . '"
            ],';
        }

        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= ']
                 }';

        echo $jsonData;
    }
}

if (isset($_POST['holidayMonth'])) {
    $holiday = new HolidayAjax();
    $holiday->month = $_POST['holidayMonth'];
    $holiday->ajaxShowHolidays();
}
