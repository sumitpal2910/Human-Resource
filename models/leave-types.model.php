<?php

require_once "connection.php";

class ModelLeaveType
{
    /*===============================================
    *   CREATE LEAVE TYPE
    ================================================= */
    static public function mdlCreateLeaveType($table, $data)
    {
        $sql = "INSERT INTO $table(type, number_of_day) VALUES(:type, :number_of_day)";
        $stmt = Connection::connector()->prepare($sql);
        return  $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*===============================================
    **   SHOW LEAVE TYPE
    ================================================= */
    static public function mdlShowLeaveType($table, $item, $value)
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


    /*===============================================
    *  SHOW LEAVE TYPE
    ================================================= */
    static public function mdlEditLeaveType($table, $data)
    {
        $sql = "UPDATE $table SET type = :type, number_of_day = :number_of_day WHERE id = :id ";
        $stmt = Connection::connector()->prepare($sql);
        return  $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*===============================================
    *  DELETE LEAVE TYPE
    ================================================= */
    static public function mdlDeleteLeaveType($table, $item, $value)
    {
        $sql = "DELETE FROM $table WHERE $item = :$item";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
        return  $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
    }
}
