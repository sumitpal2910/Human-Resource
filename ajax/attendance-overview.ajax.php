<?php
require_once "../controllers/attendance.controller.php";
require_once "../models/attendance.model.php";

require_once "../controllers/leave-types.controller.php";
require_once "../models/leave-types.model.php";

require_once "../controllers/employees.controller.php";
require_once "../models/employees.model.php";

require_once "../controllers/leave.controller.php";
require_once "../models/leave.model.php";

class AjaxAttendanceOverview
{
    /**=====================================================
     *      SHOW ONE EMPLOYEE OVERVIEW
     * ======================================================*/
    public $employeeId, $month, $year;
    public function ajaxShowOneEmpOverview()
    {
        $employeeId = $this->employeeId;
        $month = $this->month;
        $year = $this->year;

        // EMPLOYEE
        $item = "id";
        $value = $employeeId;
        $employee = EmployeesController::ctlrShowEmployees($item, $value);

        // ATTENDNACE
        $aItem = "employee_id";
        $aValue = $employeeId;
        $order = "ASC";
        $monthAttendance = AttendanceController::ctlrShowAllAttendance($aItem, $aValue, $month, $year, $order);

        // LEAVE TYPES
        $ltItem = NULL;
        $ltValue = NULL;
        $leaveTypes = LeaveTypeController::ctlrShowLeaveType($ltItem, $ltValue);

        // LEAVES
        $lItem1 = "employee_id";
        $lValue1 = $employeeId;
        $leaves = LeaveController::ctlrShowEmployeeLeave($lItem1, $lValue1, null, null);


        // IMAGE
        if ($employee['image']) {
            $image = "<img src='" . $employee['image'] . "' class='img-thumbnail rounded-circle' width='40px'>";
        } else {
            $image = "<img src='views/img/employees/default/default.jpg' class='img-thumbnail rounded-circle' width='40px'>";
        }



        // LAST ABSENT
        $date1 = 0;
        $date2 = date("Y-m-d");
        foreach ($monthAttendance as $key => $attendance) {
            if ($attendance['full_date'] > $date2) continue;
            if ($attendance['clock_in'] == 0) {
                $date1 = $attendance['full_date'];
            }
        }

        $diff = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24);

        if ($date1 == 0) {
            $lastAbsent = "<h5><span class='badge badge-success'>Never</span></h5>";
        } elseif ($diff == 0) {
            $lastAbsent = "<h5><span class='badge badge-danger'>Today</span></h5>";
        } elseif ($diff > 30) {
            $lastAbsent = "<h5><span class='badge badge-success'>$diff days ago</span></h5>";
        } else {
            $lastAbsent = "<h5><span class='badge badge-danger'>$diff days ago</span></h5>";
        }


