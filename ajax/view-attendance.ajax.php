<?php
require_once "../controllers/attendance.controller.php";
require_once "../models/attendance.model.php";

require_once "../controllers/holidays.controller.php";
require_once "../models/holidays.model.php";

require_once "../controllers/leave.controller.php";
require_once "../models/leave.model.php";

class AjaxViewAttendance
{
    /**================================================
     *      SHOW ATTENDANCE USING ID
     * ==================================================*/
    public $attendanceId;
    public function ajaxShowAttendance()
    {
        $item = "id";
        $value = $this->attendanceId;
        $item2 = NULL;
        $value2 = NULL;

        $result = AttendanceController::ctlrShowOneAttendance($item, $value, $item2, $value2);
        echo json_encode($result);
    }

    /**=======================================================
     *      SHOW ATTENDANCE IN CALENDAR
     * ========================================================*/
    public $employeeId;
    public $month;
    public $year;
    public function ajaxShowAttendanceCalendar()
    {
        // ATTENDANCE
        $aItem = "employee_id";
        $aValue = $this->employeeId;
        $month = $this->month;
        $year = $this->year;
        $order = "ASC";
        $attendance = AttendanceController::ctlrShowAllAttendance($aItem, $aValue, $month, $year, $order);

        // HOLIDAY
        $hItem = "month_no";
        $hvalue = $this->month;
        $holidays = HolidayController::ctlrShowHoliday($hItem, $hvalue);

        // LEAVES
        $lItem1 = "employee_id";
        $lValue1 = $this->employeeId;
        $lItem2 = NULL;
        $lValue2 = NULL;
        $leaves = LeaveController::ctlrShowEmployeeLeave($lItem1, $lValue1, $lItem2, $lValue2);

        // CURRENT DATE

        $currDate = date("Y-m-d");
        $currMonth = date("m");
        $jsonData = [];

        foreach ($attendance as $key => $data) {
            if ($data['month'] == $currMonth) {
                if ($data['full_date'] > $currDate) continue;
            }

            $arr = [];
            if ($data['clock_in'] == 0 || !$data['clock_in']) {
                $check = 0;
                //  CHECK FOR HOLIDAY
                foreach ($holidays as $key => $holiday) {
                    if ($holiday['holiday_date'] === $data['full_date']) {
                        $arr = ['title' => $holiday['occasion'], "start" => $holiday['holiday_date'], "backgroundColor" => "#007BFF", "borderColor" => "#007BFF", "allDay" => true];
                        $check = array_push($jsonData, $arr);
                    }
                }
                // CHECK FOR LEAVE
                foreach ($leaves as $key => $leave) {
                    if ($leave['status'] === 'approved') {
                        if ($data['full_date'] >= $leave['start_date'] && $data['full_date'] <= $leave['end_date']) {
                            $endDay = substr($leave['end_date'], -2) + 1;
                            $endDate = substr($leave['end_date'], 0, -2) . $endDay;

                            $arr = ['title' => $leave['reason'], "start" => $leave['start_date'], "end" => $endDate, "backgroundColor" => "#17A2BB", "borderColor" => "#17A2BB", "allDay" => true];
                            if (in_array($arr, $jsonData)) {
                                $check = 1;
                                continue;
                            }
                            $check = array_push($jsonData, $arr);
                        }
                    }
                }

                // MARK ABSENT
                if ($check === 0 || !$check) {
                    $arr = ['title' => "Absent", "start" => $data['full_date'], "backgroundColor" => "#DC3545", "borderColor" => "#DC3545", "allDay" => true];
                    if (in_array($arr, $jsonData)) continue;
                    array_push($jsonData, $arr);
                }
            } else {
                switch ($data['status']) {
                    case 'late':
                        $arr = ['title' => "Late", "start" => $data['full_date'], "backgroundColor" => "#FFC107", "borderColor" => "#FFC107", "allDay" => true];
                        array_push($jsonData, $arr);
                        break;
                    case 'present':
                        $arr = ['title' => "Present", "start" => $data['full_date'], "backgroundColor" => "#FFC107", "borderColor" => "#FFC107", "allDay" => true];
                        array_push($jsonData, $arr);
                        break;
                }
            }
        }

        echo json_encode($jsonData);
    }


