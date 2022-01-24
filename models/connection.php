<?php

class Connection
{

    static public function connector()
    {
        $host = "localhost";
        $db = "human-resource";
        $user = "root";
        $pass = "";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
        } catch (\Throwable $th) {
            echo "Connection Failed" . $th->getMessage();
        }
        return $conn;
    }
}
