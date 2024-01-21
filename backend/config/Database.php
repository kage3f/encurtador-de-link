<?php
class Database {
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "91034161";
    private static $database = "encurta";

    public static function getConnection() {
        $mysqli = new mysqli(self::$host, self::$username, self::$password, self::$database);

        if ($mysqli->connect_error) {
            die("Falha na conexão: " . $mysqli->connect_error);
        }

        return $mysqli;
    }
}
