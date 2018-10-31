<?php

class ReviewDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT Comment, ReviewDate, Rating
                FROM Reviews';
    }
    
    protected function getKeyField ()
    {
        return 'RatingID';
    }
    
    protected function getOrderByField()
    {
        return 'ReviewDate';
    }
    
    public function findByPaintingID ($paintingID)
    {
        return 'SELECT Reviews.Comment, Reviews.ReviewDate, Reviews.Rating
                FROM Reviews NATURAL JOIN Paintings
                WHERE Paintings.PaintingID = ' . $paintingID;
    }
    
    public function getCount ($paintingID)
    {
        return 'SELECT COUNT(Reviews.Rating)
                FROM Reviews NATURAL JOIN Paintings
                WHERE Paintings.PaintingID = ' . $paintingID;
    }
}

?>