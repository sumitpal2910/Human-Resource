 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Leave Type</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item active">Leave Type</li>
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
                         <button type="button" data-toggle="modal" data-target="#modalAddLeaveType" class="btn btn-success"> Add New Leave <i class="fas fa-plus"></i></a>
                     </div>
                     <div class="card-body">
                         <table class="table table-bordered table-striped leaveTypeTable">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Leave</th>
                                     <th>Number of Leave</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>

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


 <!-- ===============================================
 *      MODAL ADD LEAVE TYPE
===================================================== -->
 <div class="modal fade" id="modalAddLeaveType">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form action="" method="post">
                 <div class="modal-header">
                     <h4 class="modal-title">Add Leave Type</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-12 ">
                             <div class="form-group row">
                                 <div class="col-sm-6 col-xs-12">
                                     <input type="text" name="newLeaveType" id="" class="form-control" placeholder="Leave Type" required>
                                 </div>
                                 <div class="col-sm-6 col-xs-12">
                                     <input type="number" name="newLeaveTypeDays" id="" class="form-control" placeholder="Number of Leave" min="0" required>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="modal-footer text-center">
                     <button type="submit" class="btn btn-success" name="createLeaveType">Submit</button>
                 </div>
                 <?php
                    $createLeaveType = new LeaveTypeController();
                    $createLeaveType->ctlrCreateLeaveType();
                    ?>
             </form>

         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>



 <!-- ===============================================
 *      MODAL EDIT LEAVE TYPE
===================================================== -->
 <div class="modal fade" id="modalEditLeaveType">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form action="" method="post">
                 <div class="modal-header">
                     <h4 class="modal-title"> Edit Leave Type</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-12 ">
                             <div class="form-group row">
                                 <div class="col-sm-6 col-xs-12">
                                     <input type="text" name="editLeaveType" id="editLeaveType" class="form-control" placeholder="Leave Type" required>
                                     <input type="hidden" name="editLeaveTypeId" id="editLeaveTypeId">
                                 </div>
                                 <div class="col-sm-6 col-xs-12">
                                     <input type="number" name="editLeaveTypeDays" id="editLeaveTypeDays" class="form-control" placeholder="Number of Leave" min="0" required>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="modal-footer text-center">
                     <button type="submit" class="btn btn-success" name="updateLeaveType">Update <i class="fas fa-check"></i></button>
                 </div>
                 <?php
                    $editLeaveType = new LeaveTypeController();
                    $editLeaveType->ctlrEditLeaveType();
                    ?>
             </form>

         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>

<!-- ========================================
 *  DELETE LEAVE TYPE
============================================= -->
 <?php 
    $deleteLeaveType = new LeaveTypeController();
    $deleteLeaveType->ctlrDeleteLeaveType();
 ?>