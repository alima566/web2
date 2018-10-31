<?php

class GalleryDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, GalleryWebsite, Latitude, Longitude
                FROM Galleries';
    }
    
    protected function getKeyField ()
    {
        return 'GalleryID';
    }
    
    protected function getOrderByField ()
    {
        return 'GalleryName';
    }
    
    public function findByPainting ($galleryID)
    {
        return 'SELECT Paintings.PaintingID, Paintings.ImageFileName, Paintings.Title
                FROM Paintings NATURAL JOIN Galleries 
                WHERE Paintings.GalleryID = ' . $galleryID . '
                ORDER BY YearOfWork';
    }
}

?>