 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>User</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">Users</li>
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
                         <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddDepartment"> Add Department</button>
                     </div>
                     <div class="card-body">
                         <table class="table table-bordered table-striped  tables">
                             <thead>
                                 <tr>
                                     <th width="10px">#</th>
                                     <th>Name</th>
                                     <th>Designation</th>
                                     <th width="15%" class="text-center">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    $item = NULL;
                                    $value = NULL;
                                    $departments = DepartmentController::ctlrShowDepartment($item, $value);
                                    foreach ($departments as $key => $dept) {
                                        $name = $dept['name'];
                                        $id = $dept['id'];
                                        $designation = json_decode($dept['designation'], true);

                                        echo " <tr>
                                        <td>" . ($key + 1) . "</td>
                                        <td>$name</td>
                                        <td> ";
                                        if ($designation) {
                                            echo "<ul>";

                                            foreach ($designation as $key => $desg) {
                                                echo "<li>" . $desg['name'] . "</li>";
                                            }

                                            echo "</ul> ";
                                        } else {
                                            echo "No Designation Avlaible";
                                        }
                                        echo " </td>
                                        <td>
                                            <div class='btn-group-vertical'>
                                                <button class='btn btn-info btnEditDept' data-toggle='modal' data-target='#modalEditDepartment' deptId='$id'><i class='fas fa-edit'></i> View/Edit</button>
                                                <button class='btn btn-danger btnDeleteDept' deptId='$id' deptName='$name'><i class='fas fa-trash'></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>";
                                    }

                                    ?>
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



 <!-- ======================================
    ADD DEPARTMENT 
 =============================================== -->
 <div class="modal fade" id="modalAddDepartment">
     <div class="modal-dialog">
         <form action="" method="POST">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Add New Department</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="col-12">
                         <h6 class="font-weight-normal">Department</h6>
                         <div class="form-group mb-5">
                             <input type="text" name="newDepartmentName" id="newDepartmentName" class="form-control" placeholder="Department">
                             <input type="hidden" name="newAllDesignations" class="allDesignations">
                         </div>
                     </div>

                     <h6 class="font-weight-normal">Designation</h6>
                     <div class="row">
                         <div class="col-8 designationDiv">
                             <div class="form-group">
                                 <input type="text" name="" class="form-control designations" counter="1" id="" placeholder="Designation #1">
                             </div>
                         </div>
                         <div class="col-4"></div>
                     </div>
                     <div class="col-12">
                         <button type="button" class="btn btn-success btn-sm btnAddDesignation">Add Designation</button>
                     </div>
                 </div>
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary" name="createDepartment" id="createDepartment">Submit</button>
                 </div>
             </div>
         </form>
         <?php
            // $newDepartment = new DepartmentController();
            // $newDepartment->ctlrCreateDepartment();
            ?>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>



 <!-- ======================================
    SHOW / EDIT DEPARTMENT AND DESIGNATIONS
 =============================================== -->
 <div class="modal fade" id="modalEditDepartment">
     <div class="modal-dialog">
         <form action="" method="POST">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Show / Edit Department</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="col-12">
                         <h6 class="font-weight-normal">Department</h6>
                         <div class="form-group mb-5">
                             <input type="text" name="editDepartmentName" id="editDepartmentName" class="form-control">
                             <input type="hidden" name="editAllDesignations" class="allDesignations">
                             <input type="hidden" name="editDepartmentId" id="editDepartmentId">
                         </div>
                     </div>

                     <h6 class="font-weight-normal">Designation</h6>
                     <div class="row">
                         <div class="col-8 editDesignationDiv">

                         </div>
                         <div class="col-4"></div>
                     </div>
                     <div class="col-12">
                         <button type="button" class="btn btn-success btnAddDesignation btn-sm">Add Designation</button>
                     </div>
                 </div>
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary" name="editDepartment" id="editDepartment">Submit</button>
                 </div>
             </div>
         </form>
         <?php
            $editDept = new DepartmentController();
            $editDept->ctlrEditDepartment();
            ?>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>

 <?php
    /*=================================================
    DELETE DEPARTMENT
    ================================================ */
    $deleteDept = new DepartmentController();
    $deleteDept->ctlrDeleteDepartment();

    ?>