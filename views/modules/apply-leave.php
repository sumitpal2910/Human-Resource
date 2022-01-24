 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Leave</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item active">Leave</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <button class="btn btn-success" data-toggle="modal" data-target="#modalAddEmployeeLeave">Apply Leave &nbsp; <i class="fas fa-plus"></i></button>

                     </div>
                     <div class="card-body">
                         <div class="row">
                             <?php
                                $item = NULL;
                                $value = NULL;
                                $leaveTypes = LeaveTypeController::ctlrShowLeaveType($item, $value);

                                $totalLeave = 0;
                                foreach ($leaveTypes as $key => $leaveType) {
                                    $totalLeave += $leaveType['number_of_day'];
                                }

                                $item1 = "employee_id";
                                $value1 = $_SESSION['empId'];
                                $item2 = NULL;
                                $value2 = NULL;
                                $leaves = LeaveController::ctlrShowEmployeeLeave($item1, $value1, $item2, $value2);
                                // var_dump($leaves);

                                $usedLeave = 0;
                                $remainLeave = 0;
                                if ($leaves) {
                                    foreach ($leaves as $key => $leave) {
                                        if ($leave['status'] === 'approved') {
                                            $usedLeave += $leave['number_of_day'];
                                        }
                                    }
                                    $remainLeave = LeaveController::ctlrGetRemainLeave($_SESSION['empId']);
                                } else {
                                    $remainLeave = $totalLeave;
                                }
                                ?>
                             <!-- TOTAL LEAVE -->
                             <div class="col-md-3 col-sm-6 col-12">
                                 <div class="info-box bg-info">
                                     <div class="info-box-content text-center">
                                         <h4 class="info-box-text"> Total Leave <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalEmpShowLeaveType"> <i class="fas fa-eye"></i></button> </h4>
                                         <h5 class="info-box-number"><?php echo $totalLeave ?></h5>
                                     </div>
                                 </div>
                             </div>

                             <!-- USED LEAVE -->
                             <div class="col-md-3 col-sm-6 col-12">
                                 <div class="info-box bg-warning">
                                     <div class="info-box-content text-center">
                                         <h4 class="info-box-text"> Used Leave </h4>
                                         <h5 class="info-box-number"><?php echo $usedLeave ?></h5>
                                     </div>
                                 </div>
                             </div>

                             <!-- REMAINING LEAVE -->
                             <div class="col-md-3 col-sm-6 col-12">
                                 <div class="info-box bg-success">
                                     <div class="info-box-content text-center">
                                         <h4 class="info-box-text"> Remaining Leave </h4>
                                         <h5 class="info-box-number"><?php echo $remainLeave ?></h5>
                                     </div>
                                 </div>
                             </div>


                         </div>
                     </div>
                 </div>
             </div>
             <!-- SHOW LEAVE TABLE -->
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <h4 class="card-title">View Leave</h4>
                     </div>
                     <div class="card-body">
                         <input type="hidden" id="employeeId" value="<?php echo $_SESSION['empId'] ?>">
                         <table class="table employeeLeaveTable" style="width: 100%;">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Leave Type</th>
                                     <th>From</th>
                                     <th>To</th>
                                     <th>Days</th>
                                     <th>Reason</th>
                                     <th>Status</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <!-- <tbody></tbody> -->
                         </table>
                     </div>
                 </div>
             </div>

         </div>

     </section>
 </div>

 <!-- ===========================================================
        MODAL SHOW ALL LEAVE TYPE 
====================================================================== -->
 <div class="modal fade" id="modalEmpShowLeaveType">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Leave Type</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 <?php
                    $item = NULL;
                    $value = NULL;
                    $leaveTypes = LeaveTypeController::ctlrShowLeaveType($item, $value);
                    foreach ($leaveTypes as $key => $leaveType) {
                        echo "<div class='row'>
                                <div class='col-4 text-right mb-3'>" . $leaveType['type'] . "  </div>
                                <div class='col-4'></div>
                                <div class='col-4'>" . $leaveType['number_of_day'] . "</div>
                            </div>";
                    }
                    ?>
             </div>
         </div>
     </div>
 </div>


 <!-- ===========================================================
        APPLY LEAVE MODAL
