<?php


namespace API;
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
        $sql_statment = "SELECT `" . $this->db->real_escape_string($column_name) . "` FROM `$table`";
        return Database::execute_sql($sql_statment);
    }

    public function getFieldByWhere(array $field, $column_name,  string $table, string $operator = ''){
        $escape_column = [];
        $escape_field  = [];
        $where = '';

        if(is_array($column_name)) {
            foreach ($column_name as $column) {
                $escape_column[] = $this->db->real_escape_string($column);
            }
            $escape_column = implode('`,`', $escape_column);
        } elseif (is_string($column_name)) {
            $escape_column = $this->db->real_escape_string($column_name);
        } else {
            return null;
        }

        if (count($field) < 2) {
            $escape_field = $this->db->real_escape_string(key($field));
            $escape_value = $this->db->real_escape_string($field[key($field)]);
            $where = "`" . $escape_field . "` = \"" . $escape_value;

        } elseif (count($field) >= 2) {
            foreach ($field as $key => $value) {
                $escape_field = $this->db->real_escape_string($key);
                $escape_value = $this->db->real_escape_string($value);
                if($key !== array_key_last($field)) {
                    $where .= "`" . $escape_field . "` = \"" . $escape_value . "\" " . $this->db->real_escape_string($operator) ." ";
                } else {
                    $where .= "`" . $escape_field . "` = \"" . $escape_value . "";
                }
            }
            $escape_field = implode(',', $escape_field);
        } else {
            return null;
        }

        $sql_statment = "SELECT `" . $escape_column . "` 
                         FROM   `" . $this->db->real_escape_string($table) . "` 
                         WHERE  " . $where . "\"";

        return Database::execute_sql($sql_statment);
    }

    public function getFieldById(int $id, string $column_name,  string $table){
        $sql_statment = "SELECT ".$this->db->real_escape_string($column_name)." FROM `".$table."` WHERE id = $id";
        return Database::execute_sql($sql_statment);
    }

    public function create(string $table, array $parameters): bool
    {
        $sql = "INSERT INTO `$table` (`id`, ";

        foreach ($parameters as $key => $parameter){
            if ($key != array_key_last($parameters))
                $sql .= "`$key`, ";
            else
                $sql .= "`$key`)";
        }
        $sql .= " VALUES (NULL, ";

        foreach ($parameters as $key => $parameter){
            if ($key != array_key_last($parameters))
                $sql .= "'$parameter', ";
            else
                $sql .= "'$parameter')";
        }

        if($this->query($sql))
            return true;
        else
            return false;
    }

    public function update(string $table, int $id, array $parameters): bool
    {
        $sql = "UPDATE `$table` SET ";

        foreach ($parameters as $key => $parameter){
            if ($key != array_key_last($parameters))
                $sql .= " `$key` = '$parameter',";
            else
                $sql .= " `$key` = '$parameter'";
        }
        $sql .= " WHERE `$table`.`id` = $id";

        if($this->query($sql))
            return true;
        else
            return false;
    }

    public function delete(string $table, int $id): bool
    {
        $sql = "DELETE FROM `$table` WHERE `$table`.`id` = $id;";

        if($this->query($sql))
            return true;
        else
            return false;
    }
}