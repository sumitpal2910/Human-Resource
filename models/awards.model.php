<?php

require_once "connection.php";

class ModelAward
{
    /*=======================================
    *   CREATE AWARD    
    =========================================*/
    static public function mdlCreateAward($table, $data)
    {
        $sql = "INSERT INTO $table(employee_id, name, gift, cash_price, month, year) VALUES(:employee_id, :name, :gift, :cash_price, :month, :year)";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }


    /*=======================================
    *   SHOW AWARD    
    =========================================*/
    static public function mdlShowAward($table, $item, $value)
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
            return $stmt->fetchAll();
            $stmt->closeCursor();
        }
    }


    /*=======================================
    *   EDIT AWARD    
    =========================================*/
    static public function mdlEditAward($table, $data)
    {
        $sql = "UPDATE $table SET employee_id = :employee_id, name = :name, gift  = :gift, cash_price = :cash_price, month = :month, year = :year WHERE id = :id";
        $stmt = Connection::connector()->prepare($sql);
        return  $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }


    /*=======================================
    *   DELETE AWARD    
    =========================================*/
    static public function mdlDeleteAward($table, $item, $value)
    {
        $sql = "DELETE FROM $table WHERE $item = :$item";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
        return  $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
    }
}
