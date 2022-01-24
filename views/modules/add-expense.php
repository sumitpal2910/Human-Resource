 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Add New Expense</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item "><a href="expense"> Expense</a></li>
                         <li class="breadcrumb-item active">Add New Expense</li>
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
                             <p class="card-title">Add New Expense</p>
                         </div>
                         <div class="card-body">
                             <div class="col-8">

                                 <!-- ITEM NAME -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newExpItem" class="font-weight-normal">Item Name <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="newExpItem" id="newExpItem" class="form-control" placeholder="Item Name" required>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- PURCHASE FROM -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newExpStore" class="font-weight-normal">Purchase From </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="newExpStore" id="newExpStore" class="form-control" placeholder="Purchase From">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- PURCHASE DATE -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newExpPurchaseDate" class="font-weight-normal">Purchase Date </label>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <input type="date" name="newExpPurchaseDate" id="newExpPurchaseDate" class="form-control">
                                         </div>
                                     </div>
                                     <div class="col-md-5"></div>
                                 </div>

                                 <!-- ITEM PRICE-->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newExpPrice" class="font-weight-normal">Item Price &nbsp;<small> <i class="fas fa-rupee-sign"></i> <sup>&starf;</sup></small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="number" name="newExpPrice" id="newExpPrice" class="form-control" placeholder=" Price of Item" required>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- ITEM BILL-->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="newExpBill" class="font-weight-normal">Purchase Bill </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" name="newExpBill" id="newExpBill" class="custom-file-input">
                                                 <label for="newExpBill" class="custom-file-label">Choose File</label>
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
                                 <button type="submit" name="createExpense" class="btn btn-success">Submit </button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </form>

         <?php
            $createExpense = new ExpenseController();
            $createExpense->ctlrCreateExpense();
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->