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
                         <li class="breadcrumb-item "><a href="admin"> Admin</a></li>
                         <li class="breadcrumb-item active">Add New Award</li>
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
                             <p class="card-title">Give New Award</p>
                         </div>
                         <div class="card-body">
                             <div class="col-8">

                                 <!-- AWARD NAME -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newAwardName" class="font-weight-normal">Award Name <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="newAwardName" id="newAwardName" class="form-control" placeholder="Award Name" required>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- GIFT -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newAwardGift" class="font-weight-normal">Gift <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="newAwardGift" id="newAwardGift" class="form-control" placeholder="Gift" required>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- CASH PRICE-->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newAwardCashPrice" class="font-weight-normal">Cash Price &nbsp;<small> <i class="fas fa-rupee-sign"></i></small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="newAwardCashPrice" id="newAwardCashPrice" class="form-control" placeholder="Cash Price">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- EMPLOYEE -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newAwardEmpId" class="font-weight-normal">Employee Name </label>
                                     </div>
                                     <div class="col-md-7">
                                         <div class="form-group">
                                             <select name="newAwardEmpId" id="newAwardEmpId" class="form-control select2">
                                                 <?php
                                                    $item = NULL;
                                                    $value = NULL;
                                                    $employees = EmployeesController::ctlrShowEmployees($item, $value);
                                                    foreach ($employees as $key => $employee) {
                                                        $id = $employee['id'];
                                                        $code = $employee['code'];
                                                        $name = $employee['name'];
                                                        echo "<option value='$id'>$name (EmpCode: $code)</option>";
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
                                             <label for="newAwardCashPrice" class="font-weight-normal">Cash Price &nbsp;<small> <i class="fas fa-rupee-sign"></i></small> </label>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <select name="newAwardMonth" id="newAwardMonth" class="form-control">
                                                     <option value='' selected disabled>--Select Month--</option>
                                                     <?php
                                                        $months = [
                                                            "January", "February", "March", "April", "May", "June", "July",
                                                            "August", "September", "October", "November", "December"
                                                        ];
                                                        foreach ($months as $key => $month) {
                                                            echo "<option value='$month'>$month</option>";
                                                        }
                                                        ?>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-md-6 row">
                                         <div class="col-md-6 text-right">
                                             <label for="newAwardCashPrice" class="font-weight-normal">Cash Price &nbsp;<small> <i class="fas fa-rupee-sign"></i></small> </label>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <select name="newAwardYear" id="newAwardYear" class="form-control awardYear">
                                                 </select>
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
                                 <button type="submit" name="createAward" class="btn btn-success">Submit</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </form>
         <?php
            $createAward = new AwardController();
            $createAward->ctlrCreateAward();
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->