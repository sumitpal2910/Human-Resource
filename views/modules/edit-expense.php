 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Add edit Expense</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="home">Home</a></li>
                         <li class="breadcrumb-item "><a href="expense"> Expense</a></li>
                         <li class="breadcrumb-item active">Add edit Expense</li>
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
                             <p class="card-title">Edit Expense</p>
                         </div>
                         <div class="card-body">
                             <div class="col-8">
                                 <?php
                                    if (isset($_GET['expenseId'])) {
                                        $item = "id";
                                        $value = $_GET['expenseId'];
                                        $expense = ExpenseController::ctlrShowExpense($item, $value);
                                    }
                                    ?>

                                 <!-- ITEM NAME -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editExpItem" class="font-weight-normal">Item Name <small>&starf;</small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="editExpItem" id="editExpItem" class="form-control" placeholder="Item Name" value="<?php echo $expense['item'] ?>" required>
                                             <input type="hidden" name="editExpId" value="<?php echo $expense['id'] ?>">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- PURCHASE FROM -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editExpStore" class="font-weight-normal">Purchase From </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="text" name="editExpStore" id="editExpStore" class="form-control" placeholder="Purchase From" value="<?php echo $expense['store_name'] ?>">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- PURCHASE DATE -->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editExpPurchaseDate" class="font-weight-normal">Purchase Date </label>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <input type="date" name="editExpPurchaseDate" id="editExpPurchaseDate" class="form-control" value="<?php echo $expense['purchase_date'] ?>">
                                         </div>
                                     </div>
                                     <div class="col-md-5"></div>
                                 </div>

                                 <!-- ITEM PRICE-->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editExpPrice" class="font-weight-normal">Item Price &nbsp;<small> <i class="fas fa-rupee-sign"></i> <sup>&starf;</sup></small> </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="form-group">
                                             <input type="number" name="editExpPrice" id="editExpPrice" class="form-control" placeholder=" Price of Item" value="<?php echo $expense['price'] ?>" required>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- ITEM BILL-->
                                 <div class="form-group row">
                                     <div class="col-md-3 text-right">
                                         <label for="editExpBill" class="font-weight-normal">Purchase Bill </label>
                                     </div>
                                     <div class="col-md-9">
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" name="editExpBill" id="editExpBill" class="custom-file-input">
                                                 <input type="hidden" name="editExpBillActual" value="<?php echo $expense['bill'] ?>">
                                                 <label for="editExpBill" class="custom-file-label">Choose File</label>
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
                                 <button type="submit" name="editExpense" class="btn btn-success"><i class="fas fa-edit"></i> Update </button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </form>

         <?php
            $createExpense = new ExpenseController();
            $createExpense->ctlrEditExpense();
            ?>

     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->