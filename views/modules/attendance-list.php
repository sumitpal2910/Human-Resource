 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>View Attendance</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">View Attendance</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">

         <div class="col-12">
             <div class="card">
                 <div class="card-header">
                     <h3 class="card-title">View Attendance</h3>
                 </div>
                 <div class="card-body">
                     <table class="table attendanceList">
                         <thead>
                             <tr>
                                 <th width="150px">Employee</th>
                                 <?php
                                    $numOfDay = date("d");
                                    for ($i = 1; $i <= $numOfDay; $i++) {
                                        echo "<th width='25px'>$i</th>";
                                    }
                                    ?>
                                 <th width="50px">Total</th>
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

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <!-- SHOW ATTENDANCE -->
 <div class="modal fade" id="modalShowAttendance">
     <div class="modal-dialog">
         <div class="modal-content bg-white">
             <div class="modal-header">
                 <h4 class="modal-title">Attendance Details</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 <div class="row ">
                     <div class="col-4 mt-5 text-center">
                         <h5 id="clockInTime"></h5>
                         Clock In
                     </div>
                     <div class="col-4">
                         <svg width="150px" height="150px" class="d-flex">
                             <circle r="50" cx="75" cy="75" fill="transparent" stroke="#f3f3f3" stroke-width="7"></circle>
                             <circle id="workingHourCircle" r="50" cx="75" cy="75" fill="transparent" stroke="green" stroke-width="7" stroke-dasharray="630" stroke-dashoffset="0" transform="rotate(-90, 75,75 )"></circle>
                         </svg>
                         <h6 id="workingHours" style="position: relative; top:-50%; left:25%; ">8 Hours</h6>
                     </div>
                     <div class="col-4 mt-5 text-center">
                         <h5 id="clockOutTime"></h5>
                         Clock Out
                     </div>
                     <div class="col-12 text-center">
                         <h4 id="stillWorkingText" class="d-none">Still Working...</h4>
                     </div>
                 </div>
             </div>
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-outline-light">Save changes</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>
 <script>

 </script>