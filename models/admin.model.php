<?php

require_once "connection.php";

class ModelAdmin
{
    /*=============================================
        CREATE ADMIN
    =============================================== */
    static public function mdlCreateAdmin($table, $data)
    {
        $sql = "INSERT INTO $table(name, email, password) VALUES(:name, :email, :password)";
        $stmt = Connection::connector()->prepare($sql);
        return  $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }


    /*===============================================
        SHOW ADMIN
    ================================================= */
    static public function mdlShowAdmin($table, $item, $value)
    {
        if ($item) {
            $sql = "SELECT * FROM $table WHERE $item = :$item";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $stmt->execute();
            return  $stmt->fetch();
            $stmt->closeCursor();
        } else {
            $sql = "SELECT * FROM $table";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
            $stmt->closeCursor();
        }
    }


    /*=================================================
        EDIT ADMIN
    =================================================== */
    static public function mdlEditAdmin($table, $data)
    {
        $sql = "UPDATE $table SET name = :name, email = :email, password = :password WHERE id = :id";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }
}
