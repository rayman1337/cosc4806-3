<?php

require_once ('config.php');

function db_connect() {
    try {
        $dbh = new PDO('mysql:host=' . DB_HOST . ';port='. DB_PORT . ';dbname=' . DB_DATABASE, DB_USER, $_ENV['DB_PASS']);
        return $dbh;
    } catch (PDOException $e) {
       error_log("Error connecting to database: " . $e->getMessage());
    }
    return null;
}

?>