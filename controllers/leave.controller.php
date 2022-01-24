<?php

class LeaveController
{

    /**=====================================================
     *      GET REMAIN LEAVE
     * ======================================================*/
    static public function ctlrGetRemainLeave($employeeId)
    {
        // REMAINING LEAVE
        $item1 = "employee_id";
        $value1 = $employeeId;
        $item2 = NULL;
        $value2 = NULL;
        $leaves = LeaveController::ctlrShowEmployeeLeave($item1, $value1, $item2, $value2);

        $totalLeave = LeaveTypeController::ctlrGetTotalLeave();
        // -------------------------------------------------------------------
        // print_r($leaves);
        $remainLeaveArr = [];
        foreach ($leaves as $key => $leave) {
            array_push($remainLeaveArr, $leave['remain_leave']);
        }
        return $remainLeaveArr ? min($remainLeaveArr) : $totalLeave;
    }

    /** ================================================================================================================================
     * ====================================================     EMPLOYEE    ============================================================
     * =================================================================================================================================*/

    /**=====================================================
     *      APPLY EMPLOYEE LEAVE
     * ======================================================*/
    static public function ctlrEmployeeApplyLeave()
    {
        if (isset($_POST['applyEmployeeLeave'])) {
            $employeeId = $_SESSION['empId'];
            $leaveTypeId = $_POST['newLeaveType'];
            $startDate = $_POST['newLeaveStartDate'];
            $endDate = $_POST['newLeaveEndDate'];
            $numberOfDay = $_POST['newLeaveDay'];
            $reason = $_POST['newLeaveReason'];


            // NEW REMAIN LEAVE
            $newRemainLeave = LeaveController::ctlrGetRemainLeave($_SESSION['empId']);


            $applyDate = date("Y-m-d");
            $status = "pending";
            $year = substr($startDate, 0, 4);

            // SENT DATA TO DATABASE
            $table = "leaves";
            $data = [
                ":employee_id" => $employeeId, ":leave_type_id" => $leaveTypeId, ":start_date" => $startDate,
                ":end_date" => $endDate, ":number_of_day" => $numberOfDay, ":reason" => $reason,
                ":remain_leave" => $newRemainLeave, ":year" => $year, ":apply_date" => $applyDate, ":status" => $status
            ];
            $result = ModelLeave::mdlCreateLeave($table, $data);

            // SHOW SUCCESS MASSEGE
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon:'success',
                            title: 'Your Leave Application has been Submited',
                            confirmButtonText:'Close' 
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'apply-leave';
                            }
                        })
                    </script>";
            }
        }
    }

    /**=====================================================
     *      EDIT EMPLOYEE LEAVE
     * ======================================================*/
    static public function ctlrEmployeeEditLeave()
    {
        if (isset($_POST['editEmployeeLeave'])) {
            $id = $_POST['editLeaveId'];
            $employeeId = $_SESSION['empId'];
            $leaveTypeId = $_POST['editLeaveType'];
            $startDate = $_POST['editLeaveStartDate'];
            $endDate = $_POST['editLeaveEndDate'];
            $numberOfDay = $_POST['editLeaveDay'];
            $reason = $_POST['editLeaveReason'];


            // --------------------------------------------------------------
            // ** REMAINING LEAVE DAYS

            $newRemainLeave = LeaveController::ctlrGetRemainLeave($_SESSION['empId']);

            $status = "pending";
            $month = substr($startDate, 5, 2);
            $year = substr($startDate, 0, 4);

            // SENT DATA TO DATABASE
            $table = "leaves";
            $data = [
                ":employee_id" => $employeeId, ":leave_type_id" => $leaveTypeId, ":start_date" => $startDate,
                ":end_date" => $endDate, ":number_of_day" => $numberOfDay, ":reason" => $reason,
                ":remain_leave" => $newRemainLeave, ":year" => $year, ":status" => $status, ":id" => $id
            ];
            $user = "employee";
            $result = ModelLeave::mdlEditLeave($table, $data, $user);
            // SHOW SUCCESS MASSEGE
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon:'success',
                            title: 'Your Leave Application has been Updated',
                            confirmButtonText:'Close' 
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'apply-leave';
                            }
                        })
                    </script>";
            }
        }
    }

    /**=====================================================
     *      SHOW EMPLOYEE LEAVE
     * ======================================================*/
    static public function ctlrShowEmployeeLeave($item1, $value1, $item2, $value2)
    {
        $table = "leaves";
        return ModelLeave::mdlShowEmployeeLeave($table, $item1, $value1, $item2, $value2);
    }


    /**=====================================================
     *      EMPLOYEE DELETE LEAVE
     * ======================================================*/
    static public function ctlrEmployeeDeleteLeave()
    {
        if (isset($_GET['deleteLeave'])) {
            $table = 'leaves';
            $item = "id";
            $value = $_GET['deleteLeave'];

            $result = ModelLeave::mdlDeleteLeave($table, $item, $value);


            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon:'success',
                            title: 'Your Leave Application has been Deleted',
                            confirmButtonText:'Close' 
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'apply-leave';
                            }
                        })
                        </script>";
            }
        }
    }


    /** ================================================================================================================================
     * ====================================================     ADMIN   ================================================================
     * =================================================================================================================================*/

    /**=====================================================
     *      APPLY EMPLOYEE LEAVE
     * ======================================================*/
    static public function ctlrAdminApplyLeave()
    {
        if (isset($_POST['adminAddLeave'])) {
            $employeeId = $_POST['newAdminLeaveEmployee'];
            $leaveTypeId = $_POST['newAdminLeaveType'];
            $startDate = $_POST['newAdminLeaveStartDate'];
            $endDate = $_POST['newAdminLeaveEndDate'];
            $numberOfDay = $_POST['newAdminLeaveDay'];
            $reason = $_POST['newAdminLeaveReason'];
            $status = $_POST['newAdminLeaveStatus'];


            // NEW REMAIN LEAVE
            $newRemainLeave = LeaveController::ctlrGetRemainLeave($employeeId);


            $applyDate = date("Y-m-d");
            $year = substr($startDate, 0, 4);

            // SENT DATA TO DATABASE
            $table = "leaves";
            $data = [
                ":employee_id" => $employeeId, ":leave_type_id" => $leaveTypeId, ":start_date" => $startDate,
                ":end_date" => $endDate, ":number_of_day" => $numberOfDay, ":reason" => $reason,
                ":remain_leave" => $newRemainLeave, ":year" => $year, ":apply_date" => $applyDate, ":status" => $status
            ];
            $result = ModelLeave::mdlCreateLeave($table, $data);

            // SHOW SUCCESS MASSEGE
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon:'success',
                            title: 'Leave Application has been Submited',
                            confirmButtonText:'Close' 
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'view-leave';
                            }
                        })
                    </script>";
            }
        }
    }


    /**=====================================================
     *      SHOW LEAVE
     * ======================================================*/
    static public function ctlrShowLeave($item, $value)
    {
        $table = "leaves";
        return ModelLeave::mdlShowLeave($table, $item, $value);
    }


    /**=====================================================
     *      ADMIN EDIT LEAVE
     * ======================================================*/
    static public function ctlrAdminEditLeave()
    {
        if (isset($_POST['adminEditLeave'])) {
            $id = $_POST['adminEditLeaveId'];
            $leaveTypeId = $_POST['adminEditLeaveType'];
            $startDate = $_POST['adminEditLeaveStartDate'];
            $endDate = $_POST['adminEditLeaveEndDate'];
            $numberOfDay = $_POST['adminEditLeaveDay'];
            $reason = $_POST['adminEditLeaveReason'];
            $status = $_POST['adminEditLeaveStatus'];
            $statusActual = $_POST['adminEditLeaveStatusActual'];
            $year = substr($startDate, 0, 4);

            // REMAINING LEAVE
            $employeeId = $_POST['adminEditLeaveEmpId'];

            $leave = LeaveController::ctlrGetRemainLeave($employeeId);
            // NEW REMAIN LEAVE
            if ($status === 'approved' && $statusActual !== 'approved') {
                $newRemainLeave = $leave - $numberOfDay;
            } elseif ($status !== 'approved' && $statusActual === 'approved') {
                $newRemainLeave = $leave + $numberOfDay;
            } elseif ($status === 'approved' && $statusActual === 'approved') {
                $newRemainLeave = $leave;
            }

            // SEND DATA TO MODEL PAGE
            $table = "leaves";
            $user = "admin";
            $data = [
                ":leave_type_id" => $leaveTypeId, ":start_date" => $startDate,
                ":end_date" => $endDate, ":number_of_day" => $numberOfDay, ":reason" => $reason,
                ":remain_leave" => $newRemainLeave, ":year" => $year, ":status" => $status, ":id" => $id
            ];
            $result = ModelLeave::mdlEditLeave($table, $data, $user);

            // SHOW SUCCESS MASSEGE
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon:'success',
                            title: 'Leave Application has been Updated',
                            confirmButtonText:'Close' 
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'view-leave';
                            }
                        })
                    </script>";
            }
        }
    }


    /**=====================================================
     *      ADMIN APPROVED LEAVE
     * ======================================================*/
    static public function ctlrAdminApprovedLeave($leaveId)
    {
        $table = "leaves";
        $item = "id";
        $value = $leaveId;

        $leave = LeaveController::ctlrShowLeave($item, $value);
        $remainLeave = LeaveController::ctlrGetRemainLeave($leave['employee_id']);

        $newRemainLeave = $leave['status'] === 'approved' ? $remainLeave : $remainLeave - $leave['number_of_day'];

        $status = "approved";

        // SEND DATA TO MODEL PAGE
        $data = [':remain_leave' => $newRemainLeave, ":status" => $status, ":id" => $leaveId];

        $result = ModelLeave::mdlUpdateLeave($table, $data);
        return $result;
    }


    /**=====================================================
     *      ADMIN REJECT LEAVE
     * ======================================================*/
    static public function ctlrAdminRejectLeave($leaveId)
    {
        $table = "leaves";
        $item = "id";
        $value = $leaveId;

        $leave = LeaveController::ctlrShowLeave($item, $value);
        $remainLeave = LeaveController::ctlrGetRemainLeave($leave['employee_id']);

        $newRemainLeave = $leave['status'] === 'approved' ? $remainLeave + $leave['number_of_day'] : $remainLeave;

        $status = "rejected";

        // SEND DATA TO MODEL PAGE
        $data = [':remain_leave' => $newRemainLeave, ":status" => $status, ":id" => $leaveId];

        $result = ModelLeave::mdlUpdateLeave($table, $data);
        return $result;
    }




    /**=====================================================
     *   ADMIN DELETE LEAVE
     * ======================================================*/
    static public function ctlrAdminDeleteLeave()
    {
        if (isset($_GET['deleteLeave'])) {
            $table = 'leaves';
            $item = "id";
            $value = $_GET['deleteLeave'];

            $result = ModelLeave::mdlDeleteLeave($table, $item, $value);


            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon:'success',
                            title: 'Leave Application has been Deleted',
                            confirmButtonText:'Close' 
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'view-leave';
                            }
                        })
                        </script>";
            }
        }
    }
}
