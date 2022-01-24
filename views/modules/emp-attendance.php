 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Attendance</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item active">Admin</li>
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
                         <h3 class="card-title"> Mark Attendance</h3>

                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12">
                                 <div class="alert alert-success" role="alert">
                                     <?php
                                        $item1 = "employee_id";
                                        $value1 = $_SESSION['empId'];
                                        $item2 = "full_date";
                                        $value2 = date("Y-m-d");
                                        $checkAttendance = AttendanceController::ctlrShowOneAttendance($item1, $value1, $item2, $value2);
                                        if ($checkAttendance['clock_in'] != 0) {
                                            echo "You Clock In at " . $checkAttendance['clock_in'];
                                        } else {
                                            echo "Please Clock In";
                                        }
                                        ?>

                                 </div>
                             </div>
                             <!-- CLOCK IN OUT SECTION  -->
                             <div class="col-md-3 col-sm-6 col-12">
                                 <div class="card-body rounded border shadow-sm bg-white ">
                                     <h1 class="card-text text-center fs-2" id="clock"></h1>
                                     <form action="" method="post">
                                         <div class="row justify-content-between mt-3">
                                             <button type="submit" name="attendanceClockIn" class="btn btn-primary">Clock In</button>
                                             <button type="submit" name="attendanceClockOut" class="btn btn-primary">Clock Out</button>
                                         </div>
                                         <?php
                                            $markAttendance = new AttendanceController();
                                            $markAttendance->ctlrAttendanceClockIn();
                                            $markAttendance->ctlrAttendanceClockOut();
                                            ?>
                                     </form>
                                 </div>
                             </div>
                             <div class="col-md-9 col-12 row">

                                 <?php
                                    echo "<input type='hidden' id='dataTableEmployeeId' value='" . $_SESSION['empId'] . "'>";

                                    $item = "employee_id";
                                    $value = $_SESSION['empId'];
                                    $month = null;
                                    $year = NUll;
                                    $order = "ASC";
                                    $monthAttendance = AttendanceController::ctlrShowAllAttendance($item, $value, $month, $year, $order);


                                    if (count($monthAttendance) === 0) {
                                        $markAttendance->ctlrMarkAllAttendance();
                                    }

                                    $currDate = date("Y-m-d");
                                    $present = 0;
                                    $late = 0;
                                    $absent = 0;

                                    for ($i = 0; $i < count($monthAttendance); $i++) {
                                        $data = $monthAttendance[$i];
                                        if ($data['full_date'] > $currDate) continue;

                                        switch ($data['status']) {
                                            case 'present':
                                                $present++;
                                                break;
                                            case 'late':
                                                $present++;
                                                $late++;
                                                break;
                                            case 'absent':
                                                $absent++;
                                                break;
                                        }
                                    }

                                    $hItem = "month_no";
                                    $hValue = date("m");
                                    $holidays = HolidayController::ctlrShowHoliday($hItem, $hValue);
                                    $totalHoliday = 0;
                                    foreach ($holidays as $key => $holiday) {
                                        if ($holiday['holiday_date'] <= $currDate) $totalHoliday++;
                                    }

                                    $workingDays = date("d");


                                    ?>

                                 <!-- TOTAL WORKING DAY SECTION -->
                                 <div class="col-md-3 col-sm-6 col-12">
                                     <div class="info-box bg-info">
                                         <span class="info-box-icon"><i class="fas fa-clock"></i></span>

                                         <div class="info-box-content">
                                             <span class="info-box-text">Total Working Days</span>
                                             <span class="info-box-number"><?php echo $workingDays ?></span>
                                         </div>
                                         <!-- /.info-box-content -->
                                     </div>
                                     <!-- /.info-box -->
                                 </div>

                                 <!-- TOTAL PRESENT SECTION -->
                                 <div class="col-md-3 col-sm-6 col-12">
                                     <div class="info-box bg-success">
                                         <span class="info-box-icon"><i class="fas fa-check"></i></span>

                                         <div class="info-box-content">
                                             <span class="info-box-text">Total Present</span>
                                             <span class="info-box-number"><?php echo $present ?></span>
                                         </div>
                                         <!-- /.info-box-content -->
                                     </div>
                                     <!-- /.info-box -->
                                 </div>

                                 <!-- TOTAL LATE SECTION -->
                                 <div class="col-md-3 col-sm-6 col-12">
                                     <div class="info-box bg-warning">
                                         <span class="info-box-icon"><i class="fas fa-check"></i></span>

                                         <div class="info-box-content">
                                             <span class="info-box-text">Late</span>
                                             <span class="info-box-number"><?php echo $late ?></span>
                                         </div>
                                         <!-- /.info-box-content -->
                                     </div>
                                     <!-- /.info-box -->
                                 </div>

                                 <!-- TOTAL ABSENT SECTION -->
                                 <div class="col-md-3 col-sm-6 col-12">
                                     <div class="info-box bg-danger">
                                         <span class="info-box-icon"><i class="fas fa-times"></i></span>

                                         <div class="info-box-content">
                                             <span class="info-box-text">Absent</span>
                                             <span class="info-box-number"><?php echo $absent ?></span>
                                         </div>
                                         <!-- /.info-box-content -->
                                     </div>
                                     <!-- /.info-box -->
                                 </div>
                                 <div class="col-md-3 col-sm-6 col-12">
                                     <div class="info-box bg-primary">
                                         <span class="info-box-icon"><i class="fas fa-star"></i></span>

                                         <div class="info-box-content">
                                             <span class="info-box-text">Holidays</span>
                                             <span class="info-box-number"><?php echo $totalHoliday ?></span>
                                         </div>
                                         <!-- /.info-box-content -->
                                     </div>
                                     <!-- /.info-box -->
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>


             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title">View Attendance</h3>
                     </div>
                     <div class="card-body">
                         <table class="table  empAttendanceTable">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Date</th>
                                     <th>Clock In</th>
                                     <th>Clock Out</th>
                                     <th>Status</th>
                                     <th>Day</th>
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