<?php

namespace Core\Table;

use Core\Database;

/**
 * Class Table
 * Class mère des tables gérant les requêtes
 */
class Table
{
    /**
     * Table instancié
     */
    protected $table;
    
    /**
     * Instance d'accès à la base de donnée
     */
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
    
    /**
     * Récupère toutes les données d'une table
     */
    public function getAll()
    {
        return $this->query('SELECT * FROM ' . $this->table);
    }
    
    /**
     * Récupère toutes les données d'une table via une id
     */
    public function find($id)
    {
        return $this->query("SELECT * FROM " . $this->table . "WHERE id = ?", $id, true);
    }
    
    /**
     * Mise à jour des données via une id
     */
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
    
    /**
     * Insertion de donnée dans une table
     */
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
    
    /**
     * Suppréssion de donnée dans une table via une id
     */
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
    
    public function lastInsert()
    {
        return $this->db->lastInsertId();
    }
}
