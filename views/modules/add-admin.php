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
                         <li class="breadcrumb-item active">Add New Admin</li>
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

                                 <!-- NAME -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newAdminName" class="font-weight-normal">Name <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="newAdminName" id="newAdminName" class="form-control" placeholder=" Name" required>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- EMAIL -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newAdminEmail" class="font-weight-normal">Email <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="newAdminEmail" id="newAdminEmail" class="form-control" placeholder=" Email" required>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- EMAIL -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newAdminPassword" class="font-weight-normal">Password <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="newAdminPassword" id="newAdminPassword" class="form-control" placeholder=" Password" required>
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
                             <button type="submit" name="createAdmin" class="btn btn-success">Submit</button>
                         </div>
                     </div>
                 </div>
             </div>

         </form>
         <?php
            $createAdmin = new AdminController();
            $createAdmin->ctlrCreateAdmin();
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->