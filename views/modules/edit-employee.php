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
                         <li class="breadcrumb-item"> <a href="employees"> Employess</a></li>
                         <li class="breadcrumb-item active">Edit Employee</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <?php
        if (isset($_GET['employeeId'])) {
            $item = "id";
            $value = $_GET['employeeId'];
            $employee = EmployeesController::ctlrShowEmployees($item, $value);
        }
        ?>
     <!-- Main content -->
     <section class="content">
         <form action="" method="post" role="form" enctype="multipart/form-data">
             <div class="row">
                 <div class="col-6">
                     <!-- ==========================================
                    PERSONAL DETAILS
                ================================================= -->
                     <div class="card card-primary border border-primary">
                         <div class="card-header ">
                             <p class="card-title">Personal Details</p>
                         </div>
                         <div class="card-body ">
                             <!-- IMAGE  -->
                             <div class="form-group row mb-5">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Photo</label>
                                 </div>
                                 <div class="col-md-9">
                                     <?php
                                        if ($employee['image']) {
                                            echo " <img src='" . $employee['image'] . "' width='200px' class='img-responsive preview' alt=''>";
                                        } else {
                                            echo "<img src='views/img/employees/default/default.jpg' width='200px' class='img-responsive preview' alt=''>";
                                        }

                                        echo " <input type='hidden' name='editEmpImageActual' value='" . $employee['image'] . "'>";
                                        ?>
                                     <input type='file' name='editEmpImage' id='editEmpImage' class='form-control-file userImage'>
                                     <span class="badge badge-danger">Note</span> Maximum 2mb
                                 </div>
                             </div>

                             <!-- NAME -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Name <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpName" id="editEmpName" class="form-control" placeholder="Employee Name" value="<?php echo $employee['name'] ?>" required>
                                 </div>
                             </div>

                             <!-- FATHER NAME -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Father Name </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpFatherName" id="editEmpFatherName" class="form-control" placeholder=" Father Name" value="<?php echo $employee['father_name'] ?>">
                                 </div>
                             </div>

                             <!-- BIRTHDAY -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Date of Birth </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="date" name="editEmpDoB" id="editEmpDoB" class="form-control" value="<?php echo $employee['date_of_birth'] ?>">
                                 </div>
                             </div>

                             <!-- BIRTHDAY -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Gender </label>
                                 </div>
                                 <div class="col-md-9">
                                     <select name="editEmpGender" id="editEmpGender" class="form-control">
                                         <?php
                                            if ($employee['gender'] == 'm') {
                                                echo "<option value='m' selected>Male</option>";
                                            } elseif ($employee['gender'] == 'f') {
                                                echo "<option value='f' selected>Female</option>";
                                            } elseif ($employee['gender'] == '0') {
                                                echo "<option value='0' selected>Others</option>";
                                            }
                                            ?>
                                         <option value="m">Male</option>
                                         <option value="f">Female</option>
                                         <option value="o">Others</option>
                                     </select>
                                 </div>
                             </div>

                             <!-- PHONE -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Phone </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpPhone" id="editEmpPhone" class="form-control" data-inputmask="'mask':'9999-999-999'" data-mask placeholder="Contact No" value=<?php echo $employee['phone'] ?>>
                                 </div>
                             </div>

                             <!-- LOCAL ADDRESS-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Local Address </label>
                                 </div>
                                 <div class="col-md-9">
                                     <textarea name="editEmpLocalAddress" id="editEmpLocalAddress" class="form-control" placeholder="Local Address"><?php echo $employee['local_address'] ?></textarea>
                                 </div>
                             </div>

                             <!-- PERMANENT ADDRESS-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Permanent Address </label>
                                 </div>
                                 <div class="col-md-9">
                                     <textarea name="editEmpPermanentAddress" id="editEmpPermanentAddress" class="form-control" placeholder="Permanent Address"><?php echo $employee['permanent_address'] ?></textarea>
                                 </div>
                             </div>

                             <h4>Login Details</h4>

                             <!-- EMAIL-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Email <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="email" name="editEmpEmail" id="editEmpEmail" class="form-control" placeholder="Email" required value="<?php echo $employee['email'] ?>">
                                 </div>
                             </div>

                             <!-- PASSWORD-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Password </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpPassword" id="editEmpPassword" class="form-control" placeholder="Password">
                                     <input type="hidden" name="editEmpPasswordActual" value="<?php echo $employee['password'] ?>">
                                 </div>
                             </div>


                         </div>
                         <!-- /.card -->
                     </div>
                 </div>
                 <div class="col-6">

                     <!-- ============================================
                     COMPANY DETAILS 
                ================================================== -->
                     <div class="card card-danger border border-danger">
                         <div class="card-header ">
                             <p class="card-title">Company Details</p>
                         </div>
                         <div class="card-body">

                             <!-- EMPLOYEE CODE-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Employee Code <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type='text' name='editEmpCode' id='editEmpCode' class='form-control' required readonly value="<?php echo $employee['code'] ?>">
                                 </div>
                             </div>

                             <!-- DEPARTMENT ID-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Department <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <select name="editEmpDepartment" id="editEmpDepartment" class="form-control department" required>
                                         <?php
                                            $item = "id";
                                            $value = $employee['department_id'];
                                            $dept = DepartmentController::ctlrShowDepartment($item, $value);
                                            echo "<option value='" . $dept['id'] . "' selected>" . $dept['name'] . "</option>";


                                            $item1 = NULL;
                                            $value1 = NULL;
                                            $allDept = DepartmentController::ctlrShowDepartment($item1, $value1);
                                            foreach ($allDept as $key => $data) {
                                                echo "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
                                            }
                                            ?>

                                     </select>
                                 </div>
                             </div>

                             <!-- DESIGNATION -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Designation <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <select name="editEmpDesignation" id="editEmpDesignation" class="form-control deptDesignation" required>
                                         <option value="">Select Designation</option>
                                     </select>
                                 </div>
                             </div>

                             <!-- JOINING DATE -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Joining Date </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="date" name="editEmpJoinDate" id="editEmpJoinDate" class="form-control" value="<?php echo $employee['join_date'] ?>">
                                 </div>
                             </div>

                             <!-- EXIT DATE -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Exit Date </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="date" name="editEmpExitDate" id="editEmpExitDate" class="form-control" value="<?php echo $employee['exit_date'] ?>">
                                 </div>
                             </div>

                             <!--   STATUS -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Status </label>
                                 </div>
                                 <div class="col-md-9">
                                     <select name="editEmpStatus" id="editEmpStatus" class="form-control" required>
                                         <option value="1">Active</option>
                                         <option value="0">Inactive</option>
                                     </select>
                                 </div>
                             </div>

                             <!--  SALARY-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal"> Salary </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpSalary" id="editEmpSalary" class="form-control" placeholder="Current Salary" value="<?php echo $employee['salary'] ?>">
                                 </div>
                             </div>

                         </div>
                     </div>


                     <!-- ============================================
                    DOCUMENTS
                ================================================== -->
                     <div class="card card-danger border border-danger">
                         <div class="card-header ">
                             <p class="card-title">Bank Account Details</p>
                         </div>
                         <div class="card-body">

                             <!-- ACCOUNT HOLDER NAME-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Account Holder Name </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpAccountHolderName" id="editEmpAccountHolderName" class="form-control" placeholder="Account Holder Name" value="<?php echo $employee['account_holder_name'] ?>">
                                 </div>
                             </div>

                             <!-- ACCOUNT NUMBER-->
                             <div class=" form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Account Number </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpAccountNo" id="editEmpAccountNo" class="form-control" placeholder="Account Number" value="<?php echo $employee['account_number'] ?>">
                                 </div>
                             </div>

                             <!-- BANK NAME-->
                             <div class=" form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Bank Name </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpBankName" id="editEmpBankName" class="form-control" placeholder="Bank Name" value="<?php echo $employee['bank_name'] ?>">
                                 </div>
                             </div>

                             <!-- IFSE CODE-->
                             <div class=" form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">IFSC Code </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpIfscCode" id="editEmpIfscCode" class="form-control" placeholder="IFSC Code" value="<?php echo $employee['ifsc_code'] ?>">
                                 </div>
                             </div>

                             <!-- PAN NUMBER-->
                             <div class=" form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Pan Number </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpPanNo" id="editEmpPanNo" class="form-control" placeholder="Pan No" value="<?php echo $employee['pan'] ?>">
                                 </div>
                             </div>

                             <!-- BRANCH NAME-->
                             <div class=" form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Branch Name </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="editEmpBranchName" id="editEmpBranchName" class="form-control" placeholder="Branch Name" value="<?php echo $employee['branch'] ?>">
                                 </div>
                             </div>

                         </div>
                     </div>


                 </div>
                 <div class=" col-12">
                     <div class="card card-info border border-info">
                         <div class="card-header">
                             <p class="card-title">Documents</p>
                         </div>
                         <div class="card-body">
                             <div class="col-6">

                                 <!-- RESUME -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editEmpResume" class="font-weight-normal">Resume </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="editEmpResume" id="editEmpResume">
                                                 <label class="custom-file-label" for="editEmpResume">Choose file</label>
                                                 <input type="hidden" name="editEmpResumeActual" value="<?php echo $employee['resume'] ?>">
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- OFFER LETTER -->
                                 <div class=" form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editEmpOfferLetter" class="font-weight-normal">Offer Letter </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="editEmpOfferLetter" id="editEmpOfferLetter">
                                                 <label class="custom-file-label" for="editEmpOfferLetter">Choose file</label>
                                                 <input type="hidden" name="editEmpOfferLetterActual" value="<?php echo $employee['offer_letter'] ?>">
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- JOINING LETTER -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editEmpJoiningLetter" class="font-weight-normal">Joining Letter </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="editEmpJoiningLetter" id="editEmpJoiningLetter">
                                                 <label class="custom-file-label" for="editEmpJoiningLetter">Choose file</label>
                                                 <input type="hidden" name="editEmpJoiningLetterActual" value="<?php echo $employee['joining_letter'] ?>">
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- ID PROOF -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editEmpIdProof" class="font-weight-normal">ID Proof </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="editEmpIdProof" id="editEmpIdProof">
                                                 <label class="custom-file-label" for="editEmpIdProof">Choose file</label>
                                                 <input type="hidden" name="editEmpIdProofActual" value="<?php echo $employee['id_proof'] ?>">
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>
                     <div class="col-6"></div>
                     <div class="row mb-5 mt-5">
                         <div class="col-3">
                         </div>
                         <div class="col-9">
                             <button type="submit" name="editEmployee" class="btn btn-success">Submit</button>
                         </div>
                     </div>
                 </div>
             </div>

         </form>
         <?php
            $createEmp = new EmployeesController();
            $createEmp->ctlrEditEmployee();
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->