<?php

class ArtistDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT ArtistID, FirstName, LastName, YearOfBirth, YearOfDeath, Details, Gender, Nationality, ArtistLink
                FROM Artists';
    }
    
    protected function getKeyField ()
    {
        return 'ArtistID';
    }
    
    protected function getOrderByField()
    {
        return "LastName, FirstName";
    }
    
    public function findByArtist ($artistID)
    {
        return 'SELECT PaintingID, ImageFileName, Title, MSRP, Description, Excerpt, FirstName, LastName
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.ArtistID = ' . $artistID . '
                ORDER BY Paintings.YearOfWork LIMIT 20';
    }
}

?>