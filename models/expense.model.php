<?php

require_once "connection.php";

class ModelExpense
{
    /**===================================================
     *      CREATE EXPENSE
     * ===================================================*/
    static public function mdlCreateExpense($table, $data)
    {
        $sql = "INSERT INTO $table(item, store_name, purchase_date, price, bill) VALUES(:item, :store_name, :purchase_date, :price, :bill)";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /**=============================================
     *      SHOW EXPENSE
     * =============================================*/
    static public function mdlShowExpense($table, $item, $value)
    {
        if ($item) {
            $sql = "SELECT * FROM $table WHERE $item = :$item";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->closeCursor();
        } else {
            $sql = "SELECT * FROM $table ORDER BY id DESC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
            $stmt->closeCursor();
        }
    }


    /**=============================================
     *      EDIT EXPENSE
     * =============================================*/
    static public function mdlEditExpense($table, $data)
    {
        $sql = "UPDATE $table SET item = :item, store_name = :store_name, purchase_date = :purchase_date, price = :price, bill = :bill WHERE id = :id";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }


    /**=============================================
     *      DELETE EXPENSE
     * =============================================*/
    static public function mdlDeleteExpense($table, $item, $value)
    {
        $sql = "DELETE FROM $table WHERE $item = :$item";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
        return $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
    }


    /**=============================================
     *      SHOW EXPENSE CHART
     * =============================================*/
    static public function mdlExpenseDateRange($table, $item,  $value1, $value2)
    {
        $sql = "SELECT * FROM $table WHERE $item BETWEEN :val1 AND :val2 ";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":val1", $value1, PDO::PARAM_STR);
        $stmt->bindParam(":val2", $value2, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->closeCursor();
    }
}
