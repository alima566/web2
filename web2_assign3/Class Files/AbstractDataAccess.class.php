<?php

abstract class AbstractDataAccess
{
    private $connect;
    public function __construct ($connect)
    {
        $this -> connect = $connect;
    }
    
    protected function getConnect ()
    {
        return $this -> connect;
    }
    
    public function getAll ($sql)
    {
        if (is_null($sql))
        {
            $sql = $this -> getSelect() . ' ORDER BY ' . $this -> getOrderByField();
        }
        
        $statement = DBHelper::runQuery($this -> getConnect(), $sql, null);
        return $statement;
    }
    
    public function findByID ($id)
    {
        $sql = $this -> getSelect() . ' WHERE ' . $this -> getKeyField() . ' = ?';
        return DBHelper::runQuery($this -> getConnect(), $sql, $id);
    }
    
    public function findByName ($name)
    {
        $sql = $this -> getSelect() . ' WHERE ' . $this -> getKeyName() . ' = ?';
        return DBHelper::runQuery($this -> getConnect(), $sql, $name);
    }
    abstract protected function getSelect();
    
    abstract protected function getKeyField();
    
    
    abstract protected function getOrderByField();
}

?>