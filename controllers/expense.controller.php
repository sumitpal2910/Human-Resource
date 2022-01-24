<?php

class ExpenseController
{
    /**=============================================
     *      CREATE EXPENSE
     * =============================================*/
    static public function ctlrCreateExpense()
    {
        if (isset($_POST['createExpense'])) {
            $item = $_POST['newExpItem'];
            $store = $_POST['newExpStore'];
            $purchaseDate = $_POST['newExpPurchaseDate'];
            $price = $_POST['newExpPrice'];


            // CREATE TARGET DIR
            $year = substr($purchaseDate, 0, 4);
            $month = substr($purchaseDate, 5, 2);
            $date = $year . "-" . date("F", mktime(0, 0, 0, $month));
            $targetDir = "views/img/expenses/" . $date . "/";

            // CREATE FOLDER USING YEAR-MONTH NAME
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755);
            }

            // CHANGE BILL NAME AND SAVE IT
            $billName = $_FILES['newExpBill']['name'];
            $billTmp = $_FILES['newExpBill']['tmp_name'];
            $bill = "";
            if ($billName) {
                $ext = pathinfo($billName, PATHINFO_EXTENSION);
                $newName = date("d-H-i-s") . "." . $ext;
                if (rename($billTmp, ($targetDir . $newName))) {
                    $bill = $targetDir . $newName;
                }
            }

            // SEND DATA TO MODEL PAGE
            $table = "expenses";
            $data = [":item" => $item, ":store_name" => $store, ":purchase_date" => $purchaseDate, ":price" => $price, ":bill" => $bill];
            $result = ModelExpense::mdlCreateExpense($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'New Expense has been Added',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                 window.location = 'expenses';
                            }
                        })
                </script>";
            }
        }
    }

    /**=============================================
     *      SHOW EXPENSE
     * =============================================*/
    static public function ctlrShowExpense($item, $value)
    {
        $table = "expenses";
        return ModelExpense::mdlShowExpense($table, $item, $value);
    }

    /**=============================================
     *      EDIT EXPENSE
     * =============================================*/
    static public function ctlrEditExpense()
    {
        if (isset($_POST['editExpense'])) {
            $id = $_POST['editExpId'];
            $item = $_POST['editExpItem'];
            $store = $_POST['editExpStore'];
            $purchaseDate = $_POST['editExpPurchaseDate'];
            $price = $_POST['editExpPrice'];

            // CREATE TARGET DIR
            $year = substr($purchaseDate, 0, 4);
            $month = substr($purchaseDate, 5, 2);
            $date = $year . "-" . date("F", mktime(0, 0, 0, $month));
            $targetDir = "views/img/expenses/" . $date . "/";

            // CREATE FOLDER USING YEAR-MONTH NAME
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755);
            }

            // UPLOAD IMAGE
            $billActual = $_POST['editExpBillActual'];
            $billName = $_FILES['editExpBill']['name'];
            $billTmp = $_FILES['editExpBill']['tmp_name'];

            if ($billName) {
                if ($billActual) {
                    unlink($billActual);
                }
                $ext = pathinfo($billName, PATHINFO_EXTENSION);
                $newName = date("d-H-i-s") . "." . $ext;
                if (rename($billTmp, ($targetDir . $newName))) {
                    $bill = $targetDir . $newName;
                }
            } else {
                $bill = $billActual;
            }

            // SEND DATA TO MODEL PAGE
            $table = "expenses";
            $data = [":item" => $item, ":store_name" => $store, ":purchase_date" => $purchaseDate, ":price" => $price, ":bill" => $bill, ":id" => $id];
            $result = ModelExpense::mdlEditExpense($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: ' Expense has been Updated',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                 window.location = 'expenses';
                            }
                        })
                </script>";
            }
        }
    }

    /**=============================================
     *      DELETE EXPENSE
     * =============================================*/
    static public function ctlrDeleteExpense()
    {
        if (isset($_GET['deleteExpense'])) {
            $id = $_GET['deleteExpense'];
            $bill = $_GET['expBill'];

            if ($bill) {
                unlink($bill);
            }

            $table = "expenses";
            $item = "id";
            $value = $id;
            $result = ModelExpense::mdlDeleteExpense($table, $item, $value);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: ' Expense has been Delete',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                 window.location = 'expenses';
                            }
                        })
                </script>";
            }
        }
    }


    /**================================================
     *       SHOW EXPENSES CHART
     * =================================================*/
    static public function ctlrExpenseDateRange($item, $value1, $value2)
    {
        $table = "expenses";
        return ModelExpense::mdlExpenseDateRange($table, $item, $value1, $value2);
    }
}
