 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Add Employee</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item "><a href="award"> Award</a></li>
                         <li class="breadcrumb-item active"> Edit Award</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <form action="" method="post" role="form">
             <div class="row">

                 <div class="col-12">
                     <div class="card card-primary border border-primary">
                         <div class="card-header">
                             <p class="card-title">Edit Given Award</p>
                         </div>
                         <div class="card-body">
                             <div class="col-8">

                                 <?php
                                    //  GET AWARD ID AND FETCH DATA
                                    if (isset($_GET['awardId'])) {
                                        $item = "id";
                                        $value = $_GET['awardId'];
                                        $award = AwardController::ctlrShowAward($item, $value);

                                        $empId = $_GET['employeeId'];
                                    }
                                    ?>

                                 <!-- AWARD NAME -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editAwardName" class="font-weight-normal">Award Name <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="hidden" name="editAwardId" value="<?php echo $value ?>">
                                             <input type="text" name="editAwardName" id="editAwardName" class="form-control" placeholder="Award Name" value="<?php echo $award['name'] ?>">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- GIFT -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editAwardGift" class="font-weight-normal">Gift <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="editAwardGift" id="editAwardGift" class="form-control" placeholder="Gift" required value="<?php echo $award['gift'] ?>">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- CASH PRICE-->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editAwardCashPrice" class="font-weight-normal">Cash Price &nbsp;<small> <i class="fas fa-rupee-sign"></i></small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="editAwardCashPrice" id="editAwardCashPrice" class="form-control" placeholder="Cash Price" value="<?php echo $award['cash_price'] ?>">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- EMPLOYEE -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editAwardEmpId" class="font-weight-normal">Employee Name </label>
                                     </div>
                                     <div class="col-md-7">
                                         <div class="form-group">
                                             <select name="editAwardEmpId" id="editAwardEmpId" class="form-control select2">
                                                 <?php
                                                    $item = NULL;
                                                    $value = NULL;
                                                    $employees = EmployeesController::ctlrShowEmployees($item, $value);
                                                    foreach ($employees as $key => $employee) {
                                                        $id = $employee['id'];
                                                        $code = $employee['code'];
                                                        $name = $employee['name'];
                                                        if ($empId == $id) {
                                                            echo "<option value='$id' selected>$name (EmpCode: $code)</option>";
                                                        } else {
                                                            echo "<option value='$id'>$name (EmpCode: $code)</option>";
                                                        }
                                                    }
                                                    ?>
                                             </select>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- CASH PRICE-->
                                 <div class="form-group row">
                                     <div class="col-md-6 row">
                                         <div class="col-md-6 text-right">
                                             <label for="editAwardCashPrice" class="font-weight-normal">Month </label>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <select name="editAwardMonth" id="editAwardMonth" class="form-control">
                                                     <option value='' selected disabled>--Select Month--</option>
                                                     <?php
                                                        $months = [
                                                            "January", "February", "March", "April", "May", "June", "July",
                                                            "August", "September", "October", "November", "December"
                                                        ];
                                                        foreach ($months as $key => $month) {
                                                            if ($award['month'] == $month) {
                                                                echo "<option value='$month' selected>$month</option>";
                                                            } else {
                                                                echo "<option value='$month'>$month</option>";
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-md-6 row">
                                         <div class="col-md-6 text-right">
                                             <label for="editAwardCashPrice" class="font-weight-normal">Year </label>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <input type="hidden" name="" id="awardEditYear" value="<?php echo $award['year'] ?>">
                                                 <select name="editAwardYear" id="editAwardYear" class="form-control awardYear"> </select>
                                             </div>
                                         </div>
                                     </div>
                                 </div>


                             </div>
                         </div>
                         <div class="col-4"></div>
                         <div class="row mb-5 mt-5">
                             <div class="col-4">
                             </div>
                             <div class="col-8">
                                 <button type="submit" name="editAward" class="btn btn-success">Submit</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </form>
         <?php
            $createAward = new AwardController();
            $createAward->ctlrEditAward();
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->