<?php

require_once "../controllers/attendance.controller.php";
require_once "../models/attendance.model.php";

class AjaxEmployeeAttendanceTable
{
    /**================================================
     *      SHOW ATTENDANCE OF A EMPLOYEE
     * =================================================*/
    public $employeeId;
    public function ajaxShowEmployeeAttendance()
    {
        $item = "employee_id";
        $value = $this->employeeId;
        $order = "DESC";
        $year = date("Y");
        $month = date("m");
        $result = AttendanceController::ctlrShowAllAttendance($item, $value, $month, $year, $order);

        $numOfDay = date("d");
        $jsonData = '{
            "recordsTotal": ' . $numOfDay . ',
            "recordsFiltered": ' . $numOfDay . ',
            "data":[';

        $srNo = 1;
        $currDate = date("Y-m-d");
        foreach ($result as $key => $data) {

            $date = $data['full_date'];
            if ($date > $currDate) continue;

            //   CLOCK IN
            $clockIn = $data['clock_in'] == 0 ? "--" : $data['clock_in'];

            // CLOCK OUT
            $clockOut = $data['clock_out'] == 0 ? "--" : $data['clock_out'];

            // STATUS
            switch ($data['status']) {
                case 'absent':
                    $status = "<span class='badge badge-danger'>Absent</span>";
                    break;
                case 'present':
                    $status = "<span class='badge badge-success'>Present</span>";
                    break;
                case 'holiday':
                    $status = "<span class='badge badge-primary'>Holiday</span>";
                    break;
                case 'late':
                    $status = "<span class='badge badge-warning'>Late</span>";
                    break;
            }
            $jsonData .= '[
                "' . $srNo . '",
                "' . $data['full_date'] . '",
                "' . $clockIn . '",
                "' . $clockOut . '",
                "' . $status . '",
                "' . date("l", strtotime($date)) . '"
            ],';

            $srNo++;
        }

        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= '] }';

        echo $jsonData;
    }
}

/**================================================
 *      SHOW ATTENDANCE OF A EMPLOYEE
 * =================================================*/
if (isset($_POST['employeeId'])) {
    $attendance = new AjaxEmployeeAttendanceTable();
    $attendance->employeeId = $_POST['employeeId'];
    $attendance->ajaxShowEmployeeAttendance();
}
