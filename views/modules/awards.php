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
                         <li class="breadcrumb-item active">Awards</li>
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
                         <a href="add-award" class="btn btn-primary"> Add New Award</a>
                     </div>
                     <div class="card-body">
                         <table class="table table-bordered table-striped  awardsTable">
                             <thead>
                                 <tr>
                                     <th>Employee Code</th>
                                     <th>Awardee Name</th>
                                     <th>Award</th>
                                     <th>Gift</th>
                                     <th>For the Month</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>

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

<?php
    $deleteAward = new AwardController();
    $deleteAward->ctlrDeleteAward();
?>