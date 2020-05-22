<?php


namespace System\Model;
use System\Database\database;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function query($sql_statment){
        return Database::execute_sql($sql_statment);
    }

    public function getAll(string $table){
        $sql_statment = "SELECT * FROM `$table`";
        return Database::execute_sql($sql_statment);
    }

    public function getOne(int $id, string $table){
        $sql_statment = "SELECT * FROM `$table` WHERE id = $id";
        return Database::execute_sql($sql_statment);
    }

    public function getFieldByAll(string $column_name, string $table){
        $sql_statment = "SELECT ".$this->db->real_escape_string($column_name)." FROM `$table`";
        return Database::execute_sql($sql_statment);
    }

    public function getFieldByValue(string $value, string $field, string $column_name,  string $table){
        $sql_statment = "SELECT `" . $this->db->real_escape_string($column_name) . "` 
                         FROM   `" . $this->db->real_escape_string($table) . "` 
                         WHERE  `" . $this->db->real_escape_string($field) . "` = \"" . $this->db->real_escape_string($value) . "\"";

        return Database::execute_sql($sql_statment);
    }

    public function getFieldById(int $id, string $column_name,  string $table){
        $sql_statment = "SELECT ".$this->db->real_escape_string($column_name)." FROM `".$table."` WHERE id = $id";
        return Database::execute_sql($sql_statment);
    }
}