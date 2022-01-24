 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Admin</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item active">Admin</li>
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
                         <a href="add-admin" class="btn btn-primary"> Add New Admin</a>
                     </div>
                     <div class="card-body">
                         <table class="table table-bordered table-striped  tables">
                             <thead>
                                 <tr>
                                     <th >#</th>
                                     <th>Name</th>
                                     <th>Email</th>
                                     <th width="15%">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    $item = NULL;
                                    $value = NULL;
                                    $admins = AdminController::ctlrShowAdmin($item, $value);
                                    foreach ($admins as $key => $admin) {
                                        $no = $key + 1;
                                        $id = $admin['id'];
                                        $name = $admin['name'];
                                        $email = $admin['email'];

                                        echo "<tr>
                                     <td>$no</td>
                                     <td>$name</td>
                                     <td>$email</td>
                                     <td>
                                         <div class='btn-group-vertical'>
                                             <button class='btn btn-info btnEditAdmin' id='$id'><i class='fas fa-edit'></i> View / Edit </button>
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
