<?php

require_once "connection.php";

class ModelHoliday
{
    /**=============================================
     *      CREATE HOLIDAY
     * =============================================*/
    static public function mdlCreateHoliday($table, $data)
    {
        $sql = "INSERT INTO $table(holiday_date, month_no, occasion, day, month, year) VALUES(:holiday_date, :month_no, :occasion, :day, :month, :year)";
        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }


    /**=============================================
     *      SHOW HOLIDAY
     * =============================================*/
    static public function mdlShowHoliday($table, $item, $value)
    {
        $year = date("Y");
        if ($item) {
            $sql = "SELECT * FROM $table WHERE $item = :$item AND year = :year ORDER BY holiday_date ASC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $stmt->bindParam(":year", $year, PDO::PARAM_STR);
            $stmt->execute();
            return  $stmt->fetchAll();
            $stmt->closeCursor();
        } else {
            $sql = "SELECT * FROM $table WHERE year = :year ORDER BY holiday_date ASC";
            $stmt = Connection::connector()->prepare($sql);
            $stmt->bindParam(":year", $year, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->closeCursor();
        }
    }


    /**=============================================
     *      DELETE HOLIDAY
     * =============================================*/
    static public function mdlDeleteHoliday($table, $item, $value)
    {
        $sql = "DELETE FROM $table WHERE $item = :$item";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
        return $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
    }
}
