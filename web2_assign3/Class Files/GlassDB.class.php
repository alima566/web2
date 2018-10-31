<?php

class GlassDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT GlassID, Title, Price
                FROm TypesGlass';
    }
    
    protected function getKeyField ()
    {
        return 'GlassID';
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
                FROM TypesGlass
                WHERE GlassID = ' . $id;
    }
}

?>