<?php

require_once "connection.php";

class ModelAttendance
{
    /*==========================================
        MARK ATTENDANCE
    ============================================ */
    static public function mdlMarkAttendance($table, $data)
    {
        $sql = "INSERT INTO $table(employee_id, clock_in, clock_out, full_date, date, month, year, status) VALUES(:employee_id, :clock_in, :clock_out, :full_date, :date, :month, :year, :status)";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*==========================================
        SHOW ONE EMPLOYEE ATTENDANCE
    ============================================ */
    static public function mdlShowOneAttendance($table, $item1, $value1, $item2, $value2)
    {
        if ($item2) {
            $sql = "SELECT * FROM $table WHERE $item1 = :$item1 AND $item2 = :$item2 ORDER BY id DESC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":$item1", $value1, PDO::PARAM_STR);
            $stmt->bindParam(":$item2", $value2, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->closeCursor();
        } else {
            $sql = "SELECT * FROM $table WHERE $item1 = :$item1 ORDER BY id DESC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":$item1", $value1, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->closeCursor();
        }
    }



    /*==========================================
        SHOW ALL EMPLOYEE ATTENDANCE
    ============================================ */
    static public function mdlShowAllAttendance($table, $item, $value, $month, $year, $order)
    {
        if ($month && $year) {
            $sql = "SELECT * FROM $table WHERE $item = :$item AND month = :month AND year = :year ORDER BY id $order";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":$item", $value, PDO::PARAM_STR);
            $stmt->bindParam(":month", $month, PDO::PARAM_STR);
            $stmt->bindParam(":year", $year, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->closeCursor();
        } else {
            $sql = "SELECT * FROM $table WHERE $item = :$item ORDER BY id $order";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":$item", $value, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->closeCursor();
        }
    }

    /*==========================================
         ATTENDANCE CLOCK IN
    ============================================*/
    static public function mdlAttendanceClockIn($table, $data)
    {
        $sql = "UPDATE $table SET clock_in = :clock_in, status = :status WHERE employee_id = :employee_id AND full_date = :full_date";
        $stmt = Connection::connector()->prepare($sql);
        return  $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*==========================================
         ATTENDANCE CLOCK OUT
    ============================================ */
    static public function mdlAttendanceClockOut($table, $data)
    {
        $sql = "UPDATE $table SET clock_out = :clock_out, status = :status WHERE employee_id = :employee_id AND full_date = :full_date";
        $stmt = Connection::connector()->prepare($sql);
        return  $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*==========================================
        UPDATE ATTENDANCE
    ============================================ */
    static public function mdlUpdateAttendance($table, $item1, $value1, $item2, $value2)
    {
        $fullDate = date("Y-m-d");
        $sql = "UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2 AND full_date = :full_date";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":$item1", $value1, PDO::PARAM_STR);
        $stmt->bindParam(":$item2", $value2, PDO::PARAM_STR);
        $stmt->bindParam(":full_date", $fullDate, PDO::PARAM_STR);
        return  $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
    }
}