    /**=======================================================
     *      SHOW MONTH ATTENDANCE OVERVIEW
     * ========================================================*/
    public function ajaxShowAttendanceOverview()
    {

        // ATTENDANCE
        $aItem = "employee_id";
        $aValue = $this->employeeId;
        $month = $this->month;
        $year = $this->year;
        $order = "ASC";
        $attendance = AttendanceController::ctlrShowAllAttendance($aItem, $aValue, $month, $year, $order);

        // HOLIDAY
        $hItem = "month_no";
        $hvalue = $this->month;
        $holidays = HolidayController::ctlrShowHoliday($hItem, $hvalue);

        // LEAVES
        $lItem1 = "employee_id";
        $lValue1 = $this->employeeId;
        $lItem2 = NULL;
        $lValue2 = NULL;
        $leaves = LeaveController::ctlrShowEmployeeLeave($lItem1, $lValue1, $lItem2, $lValue2);

        $currDate = date("Y-m-d");
        $currMonth = date("m");

        $totalWorkingDay = 0;
        $present = 0;
        $absent = 0;
        $late = 0;
        $halfDay = 0;
        $holiday = count($holidays);
        $totalLeave = 0;
        $finalLeave = 0;

        foreach ($attendance as $key => $data) {
            if ($data['month'] == $currMonth) {
                if ($data['full_date'] > $currDate) continue;
            }
            switch ($data['status']) {
                case 'present':
                    $present++;
                    break;

                case 'late':
                    $late++;
                    $present++;
                    break;

                case 'halfday':
                    $halfDay++;
                    $present++;
                    break;

                case 'absent':
                    $absent++;
                    break;
            }

            $totalWorkingDay++;
        }


        // LEAVES

        $currDate = date("Y-m-d");
        $currDay = date("d");
        $currMonth = date("m");
        $m = strlen($month) === 1 ? "0" . $month : '' . $month;
        $leaveSatrtDate = $year . "-" . $m . "-01";
        $leaveEndDate =  $year . "-" . $m . "-31";
        foreach ($leaves as $key => $leave) {
            if ($leave['start_date'] >= $leaveSatrtDate   && $leave['end_date'] <= $leaveEndDate) {
                if ($leave['status'] === 'approved') {
                    $endMonth = substr($leave['end_date'], 5, 2);
                    $endDate = substr($leave['end_date'], -2);

                    if ($endMonth == $currMonth && $endDate >= $currDay) {
                        $diff =   (strtotime($currDate) - strtotime($leave['start_date'])) / (60 * 60 * 24) + 1;
                        $totalLeave += $diff;
                    } else {
                        $totalLeave += $leave['number_of_day'];
                    }
                    $finalLeave += $leave['number_of_day'];
                }
            }
        }

        $absent = $absent - $totalLeave;

        $jsonData = [
            "working_day" => $totalWorkingDay, "present" => $present, "late" => $late,
            "absent" => $absent, "holiday" => $holiday, "half_day" => $halfDay, "leave" => $finalLeave
        ];

        echo json_encode($jsonData);
    }
}

/**================================================
 *      SHOW ATTENDANCE USING ID
 * ==================================================*/
if (isset($_POST['attendanceId'])) {
    $showAttendance = new AjaxViewAttendance();
    $showAttendance->attendanceId = $_POST['attendanceId'];
    $showAttendance->ajaxShowAttendance();
}


/**=======================================================
 *      SHOW ATTENDANCE IN CALENDAR
 * ========================================================*/
if (isset($_POST['fullCal'])) {
    $attendance = new AjaxViewAttendance();
    $attendance->employeeId = $_POST['employeeId'];
    $attendance->month = $_POST['month'];
    $attendance->year = $_POST['year'];
    $attendance->ajaxShowAttendanceCalendar();
}


/**=======================================================
 *      SHOW MONTH ATTENDANCE OVERVIEW
 * ========================================================*/
if (isset($_POST['attendanceOverview'])) {
    $overview = new AjaxViewAttendance();
    $overview->employeeId = $_POST['employeeId'];
    $overview->month = $_POST['month'];
    $overview->year = $_POST['year'];
    $overview->ajaxShowAttendanceOverview();
}
