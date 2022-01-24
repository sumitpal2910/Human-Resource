 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Calender Overview</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item active">Calender Overview</li>
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
                         <h5 class="card-title">Overview</h5>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-3">
                                 <div class="form-group">
                                     <label for="">Employee</label>
                                     <select name="" id="attCalEmployee" class="form-control select2">
                                         <option value="0" selected disabled>-- Select Employee --</option>
                                         <?php
                                            $item = NULL;
                                            $value = NULL;
                                            $employees = EmployeesController::ctlrShowEmployees($item, $value);
                                            foreach ($employees as $key => $employee) {
                                                if (isset($_GET['view-employee'])) {
                                                    if ($employee['id'] == $_GET['view-employee']) {
                                                        echo "<option value='" . $employee['id'] . "' selected> " . $employee['name'] . " (" . $employee['code'] . ")</option>";
                                                    }
                                                }
                                                echo "<option value='" . $employee['id'] . "'> " . $employee['name'] . " (" . $employee['code'] . ")</option>";
                                            }
                                            ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-3">
                                 <div class="form-group">
                                     <label for="">Month</label>
                                     <select name="" id="attCalMonth" class="form-control">
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
                                     <select name="" id="attCalYear" class="form-control">
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
                                     <button id="attCalSubmit" class="btn btn-success btn-block">Search</button>
                                 </div>
                             </div>
                         </div>

                         <!-- MONTH OVERVIEW -->
                         <div class="row">

                             <!-- TOTAL WORKING DAY SECTION -->
                             <div class="col-md-2 col-sm-4 col-6">
                                 <div class="info-box bg-info">
                                     <span class="info-box-icon"><i class="fas fa-clock"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Total Working Days</span>
                                         <span class="info-box-number" id="attCalWorkingDay"></span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>

                             <!-- TOTAL PRESENT SECTION -->
                             <div class="col-md-2 col-sm-4 col-6">
                                 <div class="info-box bg-success">
                                     <span class="info-box-icon"><i class="fas fa-check"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Total Present</span>
                                         <span class="info-box-number" id="attCalPresent"></span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>

                             <!-- TOTAL LATE SECTION -->
                             <div class="col-md-2 col-sm-4 col-6">
                                 <div class="info-box bg-warning">
                                     <span class="info-box-icon"><i class="fas fa-check"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Late</span>
                                         <span class="info-box-number" id="attCalLate"></span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>

                             <!-- TOTAL ABSENT SECTION -->
                             <div class="col-md-2 col-sm-4 col-6">
                                 <div class="info-box bg-danger">
                                     <span class="info-box-icon"><i class="fas fa-times"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Absent</span>
                                         <span class="info-box-number" id="attCalAbsent"></span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>

                             <!-- HOLIDAYS -->
                             <div class="col-md-2 col-sm-4 col-6">
                                 <div class="info-box bg-primary">
                                     <span class="info-box-icon"><i class="fas fa-star"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Holidays</span>
                                         <span class="info-box-number" id="attCalHoliday"></span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>

                             <!-- LEAVES -->
                             <div class="col-md-2 col-sm-4 col-6">
                                 <div class="info-box bg-info">
                                     <span class="info-box-icon"><i class="fas fa-paper-plane"></i></span>

                                     <div class="info-box-content">
                                         <span class="info-box-text">Leaves</span>
                                         <span class="info-box-number" id="attCalLeave"></span>
                                     </div>
                                     <!-- /.info-box-content -->
                                 </div>
                                 <!-- /.info-box -->
                             </div>
                         </div>

                     </div>
                     <!-- /.card-body -->

                 </div>
             </div>
             <!-- /.card -->

             <!-- CALENDER CARD START -->
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <h5 class="card-title">Calender Overview</h5>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-1"></div>
                             <div class="col-9">
                                 <div id="calendar" class="border border-primary"></div>
                             </div>
                             <div class="col-2">

                                 <ul class="list-unstyled mt-5 pt-5">
                                     <li class=" ">
                                         <h3> <i class="fas fa-square text-white border "></i> &nbsp; Present</h5>
                                     </li>
                                     <li class="text-primary">
                                         <h3> <i class="fas fa-square"></i> &nbsp; Holiday</h5>
                                     </li>
                                     <li class="text-danger">
                                         <h3> <i class="fas fa-square"></i> &nbsp; Absent</h5>
                                     </li>
                                     <li class="text-warning">
                                         <h3> <i class="fas fa-square"></i> &nbsp; Late</h5>
                                     </li>
                                     <li class="text-info">
                                         <h3> <i class="fas fa-square"></i> &nbsp; Leave</h5>
                                     </li>

                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->