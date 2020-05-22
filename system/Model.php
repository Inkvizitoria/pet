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

    public function getColumns(string $column_name, string $table){
        $sql_statment = "SELECT ".$this->db->real_escape_string($column_name)." FROM `$table`";
        return Database::execute_sql($sql_statment);
    }

    public function getColumnByField(int $id, string $field, string $column_name,  string $table){
        $sql_statment = "SELECT " . $this->db->real_escape_string($column_name) . " 
                         FROM   " . $this->db->real_escape_string($table) . " 
                         WHERE  " . $this->db->real_escape_string($field) . " = $id";
        return Database::execute_sql($sql_statment);
    }

    public function getColumnById(int $id, string $column_name,  string $table){
        $sql_statment = "SELECT ".$this->db->real_escape_string($column_name)." FROM `".$table."` WHERE id = $id";
        return Database::execute_sql($sql_statment);
    }
}