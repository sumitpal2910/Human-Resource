 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Holiday</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item active">Holiday</li>
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
                     <div class="card-header row">
                         <button class="btn btn-success" data-toggle="modal" data-target="#modalAddHoliday"> Add New Holiday &nbsp; <i class="fas fa-plus"></i></button>
                         <?php
                            $item = NULL;
                            $value = NULL;
                            $holidaySunday = HolidayController::ctlrShowHoliday($item, $value);
                            $sunday = 0;
                            foreach ($holidaySunday as $key => $value) {
                                if ($value['day'] == 'Sunday') {
                                    $sunday  = $sunday + 1;
                                }
                            }
                            if ($sunday < 20) {
                                echo '<form action="" method="post">
                                        <button type="submit" name="sundayHoliday" class="btn btn-success ml-5">Mark All Sunday to Holiday <i class="fas fa-plus"></i></button>
                                     </form>';
                            }

                            $allSunday = new HolidayController();
                            $allSunday->ctlrMarkSundayHoliday();
                            ?>

                     </div>
                     <div class="card-body">

                         <div class="row">
                             <div class=" col-sm-3 col-xs-12">
                                 <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">

                                     <?php
                                        $mnt = intval(date("m") - 1);
                                        $months = [
                                            "January", "Febuary", "March", "April", "May", "June", "July",
                                            "August", "September", "October", "November", "December"
                                        ];
                                        $monthName;
                                        for ($i = 0; $i < count($months); $i++) {
                                            $mon = $months[$i];
                                            if ($i == $mnt) {
                                                echo "<a class='nav-link active holidayMonth' month='" . ($i + 1) . "' id='$mon-tab' data-toggle='pill' href='#$mon' role='tab' aria-controls='$mon' aria-selected='false'>$mon</a>";
                                            } else {
                                                echo "<a class='nav-link holidayMonth' month='" . ($i + 1)  . "' id='$mon-tab' data-toggle='pill' href='#$mon' role='tab' aria-controls='$mon' aria-selected='false'>$mon</a>";
                                            }
                                        }
                                        ?>
                                 </div>
                             </div>
                             <div class=" col-sm-9 col-xs-12 ">
                                 <div class="card card-primary border border-primary ">
                                     <div class="card-header with-header">
                                         <h3 class="card-title holidayTitle"><i class="fas fa-calendar"></i> &nbsp; <span><?php echo $months[$mnt] ?></span></h3>
                                     </div>
                                     <div class="card-body">
                                         <div class="tab-content holidayTabContent table" id="vert-tabs-tabContent ">
                                             <?php
                                                echo "<div class='tab-pane fade show active holidayDiv' id='" . $months[$mnt] . "' role='tabpanel' aria-labelledby='" . $months[$mnt] . "-tab'>";
                                                ?>
                                             <table class='table table-striped table-bordered holidaysTable'>
                                                 <thead>
                                                     <tr>
                                                         <th>#</th>
                                                         <th>Date</th>
                                                         <th>Occasion</th>
                                                         <th>Day</th>
                                                         <th>Action</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody id="holidayList">
                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
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



 <!-- ===============================================
 *      MODAL ADD HOLIDAY
===================================================== -->
 <div class="modal fade" id="modalAddHoliday">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form action="" method="post">
                 <div class="modal-header">
                     <h4 class="modal-title">Add Holiday</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-12 addHolidayDiv">
                             <div class="form-group row">
                                 <div class="col-6">
                                     <input type="date" name="newHolidayDate[]" id="" class="form-control newHolidayDate" placeholder="Date" required>
                                 </div>
                                 <div class="col-6">
                                     <input type="text" name="newHolidayOccasion[]" id="" class="form-control" placeholder="Occasion" required>
                                 </div>
                             </div>
                         </div>
                         <div class="col-12">
                             <button type="button" class="btn btn-success btn-sm ml-5 btnAddHoliday">Add Holiday</button>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer text-center">
                     <button type="submit" class="btn btn-success" name="createHoliday">Submit</button>
                 </div>
             </form>
             <?php
                $addHoliday  = new HolidayController();
                $addHoliday->ctlrCreateHoliday();
                ?>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>

 <!-- ==============================
       DELETE HOLIDAY
 ===================================== -->
 <?php
    $deleteHoliday = new HolidayController();
    $deleteHoliday->ctlrDeleteHoliday();
    ?>