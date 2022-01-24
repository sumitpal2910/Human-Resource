
<?php

require_once "connection.php";

class ModelDepartment
{
    /*====================================================
        CREATE DEPAERMENT
    ===================================================== */
    static public function mdlCreateDepartment($table, $data)
    {
        $sql = "INSERT INTO $table(name, designation, date) VALUES(:name, :designation, :date)";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*====================================================
        SHOW DEPAERMENT
    ===================================================== */
    static public function mdlShowDepartment($table, $item, $value)
    {
        if ($item) {
            $sql = "SELECT * FROM $table WHERE $item = :$item";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->closeCursor();
        } else {
            $sql = "SELECT * FROM $table";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->closeCursor();
        }
    }


    /*====================================================
        EDIT DEPAERMENT
    ===================================================== */
    static public function mdlEditDepartment($table, $data)
    {
        $sql = "UPDATE $table SET name = :name, designation = :designation WHERE id = :id";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*======================================================
        DELETE DEPARTMENT
    ======================================================== */
    static public function mdlDeleteDepartment($table, $item, $value)
    {
        $sql = "DELETE FROM $table WHERE $item = :$item";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
        return $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
    }
}
