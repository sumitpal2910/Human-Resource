<?php

class LeaveTypeController
{
    /*=============================================
    *     CREATE LEAVE TYPE
    =============================================== */
    static public function ctlrCreateLeaveType()
    {
        if (isset($_POST['createLeaveType'])) {
            $type = $_POST['newLeaveType'];
            $numberOfDays = $_POST['newLeaveTypeDays'];

            $table = "leave_types";
            $data = [":type" => $type, ":number_of_day" => $numberOfDays];

            $result = ModelLeaveType::mdlCreateLeaveType($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Leave Type $type has been Created',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'leave-types';
                            }
                        })
                </script>";
            }
        }
    }

    /*=============================================
    *     SHOW LEAVE TYPE
    =============================================== */
    static public function ctlrShowLeaveType($item, $value)
    {
        $table = "leave_types";
        return ModelLeaveType::mdlShowLeaveType($table, $item, $value);
    }

    /*=============================================
    *     EDIT LEAVE TYPE
    =============================================== */
    static public function ctlrEditLeaveType()
    {
        if (isset($_POST['updateLeaveType'])) {
            $id = $_POST['editLeaveTypeId'];
            $type = $_POST['editLeaveType'];
            $numberOfDays = $_POST['editLeaveTypeDays'];

            $table = "leave_types";
            $data = [":type" => $type, ":number_of_day" => $numberOfDays, ":id" => $id];
            $result = ModelLeaveType::mdlEditLeaveType($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Leave Type $type has been Updated',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'leave-types';
                            }
                        })
                </script>";
            }
        }
    }


    /*=============================================
    *     DELETE LEAVE TYPE
    =============================================== */
    static public function ctlrDeleteLeaveType()
    {
        if (isset($_GET['deleteLeaveType'])) {
            $table = "leave_types";
            $item = "id";
            $value = $_GET['deleteLeaveType'];

            $result = ModelLeaveType::mdlDeleteLeaveType($table, $item, $value);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Leave Type has been Delete',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'leave-types';
                            }
                        })
                </script>";
            }
        }
    }


    /*=============================================
    *     TOTAL LEAVE DAYS
    =============================================== */
    static public function ctlrGetTotalLeave()
    {
        $item = NULL;
        $value = NULL;
        $leaveTypes = LeaveTypeController::ctlrShowLeaveType($item, $value);
        $totalLeave = 0;
        foreach ($leaveTypes as $key => $leaveType) {
            $totalLeave += $leaveType['number_of_day'];
        }
        return $totalLeave;
    }
}
