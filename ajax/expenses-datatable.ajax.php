<?php

require_once "../controllers/expense.controller.php";
require_once "../models/expense.model.php";

class ExpenseAjax
{
    /**===========================================
     *      SHOW EXPENSES IN DATATABLE
     * ===========================================*/
    static public function ajaxShowExpenses()
    {
        $item = NULL;
        $value = NULL;
        $expenses = ExpenseController::ctlrShowExpense($item, $value);

        $jsonData = '{
	        "data": [';

        foreach ($expenses as $key => $data) {
            $id = $data['id'];

            // BUTTON
            $button = "<div class='row'><button title='View / Edit' class='btn btn-outline-info btn-sm btnEditExpense mr-2' expenseId='$id'><i class='fas fa-edit'></i> </button>";
            $button .= "<button title='Delete' class='btn btn-outline-danger btn-sm btnDeleteExpense ml-2' expenseId='$id' bill='" . $data['bill'] . "'><i class='fas fa-trash'></i> </button></div>";

            $jsonData .= '[
                "' . ($key + 1) . '",
                "' . $data['item'] . '",
                "' . $data['store_name'] . '",
                "' . $data['purchase_date'] . '",
                "' . number_format($data['price']) . '",
                "' . $button . '"
            ],';
        }

        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= ']
                }';

        echo $jsonData;
    }
}

/**===========================================
 *      SHOW EXPENSES IN DATATABLE
 * ===========================================*/
$expense = new ExpenseAjax();
$expense->ajaxShowExpenses();
