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
                         <li class="breadcrumb-item active">Expense</li>
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
                         <a href="add-expense" class="btn btn-success"> Add New Expense &nbsp; <i class="fas fa-plus"></i></a>
                     </div>
                     <div class="card-body">
                         <table class="table  table-striped  expensesTable" width="100%">
                             <thead>
                                 <tr>
                                     <th width="10px">#</th>
                                     <th>Item Name</th>
                                     <th>Purchase From</th>
                                     <th>Purchase Date</th>
                                     <th>Price (<small><i class="fas fa-rupee-sign"></i></small>)</th>
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

             <!-- SEARCH  -->

             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <form action="" method="post">
                             <div class="row">

                                 <!-- view type -->
                                 <div class="col-12 col-md-3">
                                     <div class="form-group">
                                         <label for="">Select View</label>
                                         <select name="expenseChartView" id="" class="form-control">
                                             <option value="month" selected>Month Wise View</option>
                                             <option value="year">Year Wise View</option>
                                         </select>
                                     </div>
                                 </div>

                                 <!-- Start date  -->
                                 <div class="col-12 col-md-3">
                                     <div class="form-group">
                                         <label for="">Select Start Date </label>
                                         <input type="date" name="expenseChartStartDate" class="form-control" id="">
                                     </div>
                                 </div>

                                 <!-- End date  -->
                                 <div class="col-12 col-md-3">
                                     <div class="form-group">
                                         <label for="">Select End Date </label>
                                         <input type="date" name="expenseChartEndDate" class="form-control" id="">
                                     </div>
                                 </div>

                                 <!-- button -->
                                 <div class="col-12 col-md-3">
                                     <div class="form-group">
                                         <label for="" calss="invisible"> Search</label>
                                         <button type="submit" name="expenseChartSearch" class="btn btn-success btn-block">Search</button>
                                     </div>
                                 </div>
                             </div>
                         </form>

                     </div>
                 </div>
             </div>

             <!-- EXPENSE CHART -->

             <!-- graph -->
             <?php
                include "views/modules/charts/expense-chart.php";
                ?>
         </div>
 </div>
 </div>

 </section>
 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <?php
    $deleteExpense = new ExpenseController();
    $deleteExpense->ctlrDeleteExpense();



    ?>