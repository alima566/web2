<?php

class MattDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT MattID, Title
                FROM TypesMatt';
    }
    
    protected function getKeyField ()
    {
        return 'MattID';
    }
    
    protected function getOrderByField ()
    {
        return 'Title';
    }
    
    public function getTitle ($id)
    {
        return 'SELECT Title
                FROM TypesMatt
                WHERE MattID = ' . $id;
    }
}

?>