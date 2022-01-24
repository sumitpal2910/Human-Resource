 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>View Leave</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item active">View Leave</li>
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
                         <button class="btn btn-success" data-toggle="modal" data-target="#modalAddLeave">Add Leave <i class="fas fa-plus"></i></button>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <?php
                                $item = NULL;
                                $value = NULL;

                                // LEAVE TYPE
                                $totalLeave = 0;
                                $leaveTypes = LeaveTypeController::ctlrShowLeaveType($item, $value);
                                foreach ($leaveTypes as $key => $leaveType) {
                                    $totalLeave += $leaveType['number_of_day'];
                                }

                                // LEAVES
                                $currDate = date("Y-m-d");
                                $pendingLeave = 0;
                                $plannedLeave = 0;
                                $leaves = LeaveController::ctlrShowLeave($item, $value);
                                foreach ($leaves as $key => $leave) {
                                    if ($leave['status'] === 'pending') {
                                        $pendingLeave++;
                                    }

                                    if ($leave['status'] === 'approved') {
                                        if ($currDate <= $leave['start_date'] || $currDate >= $leave['end_date']) {
                                            $plannedLeave++;
                                        }
                                    }
                                }

                                $usedLeave = 0;
                                if ($leaves) {
                                    foreach ($leaves as $key => $leave) {
                                        if ($leave['status'] === 'approved') {
                                            $usedLeave += $leave['number_of_day'];
                                        }
                                    }
                                }
                                $remainLeave =  LeaveController::ctlrGetRemainLeave($_SESSION['empId']);

                                ?>
                             <!-- TOTAL LEAVE -->
                             <div class="col-md-3 col-sm-6 col-12">
                                 <div class="info-box bg-info">
                                     <div class="info-box-content text-center">
                                         <h4 class="info-box-text"> Total Leave <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalShowLeaveType"> <i class="fas fa-eye"></i></button> </h4>
                                         <h5 class="info-box-number"><?php echo $totalLeave ?></h5>
                                     </div>
                                 </div>
                             </div>

                             <!-- USED LEAVE -->
                             <div class="col-md-3 col-sm-6 col-12">
                                 <div class="info-box bg-warning">
                                     <div class="info-box-content text-center">
                                         <h4 class="info-box-text"> Pending Request </h4>
                                         <h5 class="info-box-number"><?php echo $pendingLeave ?></h5>
                                     </div>
                                 </div>
                             </div>

                             <!-- REMAINING LEAVE -->
                             <div class="col-md-3 col-sm-6 col-12">
                                 <div class="info-box bg-success">
                                     <div class="info-box-content text-center">
                                         <h4 class="info-box-text"> Planned Leave </h4>
                                         <h5 class="info-box-number"><?php echo $plannedLeave ?></h5>
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
                         <table class="table table-striped showLeaveTable" style="width:100%">
                             <thead>
                                 <tr>
                                     <th width="5%">Emp Id</th>
                                     <th>Employee </th>
                                     <th>Leave</th>
                                     <th>From</th>
                                     <th>To</th>
                                     <th>Days</th>
                                     <th>Reason</th>
                                     <th>Apply Date</th>
                                     <th>Status</th>
                                     <th width="15%">Action</th>
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
 <div class="modal fade" id="modalShowLeaveType">
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
 <div class="modal fade" id="modalAddLeave">
     <div class="modal-dialog">
         <div class="modal-content">
             <form action="" method="post">
                 <div class="modal-header">
                     <h4 class="modal-title">Apply Leave</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <!-- EMPLOYEE NAME -->
                     <div class="form-group">
                         <label for="">Employee <sup>&starf;</sup></label>
                         <select name="newAdminLeaveEmployee" id="newAdminLeaveEmployee" class="form-control select2" required>
                             <option value="" selected disabled>Select Employee</option>
                             <?php
                                $item = NULL;
                                $value = NULL;
                                $employees = EmployeesController::ctlrShowEmployees($item, $value);
                                foreach ($employees as $key => $employee) {
                                    echo "<option value='" . $employee['id'] . "'>" . $employee['name'] . " (" . $employee['code'] . ") </option>";
                                }
                                ?>
                         </select>
                     </div>

                     <!-- LEAVE TYPE -->
                     <div class="form-group">
                         <label for="">Leave Type <sup>&starf;</sup></label>
                         <select name="newAdminLeaveType" id="" class="form-control" required>
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
                         <input type="date" name="newAdminLeaveStartDate" class="form-control leaveStartDate" required>
                     </div>
                     <!-- END DATE -->
                     <div class="form-group">
                         <label for="">To <sup>&starf;</sup></label>
                         <input type="date" name="newAdminLeaveEndDate" class="form-control leaveEndDate" required>
                     </div>

                     <!-- NUMBER OF DAY -->
                     <div class="form-group">
                         <label for="">Number Of Day </label>
                         <input type="text" name="newAdminLeaveDay" class="form-control leaveDay" value="0" readonly required>
                     </div>

                     <!-- NUMBER OF DAY -->
                     <div class="form-group">
                         <label for="">Remaining Leave </label>
                         <input type="text" name="newAdminLeaveRemain" id="newAdminLeaveRemain" class="form-control" readonly value="0">
                     </div>

                     <!-- STATUS -->
                     <div class="form-group">
                         <label for="">Status <sup>&starf;</sup> </label>
                         <select name="newAdminLeaveStatus" id="newAdminLeaveStatus" class="form-control" required>
                             <option value="approved" selected>Approved</option>
                             <option value="rejected">Rejected</option>
                             <option value="pending">Pending</option>
                         </select>
                     </div>

                     <!-- LEAVE REASON -->
                     <div class="form-group">
                         <label for="">Reason <sup>&starf;</sup></label>
                         <textarea name="newAdminLeaveReason" class="form-control" cols="20" rows="5" placeholder="Enter a Leave Reason" required></textarea>
                     </div>
                 </div>
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                     <button type="submit" name="adminAddLeave" class="btn btn-primary">Apply Leave</button>
                 </div>
                 <?php
                    $applyLeave = new LeaveController();
                    $applyLeave->ctlrAdminApplyLeave();
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
 <div class="modal fade" id="modalEditLeave">
     <div class="modal-dialog">
         <div class="modal-content">
             <form action="" method="post">
                 <div class="modal-header">
                     <h4 class="modal-title" id="editLeaveStatus">Edit Leave </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <!-- EMPLOYEE NAME -->
                     <div class="form-group">
                         <input type="hidden" id="adminEditLeaveId" name="adminEditLeaveId">
                         <label for="">Employee </label>
                         <input name="adminEditLeaveEmployee" id="adminEditLeaveEmployee" class="form-control" readonly>
                         <input type="hidden" name="adminEditLeaveEmpId" id="adminEditLeaveEmpId">

                     </div>

                     <!-- LEAVE TYPE -->
                     <div class="form-group">
                         <label for="">Leave Type <sup>&starf;</sup></label>
                         <select name="adminEditLeaveType" id="adminEditLeaveType" class="form-control" required>
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
                         <input type="date" name="adminEditLeaveStartDate" id="adminEditLeaveStartDate" class="form-control leaveStartDate" required>
                     </div>
                     <!-- END DATE -->
                     <div class="form-group">
                         <label for="">To <sup>&starf;</sup></label>
                         <input type="date" name="adminEditLeaveEndDate" id="adminEditLeaveEndDate" class="form-control leaveEndDate" required>
                     </div>

                     <!-- NUMBER OF DAY -->
                     <div class="form-group">
                         <label for="">Number Of Day</label>
                         <input type="text" name="adminEditLeaveDay" id="adminEditLeaveDay" class="form-control leaveDay" value="0" readonly required>
                     </div>

                     <!-- NUMBER OF DAY -->
                     <div class="form-group">
                         <label for="">Remaining Leave</label>
                         <input type="text" name="adminEditLeaveRemain" id="adminEditLeaveRemain" class="form-control" readonly>
                     </div>

                     <!-- STATUS -->
                     <div class="form-group">
                         <label for="">Status <sup>&starf;</sup> </label>
                         <select name="adminEditLeaveStatus" id="adminEditLeaveStatus" class="form-control" required>
                             <option value="approved">Approved</option>
                             <option value="rejected">Rejected</option>
                             <option value="pending">Pending</option>
                         </select>
                         <input type="hidden" id="adminEditLeaveStatusActual" name="adminEditLeaveStatusActual">
                     </div>

                     <!-- LEAVE REASON -->
                     <div class="form-group">
                         <label for="">Reason <sup>&starf;</sup></label>
                         <textarea name="adminEditLeaveReason" id="adminEditLeaveReason" class="form-control" cols="20" rows="5" placeholder="Enter a Leave Reason" required></textarea>
                     </div>

                     <!-- APPLY DATE -->
                     <div class="form-group">
                         <label for="">Apply Date </label>
                         <input name="" id="adminEditLeaveApplyDate" class="form-control" readonly>
                     </div>
                 </div>
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                     <button type="submit" name="adminEditLeave" id="adminEditLeave" class="btn btn-primary">Update Leave</button>
                 </div>
                 <?php
                    $editLeave = new LeaveController();
                    $editLeave->ctlrAdminEditLeave();
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
    $deleteLeave->ctlrAdminDeleteLeave();
    ?>