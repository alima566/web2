<?php

class ShapeDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT ShapeID, ShapeName
                FROM Shapes';
    }
    
    protected function getKeyField ()
    {
        return 'ShapeID';
    }
    
    protected function getOrderByField ()
    {
        return 'ShapeName';
    }
}

?>