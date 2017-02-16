<?php

namespace Core\Table;

use Core\Database;

class Table
{
    protected $table;
    protected $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
        
        if (is_null($this->table)) {
            $slice = explode('\\', get_class($this));
            $class_name = end($slice);
            $table = strtolower(str_replace('Table', '', $class_name));
            $this->table = $table;
        }
    }
    
    public function getAll()
    {
        return $this->query('SELECT * FROM ' . $this->table);
    }
    
    public function find($id)
    {
        return $this->query("SELECT * FROM " . $this->table . "WHERE id = ?", $id, true);
    }
    
    public function update($id, $fields)
    {
        $sql_slice = [];
        $attributes = [];
        
        foreach($fields as $field => $value)
        {
            $sql_slice[] = "$field = ?";
            $attributes[] = $value;
        }
        
        $attributes[] = $id;
        $sql_part = implode(', ', $sql_slice);
        
        return $this->query("UPDATE {$this->table} SET " . $sql_part . " WHERE id = ?", $attributes, true);
    }
    
    public function create($fields)
    {
        $sql_slice = [];
        $attributes = [];
        
        foreach($fields as $field => $value)
        {
            $sql_slice[] = "$field = ?";
            $attributes[] = $value;
        }
        
        $sql_part = implode(', ', $sql_slice);
        
        return $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
    }
    
    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE  id = ?", [$id], true);
    }
    
    public function extract($key, $value)
    {
        $records = $this->getAll();
        $return = [];
        foreach($records as $v)
        {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }
    
    public function query($statement, $attributes = null, $one = false)
    {
        if($attributes)
        {
            return $this->db->prepare(
                $statement, 
                $attributes, 
                str_replace('Table', 'Entity', get_class($this)), 
                $one
            );
        } else {
            return $this->db->query(
                $statement,
                str_replace('Table', 'Entity', get_class($this)), 
                $one
            );
        }
    }
}