<?php

class FrameDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT FrameID, Title, Price
                FROM TypesFrames';
    }
    
    protected function getKeyField ()
    {
        return 'FrameID';
    }
    
     protected function getKeyName ()
    {
        return 'Title';
    }
    
    protected function getOrderByField ()
    {
        return 'Title';
    }
    
    public function getTitle ($id)
    {
        return 'SELECT Title
                FROM TypesFrames
                WHERE FrameID = ' . $id;
    }
    
    // public function getPriceByName ($name)
    // {
    //     return 'SELECT Price
    //             FROM TypesFrames
    //             WHERE FrameID =' . $name;
    // }
    
}

?>