====================================================================== -->
 <div class="modal fade" id="modalAddEmployeeLeave">
     <div class="modal-dialog">
         <div class="modal-content">
             <form action="" method="post">
                 <div class="modal-header">
                     <h4 class="modal-title">Apply Leave</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <!-- LEAVE TYPE -->
                     <div class="form-group">
                         <label for="">Leave Type <sup>&starf;</sup></label>
                         <select name="newLeaveType" id="" class="form-control" required>
                             <option value="" disabled selected>Select Leave Type</option>
                             <?php
                                foreach ($leaveTypes as $key => $leaveType) {
                                    echo "<option value='" . $leaveType['id'] . "'>" . $leaveType['type'] . "</option>";
                                }
                                ?>
                         </select>
                     </div>
                     <!-- START DATE -->
                     <div class="form-group leaveDateDiv">
                         <label for="">From <sup>&starf;</sup></label>
                         <input type="date" name="newLeaveStartDate" class="form-control leaveStartDate" required>
                     </div>
                     <!-- END DATE -->
                     <div class="form-group">
                         <label for="">To <sup>&starf;</sup></label>
                         <input type="date" name="newLeaveEndDate" class="form-control leaveEndDate" required>
                     </div>

                     <!-- NUMBER OF DAY -->
                     <div class="form-group">
                         <label for="">Number Of Day </label>
                         <input type="text" name="newLeaveDay" class="form-control leaveDay" value="0" readonly required>
                     </div>

                     <!-- NUMBER OF DAY -->
                     <div class="form-group">
                         <label for="">Remaining Leave </label>
                         <input type="text" name="newLeaveRemain" id="" class="form-control" readonly required value="<?php echo $remainLeave ?>">
                     </div>

                     <!-- LEAVE REASON -->
                     <div class="form-group">
                         <label for="">Reason <sup>&starf;</sup></label>
                         <textarea name="newLeaveReason" class="form-control" cols="20" rows="5" placeholder="Enter a Leave Reason" required></textarea>
                     </div>
                 </div>
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                     <button type="submit" name="applyEmployeeLeave" class="btn btn-primary">Apply Leave</button>
                 </div>
                 <?php
                    $applyLeave = new LeaveController();
                    $applyLeave->ctlrEmployeeApplyLeave();
                    ?>
             </form>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


 <!-- ===========================================================
        EDIT LEAVE MODAL
====================================================================== -->
 <div class="modal fade" id="modalEditEmployeeLeave">
     <div class="modal-dialog">
         <div class="modal-content">
             <form action="" method="post">
                 <div class="modal-header">
                     <h4 class="modal-title" id="editLeaveStatus">Edit Leave </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <!-- LEAVE TYPE -->
                     <div class="form-group">
                         <input type="hidden" id="editLeaveId" name="editLeaveId">
                         <label for="">Leave Type <sup>&starf;</sup></label>
                         <select name="editLeaveType" id="editLeaveType" class="form-control" required>
                             <?php
                                foreach ($leaveTypes as $key => $leaveType) {
                                    echo "<option value='" . $leaveType['id'] . "'>" . $leaveType['type'] . "</option>";
                                }
                                ?>
                         </select>
                     </div>
                     <!-- START DATE -->
                     <div class="form-group leaveDateDiv">
                         <label for="">From <sup>&starf;</sup></label>
                         <input type="date" name="editLeaveStartDate" id="editLeaveStartDate" class="form-control leaveStartDate" required>
                     </div>
                     <!-- END DATE -->
                     <div class="form-group">
                         <label for="">To <sup>&starf;</sup></label>
                         <input type="date" name="editLeaveEndDate" id="editLeaveEndDate" class="form-control leaveEndDate" required>
                     </div>

                     <!-- NUMBER OF DAY -->
                     <div class="form-group">
                         <label for="">Number Of Day</label>
                         <input type="text" name="editLeaveDay" id="editLeaveDay" class="form-control leaveDay" value="0" readonly required>
                     </div>

                     <!-- NUMBER OF DAY -->
                     <div class="form-group">
                         <label for="">Remaining Leave</label>
                         <input type="text" name="editLeaveRemain" id="editLeaveRemain" class="form-control" readonly value="<?php echo $remainLeave ?>">
                     </div>

                     <!-- LEAVE REASON -->
                     <div class="form-group">
                         <label for="">Reason <sup>&starf;</sup></label>
                         <textarea name="editLeaveReason" id="editLeaveReason" class="form-control" cols="20" rows="5" placeholder="Enter a Leave Reason" required></textarea>
                     </div>
                 </div>
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                     <button type="submit" name="editEmployeeLeave" id="editEmployeeLeave" class="btn btn-primary">Update Leave</button>
                 </div>
                 <?php
                    $editLeave = new LeaveController();
                    $editLeave->ctlrEmployeeEditLeave();
                    ?>
             </form>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>

 <!-- DELETE LEAVE -->
 <?php
    $deleteLeave = new LeaveController();
    $deleteLeave->ctlrEmployeeDeleteLeave();
    ?>