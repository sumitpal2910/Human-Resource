<?php

require_once "connection.php";

class ModelLeave
{
    // ----------------------------------------------------- EMPLOYEE -----------------------------------------------------------

    /**==============================================================
     *      EMPLOYEE APPLY LEAVE
     * ==============================================================*/
    static public function mdlCreateLeave($table, $data)
    {
        $sql = "INSERT INTO $table(employee_id, leave_type_id, start_date, end_date, number_of_day, reason, remain_leave, year, apply_date, status) ";
        $sql .= "VALUES(:employee_id, :leave_type_id, :start_date, :end_date, :number_of_day, :reason, :remain_leave, :year, :apply_date, :status)";
        $stmt = Connection::connector()->prepare($sql);
        return  $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /**==============================================================
     *       EMPLOYEE EDIT LEAVE
     * ==============================================================*/
    static public function mdlEditLeave($table, $data, $user)
    {
        if ($user === 'employee') {

            $sql = "UPDATE $table SET employee_id = :employee_id, leave_type_id = :leave_type_id, start_date = :start_date, end_date = :end_date, ";
            $sql .= "number_of_day = :number_of_day, reason = :reason, remain_leave = :remain_leave, year = :year, status = :status WHERE id = :id";
        } else {
            $sql = "UPDATE $table SET leave_type_id = :leave_type_id, start_date = :start_date, end_date = :end_date, number_of_day = :number_of_day, ";
            $sql .= "reason = :reason, remain_leave = :remain_leave, year = :year, status = :status WHERE id = :id";
        }
        $stmt = Connection::connector()->prepare($sql);
        return  $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }


    /**==============================================================
     *      SHOW  LEAVE
     * ==============================================================*/
    static public function mdlShowLeave($table, $item, $value)
    {
        $year = date("Y");
        if ($item) {
            $sql = "SELECT * FROM $table WHERE $item = :$item AND year = :year ORDER BY id DESC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":$item", $value, PDO::PARAM_STR);
            $stmt->bindParam(":year", $year, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->closeCursor();
        } else {
            $sql = "SELECT * FROM $table WHERE year = :year ORDER BY id DESC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":year", $year, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->closeCursor();
        }
    }

    /**==============================================================
     *      SHOW EMPLOYEE LEAVE
     * ==============================================================*/
    static public function mdlShowEmployeeLeave($table, $item1, $value1, $item2, $value2)
    {
        $year = date("Y");
        if ($item2) {
            $sql = "SELECT * FROM $table WHERE $item1 = :$item1 AND $item2 = :$item2 AND year = :year ORDER BY id DESC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":$item1", $value1, PDO::PARAM_STR);
            $stmt->bindParam(":$item2", $value2, PDO::PARAM_STR);
            $stmt->bindParam(":year", $year, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->closeCursor();
        } else {
            $sql = "SELECT * FROM $table WHERE $item1 = :$item1 AND year = :year ORDER BY id DESC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":$item1", $value1, PDO::PARAM_STR);
            $stmt->bindParam(":year", $year, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->closeCursor();
        }
    }


    /**==============================================================
     *       DELETE LEAVE
     * ==============================================================*/
    static public function mdlDeleteLeave($table, $item, $value)
    {
        $sql = "DELETE FROM $table WHERE $item = :$item";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":$item", $value, PDO::PARAM_STR);
        return $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
    }


    /**==============================================================
     *       UPDATE LEAVE
     * ==============================================================*/
    static public function mdlUpdateLeave($table, $data)
    {
        $sql = "UPDATE $table SET remain_leave = :remain_leave, status = :status WHERE id = :id";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }
}
