 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Dashboard</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">Dashboard</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">

         <?php
            $totalEmployee = 0;
            $present = 0;
            $absent = 0;
            $onLeave = 0;

            $currDate = date("Y-m-d");

            $item = NULL;
            $value = NULL;
            $employees = EmployeesController::ctlrShowEmployees($item, $value);
            foreach ($employees as $key => $employee) {
                if ($employee['status'] == 1) {
                    $totalEmployee++;

                    $item1 = "employee_id";
                    $value1 = $employee['id'];
                    $item2 = "full_date";
                    $value2 = $currDate;
                    $attendance = AttendanceController::ctlrShowOneAttendance($item1, $value1, $item2, $value2);
                    if ($attendance['clock_in'] != 0 || !$attendance['clock_in']) {
                        $present++;
                    } else {
                        $absent++;
                        $hItem1 = "employee_id";
                        $hValue1 = $employee['id'];
                        $hItem2 = NULL;
                        $hValue2 = NULL;
                        $leaves = LeaveController::ctlrShowEmployeeLeave($hItem1, $hValue1, $hItem2, $hValue2);

                        if ($leaves) {
                            foreach ($leaves as $key => $leave) {
                                if ($leave['status'] === 'approved') {
                                    if ($leave['start_date'] >= $currDate && $currDate <= $leave['end_date']) {
                                        $onLeave++;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $absent = $absent - $onLeave;
            ?>

         <div class="row">
             <!-- TOTAL EMPLOYEE -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-info">
                     <div class="inner">
                         <h3><?php echo $totalEmployee; ?></h3>
                         <p>Total Employee</p>
                     </div>
                     <div class="icon"><i class="fas fa-users"></i></div>
                     <a href="employees" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <!-- PRESENT -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-success">
                     <div class="inner">
                         <h3><?php echo $present ?></h3>
                         <p>Present</p>
                     </div>
                     <div class="icon"><i class="fas fa-check"></i></div>
                     <a href="attendance-list" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <!-- ABSENT -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-danger">
                     <div class="inner">
                         <h3><?php echo $absent ?></h3>
                         <p>Absent</p>
                     </div>
                     <div class="icon"><i class="fas fa-check"></i></div>
                     <a href="attendance-list" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

             <!-- HOLIDAY -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-primary">
                     <div class="inner">
                         <h3><?php echo $onLeave ?></h3>
                         <p>On Leave</p>
                     </div>
                     <div class="icon"><i class="fas fa-check"></i></div>
                     <a href="view-leave" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
         </div>

         <!-- expenses graph -->
         <?php
            include "views/modules/charts/expense-chart.php";
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->