<?php

require_once "connection.php";

class ModelEmployees
{
    /*============================================
        SHOW EMPLOYEES
    ==============================================*/
    static public function mdlShowEmployees($table, $item, $value)
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

    /*============================================
        CREATE EMPLOYEE
    ==============================================*/
    static public function mdlCreateEmployee($table, $data)
    {
        $sql = "INSERT INTO $table(code, name, father_name, date_of_birth, gender, phone, local_address, permanent_address, ";
        $sql .= "image, email, password, department_id, designation_id, join_date, salary, account_holder_name, account_number, ";
        $sql .= "bank_name, ifsc_code, pan, branch, resume, offer_letter, joining_letter, id_proof, status) ";

        $sql .= "VALUES(:code, :name, :father_name, :date_of_birth, :gender, :phone, :local_address, :permanent_address, ";
        $sql .= ":image, :email, :password, :department_id, :designation_id, :join_date, :salary, :account_holder_name, :account_number, ";
        $sql .= ":bank_name, :ifsc_code, :pan, :branch, :resume, :offer_letter, :joining_letter, :id_proof, :status ) ";

        $stmt = Connection::connector()->prepare($sql);
        // foreach ($data as $key => $value) {
        //     $stmt->bindParam($key, $value, PDO::PARAM_STR);
        // }
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*============================================
        EDIT EMPLOYEE
    ==============================================*/
    static public function mdlEditEmployee($table, $data)
    {
        $sql = "UPDATE $table SET name = :name, father_name = :father_name, date_of_birth = :date_of_birth, gender = :gender, phone = :phone, ";
        $sql .= "local_address = :local_address, permanent_address = :permanent_address, image = :image, email = :email, password = :password, ";
        $sql .= "department_id = :department_id, designation_id = :designation_id, join_date = :join_date, exit_date = :exit_date, salary = :salary, ";
        $sql .= "account_holder_name = :account_holder_name, account_number = :account_number, bank_name = :bank_name, ifsc_code = :ifsc_code , ";
        $sql .= "pan = :pan, branch = :branch, resume = :resume, offer_letter = :offer_letter, joining_letter = :joining_letter, id_proof = :id_proof, ";
        $sql .= "status = :status WHERE code = :code";
        $stmt = Connection::connector()->prepare($sql);

        $stmt = Connection::connector()->prepare($sql);
        return $stmt->execute($data) ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*==================================================
        DELETE EMPLOYEE
    ==================================================== */
    static  public function mdlDeleteEmployee($table, $item, $value)
    {
        $sql = "DELETE FROM $table WHERE $item = :$item";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
        return $stmt->execute() ? "ok" : "error";
        $stmt->closeCursor();
    }

    /*============================================
        UPDATE EMPLOYEES
    ==============================================*/
    static public function mdlUpdateEmployee($table, $item, $value, $id)
    {
        $sql = "UPDATE $table SET $item = :$item WHERE id = :id";
        $stmt = Connection::connector()->prepare($sql);
        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        return  $stmt->execute();
        $stmt->closeCursor();
    }
}
