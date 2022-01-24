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
                         <li class="breadcrumb-item active">Add edit Admin</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <form action="" method="post" role="form" enctype="multipart/form-data">
             <div class="row">

                 <div class="col-12">
                     <div class="card card-primary border border-primary">
                         <div class="card-header">
                             <p class="card-title">Login Deatils</p>
                         </div>
                         <div class="card-body">
                             <div class="col-8">
                                 <?php
                                    if (isset($_GET['adminId'])) {
                                        $item = "id";
                                        $value = $_GET['adminId'];
                                        $admin = AdminController::ctlrShowAdmin($item, $value);
                                    }
                                    ?>

                                 <!-- NAME -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editAdminName" class="font-weight-normal">Name </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="editAdminName" id="editAdminName" class="form-control" placeholder=" Name" value="<?php echo $admin['name'] ?>">
                                             <input type="hidden" name="editAdminId" value="<?php echo $_GET['adminId'] ?>">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- EMAIL -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editAdminEmail" class="font-weight-normal">Email </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="editAdminEmail" id="editAdminEmail" class="form-control" placeholder=" Email" value="<?php echo $admin['email'] ?>">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- EMAIL -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editAdminPassword" class="font-weight-normal">Password </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="editAdminPassword" id="editAdminPassword" class="form-control" placeholder=" Password">
                                             <input type="hidden" name="editAdminPasswordActual" value="<?php echo $admin['password'] ?>">
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
                             <button type="submit" name="editAdmin" class="btn btn-success">Submit</button>
                         </div>
                     </div>
                 </div>
             </div>

         </form>
         <?php
            $createAdmin = new AdminController();
            $createAdmin->ctlrEditAdmin();
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->