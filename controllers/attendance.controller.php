<?php

class AttendanceController
{
    /*====================================================
    *   MARK ALL ATTENDANCE
    ====================================================== */
    static public function ctlrMarkAllAttendance()
    {
        $item = NULL;
        $value = NULL;
        $holidays = HolidayController::ctlrShowHoliday($item, $value);

        $day = date("t");
        for ($i = 1; $i <= $day; $i++) {

            $empId = $_SESSION['empId'];
            $date = strlen($i) === 1 ? "0" . $i : $i;
            $month = date("m");
            $year = date("Y");
            $fullDate = $year . "-" . $month . "-" . $date;
            $status = "absent";
            $clockIn = "00:00:00";
            $clockOut = "00:00:00";


            foreach ($holidays as $key => $holiday) {
                if ($holiday['holiday_date'] == $fullDate) {
                    $status = "holiday";
                    break;
                }
            }
            $table = "attendance";
            $data = [':employee_id' => $empId, ":clock_in" => $clockIn, ":clock_out" => $clockOut, ":full_date" => $fullDate, ":date" => $date, ":month" => $month, ":year" => $year, ":status" => $status];
            $result = ModelAttendance::mdlMarkAttendance($table, $data);
        }
        echo "<script>
                window.location = 'emp-attendance';
            </script>";
    }
    /*====================================================
    *  ATTENDANCE CLOCK IN 
    ====================================================== */
    static public function ctlrAttendanceClockIn()
    {
        if (isset($_POST['attendanceClockIn'])) {
            $table = "attendance";

            $employeeId = $_SESSION['empId'];
            $clockIn = date("H:i:s");
            $fullDate = date("Y-m-d");

            $status = "present";

            if ($clockIn > "10:00:00") {
                $status = "late";
            }

            $item1 = "employee_id";
            $value1 = $employeeId;
            $item2 = "full_date";
            $value2 = date("Y-m-d");
            $checkClock = ModelAttendance::mdlShowOneAttendance($table, $item1, $value1, $item2, $value2);
            if ($checkClock['clock_in'] != 0) {
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'You Are Already Clock In',
                    confirmButtonText: 'Close'
                }).then((res)=>{
                            if(res.value){
                                window.location = 'emp-attendance';
                            }
                        })
                    </script>";
            } else {

                $data = [':clock_in' => $clockIn, ":status" => $status, ":employee_id" => $employeeId, ":full_date" => $fullDate];
                $result = ModelAttendance::mdlAttendanceClockIn($table, $data);

                if ($result === "ok") {
                    echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'You Are Clock In',
                    confirmButtonText: 'Close'
                }).then((res)=>{
                            if(res.value){
                                window.location = 'emp-attendance';
                            }
                        })
                    </script>";
                }
            }
        }
    }

    /*=================================================
        SHOW EMPLOYEE ONE ATTENDANCE
    ======================================================= */
    static public function ctlrShowOneAttendance($item1, $value1, $item2, $value2)
    {
        $table = "attendance";
        return ModelAttendance::mdlShowOneAttendance($table, $item1, $value1, $item2, $value2);
    }

    /*=================================================
        SHOW EMPLOYEE ALL ATTENDANCE
    ======================================================= */
    static public function ctlrShowAllAttendance($item, $value, $month, $year, $order)
    {
        $table = "attendance";
        $year = !$year ? date("Y") : $year;
        $month = !$month ? date("m") : $month;
        return ModelAttendance::mdlShowAllAttendance($table, $item, $value, $month, $year, $order);
    }

    /*=================================================
        CLOCK OUT ATTENDANCE
    ======================================================= */
    static public function ctlrAttendanceClockOut()
    {
        if (isset($_POST['attendanceClockOut'])) {
            $table = "attendance";
            $clockOut = date("H:i:s");
            $employeeId = $_SESSION['empId'];
            $status = "present";
            $fullDate = date("Y-m-d");


            $item = "employee_id";
            $value = $employeeId;
            $item2 = "full_date";
            $value2 = $fullDate;
            $checkClock = ModelAttendance::mdlShowOneAttendance($table, $item, $value, $item2, $value2);
            if ($checkClock['clock_in'] != 0) {

                $status = $clockOut < "15:00:00" ? "halfday" : $checkClock['status'];

                $data = [":clock_out" => $clockOut, ":status" => $status, ":employee_id" => $employeeId, ":full_date" => $fullDate];
                $result = ModelAttendance::mdlAttendanceClockOut($table, $data);
                if ($result === "ok") {
                    echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Clock Out Success',
                    confirmButtonText: 'Close'
                }).then((res)=>{
                    window.location = 'emp-attendance';
                })
             </script>";
                }
            } else {
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'You are not Clock In',
                    confirmButtonText: 'Close'
                }).then((res)=>{
                    window.location = 'emp-attendance';
                })
        </script>";
            }
        }
    }

    /*=================================================
        SHOW EMPLOYEE  ATTENDANCE IN CALENDAR
    ======================================================= */
    static public function ctlrShowAttendanceCalendar()
    {
        // if(isset())
        // ATTENDANCE
        $aItem = "employee_id";
        $aValue = 1;
        $month = 7;
        $year = 2021;
        $order = "ASC";
        $attendance = AttendanceController::ctlrShowAllAttendance($aItem, $aValue, $month, $year, $order);

        // HOLIDAY
        $hItem = "month_no";
        $hvalue = 7;
        $holidays = HolidayController::ctlrShowHoliday($hItem, $hvalue);

        // LEAVES
        $lItem1 = "employee_id";
        $lValue1 = 1;
        $lItem2 = NULL;
        $lValue2 = NULL;
        $leaves = LeaveController::ctlrShowEmployeeLeave($lItem1, $lValue1, $lItem2, $lValue2);

        $jsonData = [];

        foreach ($attendance as $key => $data) {
            $arr = [];
            if ($data['clock_in'] == 0 || !$data['clock_in']) {

                foreach ($holidays as $key => $holiday) {
                    if ($holiday['holiday_date'] === $data['full_date']) {
                        $arr = ["title" => "holiday", "start" => $holiday['holiday_date'], "end" => "0000-00-00"];
                        array_push($jsonData, $arr);
                    } else {
                        
                        foreach ($leaves as $key => $leave) {
                            if ($leave['status'] === 'approved') {
                                if ($data['full_date'] >= $leave['start_date'] && $data['full_date'] <= $leave['end_date']) {
                                    $arr = ["title" => "leave", "start" => $leave['start_date'], "end" => $leave['end_date']];
                                    if (in_array($arr, $jsonData)) continue;
                                    array_push($jsonData, $arr);
                                }
                            }
                        }
                    }
                }
            }
        }
        return $jsonData;
    }
}
