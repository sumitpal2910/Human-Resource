<?php

require_once "../controllers/attendance.controller.php";
require_once "../models/attendance.model.php";

require_once "../controllers/employees.controller.php";
require_once "../models/employees.model.php";

require_once "../controllers/holidays.controller.php";
require_once "../models/holidays.model.php";

class ViewAttendanceDatatableAjax
{
    /**===============================================
     *      VIEW ALL EMPLOYEE ATTENDANCE
     * ===============================================*/
    public function viewAllAttendanceAjax()
    {
        $item = NULL;
        $value = NULL;
        $employees = EmployeesController::ctlrShowEmployees($item, $value);

        $hItem = "month_no";
        $hValue = date("m");
        $holidays = HolidayController::ctlrShowHoliday($hItem, $hValue);


        $jsonData = '{
            "data":[';

        foreach ($employees as $key => $employee) {
            $aItem = "employee_id";
            $aValue = $employee['id'];
            $order = "ASC";
            $month = NULL;
            $year = NULL;
            $monthAttendance = AttendanceController::ctlrShowAllAttendance($aItem, $aValue, $month, $year, $order);

            // IMAGES
            if ($employee['image']) {
                $image = "<img src='" . $employee['image'] . "' class='img-thumbnail rounded-circle' width='40px'>";
            } else {
                $image = "<img src='views/img/employees/default/default.jpg' class='img-thumbnail rounded-circle' width='40px'>";
            }

            $jsonData .= '[
                "' . $image . ' ' . $employee['name'] . '",';

            $totalPresent = 0;
            $workingDays = 0;
            $currDate = date("Y-m-d");
            foreach ($monthAttendance as $key => $attendance) {
                if ($attendance['full_date'] > $currDate) continue;

                if ($attendance['clock_in'] != 0) {
                    $button = "<a href='#' class='btnShowEmpAttendance' data-toggle='modal' data-target='#modalShowAttendance' id='" . $attendance['id'] . "'><i class='fas fa-check' style='color:green;' ></i></a>";
                    $totalPresent++;
                } else {
                    $button = "<i class='fas fa-times' style='color:red;'></i>";
                }
                // SHOW HOLIDAY
                foreach ($holidays as $key => $holiday) {
                    if ($attendance['full_date'] === $holiday['holiday_date']) {
                        $button = "<i class='fas fa-star' title='" . $holiday['occasion'] . "' style='color:#007bff;' ></i>";
                        break;
                    }
                }

                $workingDays++;


                $jsonData .= '"' . $button . '",';
            }
            $jsonData .= '"' . $totalPresent . ' / ' . $workingDays . '"';
            $jsonData .= '],';
        }
        $jsonData = substr($jsonData, 0, -1);





        $jsonData .= '] }';


        echo $jsonData;
    }
}

/**===============================================
 *      VIEW ALL EMPLOYEE ATTENDANCE
 * ===============================================*/
$viewAttendance = new ViewAttendanceDatatableAjax();
$viewAttendance->viewAllAttendanceAjax();
