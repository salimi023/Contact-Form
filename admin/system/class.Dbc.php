<?php
// Database connection
final class Dbc {
    public $db;
    public function __construct() {
        try {
            $this->db = new PDO('mysql:dbname=form;host=localhost', 'root', '');
            $this->db->exec("SET CHARACTER SET UTF8");
            $this->db->exec("SET NAMES UTF8");
        }
        catch(PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }        
    }
}