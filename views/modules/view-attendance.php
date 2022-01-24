 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Admin</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item active">view Attendnace</li>
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

                     <div class="card-body">
                         <div class="row">
                             <div class="col-3">
                                 <div class="form-group">
                                     <label for="">Employee</label>
                                     <select name="" id="attOvEmployee" class="form-control select2">
                                         <option value="0" selected disabled>-- Select Employee --</option>
                                         <?php
                                            $item = NULL;
                                            $value = NULL;
                                            $employees = EmployeesController::ctlrShowEmployees($item, $value);
                                            foreach ($employees as $key => $employee) {
                                                echo "<option value='" . $employee['id'] . "'> " . $employee['name'] . " (" . $employee['code'] . ")</option>";
                                            }
                                            ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-3">
                                 <div class="form-group">
                                     <label for="">Month</label>
                                     <select name="" id="attOvMonth" class="form-control">
                                         <!-- <option value="" selected>-- Select Month --</option> -->
                                         <?php
                                            $currMonth = date("m");
                                            $months = [
                                                "January", "February", "March", "April", "May", "June", "July",
                                                "August", "September", "October", "November", "December"
                                            ];
                                            foreach ($months as $key => $month) {
                                                if (($key + 1) == $currMonth) {
                                                    echo "<option value='" . ($key + 1) . "' selected> " . $month . "</option>";
                                                } else {
                                                    echo "<option value='" . ($key + 1) . "'> " . $month . "</option>";
                                                }
                                            }
                                            ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-3">
                                 <div class="form-group">
                                     <label for="">Year</label>
                                     <select name="" id="attOvYear" class="form-control">
                                         <?php
                                            $year = date("Y");
                                            $currYear = $year;
                                            // $year += 4;
                                            for ($i = 0; $i < 5; $i++) {
                                                $y = $year - $i;
                                                if ($y == $currYear) {
                                                    echo "<option value='$y' selected>$y</option>";
                                                } else {
                                                    echo "<option value='$y'>$y</option>";
                                                }
                                                // echo $i;
                                            }
                                            ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-3">
                                 <div class="form-group">
                                     <label class="invisible" for="">Search</label>
                                     <button id="attOvSubmit" class="btn btn-success btn-block">Search</button>
                                 </div>
                             </div>
                         </div>



                     </div>
                     <!-- /.card-body -->

                 </div>
             </div>
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <h5 class="card-title">Attendance List</h5>
                     </div>
                     <div class="card-body">
                         <table class="table  table-striped viewAttendance">
                             <thead>
                                 <?php
                                    $item = NULL;
                                    $value = NULL;
                                    $leaveTypes = LeaveTypeController::ctlrShowLeaveType($item, $value);
                                    ?>
                                 <tr>
                                     <th rowspan="2">Code</th>
                                     <th rowspan="2">Employee </th>
                                     <th rowspan="2">Last Absent </th>
                                     <th colspan="<?php echo count($leaveTypes) ?>" class="text-center">Leaves</th>
                                     <th rowspan="2">Total Leave</th>
                                     <th rowspan="2">Status</th>
                                     <th rowspan="2">Action</th>
                                 </tr>
                                 <tr>
                                     <?php
                                        foreach ($leaveTypes as $key => $leaveType) {
                                            echo "<th>" . $leaveType['type'] . " </th>";
                                        }
                                        ?>
                                 </tr>
                             </thead>
                             <tbody>

                             </tbody>
                         </table>
                     </div>
                     <!-- /.card-body -->

                 </div>
                 <!-- /.card -->
             </div>
         </div>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->