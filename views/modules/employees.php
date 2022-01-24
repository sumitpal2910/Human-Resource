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
                         <a href="add-employee" class="btn btn-primary"> Add Employee</a>
                     </div>
                     <div class="card-body">
                         <table class="table table-bordered table-striped  employeesTable">
                             <thead>
                                 <tr>
                                     <th width="10px">#</th>
                                     <th>Code</th>
                                     <th>Image</th>
                                     <th>Name</th>
                                     <th>Phone</th>
                                     <th>Department</th>
                                     <th>At Work</th>
                                     <th>Status</th>
                                     <th width="10%">Action</th>
                                 </tr>
                             </thead>
                             <!-- <tbody>
                                 <tr>
                                     <td>1</td>
                                     <td>124</td>
                                     <td>sumit pal</td>
                                     <td><img src="views/img/employees/default/default.jpg" class="img-thumbnail" width="50px"></td>
                                     <td>6295475812</td>
                                     <td>sumit.pal.2810@gmail.com</td>
                                     <td>Active</td>
                                     <td>maslandapur</td>
                                     <td>21-06-2021</td>
                                     <td>
                                         <div class="btn-group">
                                             <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                             <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                                         </div>
                                     </td>
                                 </tr>
                             </tbody> -->
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
    DELETE EMPLOYEE
 =============================================== -->
 <?php
    $deleteEmployee = new EmployeesController();
    $deleteEmployee->cltrDeleteEmployee();
    ?>