        $jsonData = '{
            "data":[
                [
                    "' . $employee['code'] . '",
                    "' . $image . ' ' . $employee['name'] . '",
                    "' . $lastAbsent . '",';


        // LEAVES TYPES
        foreach ($leaveTypes as $key => $leaveType) {
            $leaveNum = 0;
            foreach ($leaves as $key => $leave) {
                if ($leave['leave_type_id'] === $leaveType['id']) {
                    $leaveNum += $leave['number_of_day'];
                }
            }
            $jsonData .= '"' . $leaveNum . '",';
        }

        // GET ALL LEAVE
        $totalLeave = LeaveTypeController::ctlrGetTotalLeave();

        // STATUS
        if ($employee['status'] == 1) {
            $status = "<h5><p class='badge badge-success btn-xs'>Active</p></h5>";
        } else {
            $status = "<h5><p class='badge badge-danger btn-xs'>Inactive</p></h5>";
        }

        // BUTTONS
        $buttons = "<button empId='" . $employee['id'] . "' title='View' class='btn btn-outline-info btnEmpViewAtt'><i class='fas fa-eye'></i></button>";

        $jsonData .= '
                "' . $totalLeave . '",
                "' . $status . '",
                "' . $buttons . '"
                ]]}';


        echo $jsonData;
    }

    public function ajaxShowAllEmpOverview()
    {
        // LEAVE TYPES
        $ltItem = NULL;
        $ltValue = NULL;
        $leaveTypes = LeaveTypeController::ctlrShowLeaveType($ltItem, $ltValue);

        // EMPLOYEE
        $item = NULL;
        $value = NULL;
        $employees = EmployeesController::ctlrShowEmployees($item, $value);

        // JSON DATA
        $jsonData = '{
            "data":[';

        foreach ($employees as $key => $employee) {

            // ATTENDNACE
            $aItem = "employee_id";
            $aValue = $employee['id'];
            $order = "ASC";
            $monthAttendance = AttendanceController::ctlrShowAllAttendance($aItem, $aValue, null, null, $order);

            // LEAVES
            $lItem1 = "employee_id";
            $lValue1 = $employee['id'];
            $leaves = LeaveController::ctlrShowEmployeeLeave($lItem1, $lValue1, null, null);


            // IMAGE
            if ($employee['image']) {
                $image = "<img src='" . $employee['image'] . "' class='img-thumbnail rounded-circle' width='40px'>";
            } else {
                $image = "<img src='views/img/employees/default/default.jpg' class='img-thumbnail rounded-circle' width='40px'>";
            }



            // LAST ABSENT
            $date1 = 0;
            $date2 = date("Y-m-d");
            foreach ($monthAttendance as $key => $attendance) {
                if (
                    $attendance['full_date'] > $date2
                ) continue;
                if (
                    $attendance['clock_in'] == 0
                ) {
                    $date1 = $attendance['full_date'];
                }
            }

            $diff = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24);

            if ($date1 == 0) {
                $lastAbsent = "<h5><span class='badge badge-success'>Never</span></h5>";
            } elseif ($diff == 0) {
                $lastAbsent = "<h5><span class='badge badge-danger'>Today</span></h5>";
            } else {
                $lastAbsent = "<h5><span class='badge badge-danger'>$diff days ago</span></h5>";
            }

            // JSON DATA
            $jsonData .= '[
                    "' . $employee['code'] . '",
                    "' . $image . ' ' . $employee['name'] . '",
                    "' . $lastAbsent . '",';

            // LEAVES TYPES
            foreach ($leaveTypes as $key => $leaveType) {
                $leaveNum = 0;
                foreach ($leaves as $key => $leave) {
                    if ($leave['leave_type_id'] === $leaveType['id']) {
                        $leaveNum += $leave['number_of_day'];
                    }
                }
                $jsonData .= '"' . $leaveNum . '",';
            }

            // GET ALL LEAVE
            $totalLeave = LeaveTypeController::ctlrGetTotalLeave();

            // STATUS
            if ($employee['status'] == 1) {
                $status = "<h5><p class='badge badge-success btn-xs'>Active</p></h5>";
            } else {
                $status = "<h5><p class='badge badge-danger btn-xs'>Inactive</p></h5>";
            }

            // BUTTONS
            $buttons = "<button empId='" . $employee['id'] . "' title='View' class='btn btn-outline-info btnEmpViewAtt'><i class='fas fa-eye'></i></button>";

            $jsonData .= '
                "' . $totalLeave . '",
                "' . $status . '",
                "' . $buttons . '"
            ],';
        }

        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= ']}';

        echo  $jsonData;
    }
}

if (isset($_POST['employeeId'])) {
    $att = new AjaxAttendanceOverview();
    $att->employeeId = $_POST['employeeId'];
    $att->month = $_POST['month'];
    $att->year = $_POST['year'];

    if ($_POST['employeeId'] == 0 || !$_POST['employeeId']) {
        $att->ajaxShowAllEmpOverview();
    } else {
        $att->ajaxShowOneEmpOverview();
    }
}
