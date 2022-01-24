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
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item ">Employess</li>
                         <li class="breadcrumb-item active">Add Employee</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

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
                                     <img src="views/img/employees/default/default.jpg" width="200px" class="img-responsive preview" alt="">
                                     <input type="file" name="newEmpImage" id="newEmpImage" class="form-control-file userImage">
                                     <span class="badge badge-danger">Note</span> Maximum 2mb
                                 </div>
                             </div>

                             <!-- NAME -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Name <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpName" id="newEmpName" class="form-control" placeholder="Employee Name" required>
                                 </div>
                             </div>

                             <!-- FATHER NAME -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Father Name </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpFatherName" id="newEmpFatherName" class="form-control" placeholder=" Father Name">
                                 </div>
                             </div>

                             <!-- BIRTHDAY -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Date of Birth </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="date" name="newEmpDoB" id="newEmpDoB" class="form-control">
                                 </div>
                             </div>

                             <!-- BIRTHDAY -->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Gender </label>
                                 </div>
                                 <div class="col-md-9">
                                     <select name="newEmpGender" id="newEmpGender" class="form-control">
                                         <option value="" disabled selected>Select Gender</option>
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
                                     <input type="text" name="newEmpPhone" id="newEmpPhone" class="form-control" data-inputmask="'mask':'9999-999-999'" data-mask placeholder="Contact No">
                                 </div>
                             </div>

                             <!-- LOCAL ADDRESS-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Local Address </label>
                                 </div>
                                 <div class="col-md-9">
                                     <textarea name="newEmpLocalAddress" id="newEmpLocalAddress" class="form-control" placeholder="Local Address"></textarea>
                                 </div>
                             </div>

                             <!-- PERMANENT ADDRESS-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Permanent Address </label>
                                 </div>
                                 <div class="col-md-9">
                                     <textarea name="newEmpPermanentAddress" id="newEmpPermanentAddress" class="form-control" placeholder="Permanent Address"></textarea>
                                 </div>
                             </div>

                             <h4>Login Details</h4>

                             <!-- EMAIL-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Email <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="email" name="newEmpEmail" id="newEmpEmail" class="form-control" placeholder="Email" required>
                                 </div>
                             </div>

                             <!-- PASSWORD-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Password <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpPassword" id="newEmpPassword" class="form-control" placeholder="Password" required>
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
                                     <?php
                                        $item = NULL;
                                        $value = NULL;
                                        $employee = EmployeesController::ctlrShowEmployees($item, $value);
                                        foreach ($employee as $key => $value) {
                                        }
                                        $code = $value['code'];
                                        if ($code) {
                                            echo "<input type='text' name='newEmpCode' id='newEmpCode' class='form-control' value='" . ($code + 1) . "' required readonly> ";
                                        } else {
                                            echo "<input type='text' name='newEmpCode' id='newEmpCode' class='form-control' value='100001' required readonly>";
                                        }
                                        ?>
                                 </div>
                             </div>

                             <!-- DEPARTMENT ID-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Department <small>&starf;</small></label>
                                 </div>
                                 <div class="col-md-9">
                                     <select name="newEmpDepartment" id="newEmpDepartment" class="form-control department" required>
                                         <option value="" selected disabled>Select Department</option>
                                         <?php
                                            $item = NULL;
                                            $value = NULL;
                                            $dept = DepartmentController::ctlrShowDepartment($item, $value);
                                            foreach ($dept as $key => $data) {
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
                                     <select name="newEmpDesignation" id="newEmpDesignation" class="form-control deptDesignation" required>
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
                                     <input type="date" name="newEmpJoinDate" id="newEmpJoinDate" class="form-control">
                                 </div>
                             </div>

                             <!-- JOINING SALARY-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Joining Salary </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpSalary" id="newEmpSalary" class="form-control" placeholder="Current Salary">
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
                                     <input type="text" name="newEmpAccountHolderName" id="newEmpAccountHolderName" class="form-control" placeholder="Account Holder Name">
                                 </div>
                             </div>

                             <!-- ACCOUNT NUMBER-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Account Number </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpAccountNo" id="newEmpAccountNo" class="form-control" placeholder="Account Number">
                                 </div>
                             </div>

                             <!-- BANK NAME-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Bank Name </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpBankName" id="newEmpBankName" class="form-control" placeholder="Bank Name">
                                 </div>
                             </div>

                             <!-- IFSE CODE-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">IFSC Code </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpIfscCode" id="newEmpIfscCode" class="form-control" placeholder="IFSC Code">
                                 </div>
                             </div>

                             <!-- PAN NUMBER-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Pan Number </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpPanNo" id="newEmpPanNo" class="form-control" placeholder="Pan No">
                                 </div>
                             </div>

                             <!-- BRANCH NAME-->
                             <div class="form-group row">
                                 <div class="col-md-3 text-right">
                                     <label class="font-weight-normal">Branch Name </label>
                                 </div>
                                 <div class="col-md-9">
                                     <input type="text" name="newEmpBranchName" id="newEmpBranchName" class="form-control" placeholder="Branch Name">
                                 </div>
                             </div>

                         </div>
                     </div>


                 </div>
                 <div class="col-12">
                     <div class="card card-info border border-info">
                         <div class="card-header">
                             <p class="card-title">Documents</p>
                         </div>
                         <div class="card-body">
                             <div class="col-6">

                                 <!-- RESUME -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newEmpResume" class="font-weight-normal">Resume </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="newEmpResume" id="newEmpResume">
                                                 <label class="custom-file-label" for="newEmpResume">Choose file</label>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- OFFER LETTER -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newEmpOfferLetter" class="font-weight-normal">Offer Letter </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="newEmpOfferLetter" id="newEmpOfferLetter">
                                                 <label class="custom-file-label" for="newEmpOfferLetter">Choose file</label>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- JOINING LETTER -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newEmpJoiningLetter" class="font-weight-normal">Joining Letter </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="newEmpJoiningLetter" id="newEmpJoiningLetter">
                                                 <label class="custom-file-label" for="newEmpJoiningLetter">Choose file</label>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- ID PROOF -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newEmpIdProof" class="font-weight-normal">ID Proof </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" class="custom-file-input" name="newEmpIdProof" id="newEmpIdProof">
                                                 <label class="custom-file-label" for="newEmpIdProof">Choose file</label>
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
                             <button type="submit" name="createEmployee" class="btn btn-success">Submit</button>
                         </div>
                     </div>
                 </div>
             </div>

         </form>
         <?php
            $createEmp = new EmployeesController();
            $createEmp->ctlrCreateEmployee();
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->