<?php

class GenreDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT GenreID, GenreName, Description
                FROM Genres';
    }
    
    protected function getKeyField ()
    {
        return 'GenreID';
    }
    
    protected function getOrderByField()
    {
        return 'EraID, GenreName';
    }
    
    public function findByPainting ($paintingID)
    {
        return 'SELECT Paintings.PaintingID, Paintings.ImageFileName, Paintings.Title
                FROM Paintings NATURAL JOIN PaintingGenres
                JOIN Genres USING (GenreID)
                WHERE Genres.GenreID = ' . $paintingID . '
                ORDER BY Paintings.YearOfWork';
    }
    
    public function findByPaintingGenre ($paintingID)
    {
        return 'SELECT Genres.GenreName, Genres.GenreID
                FROM Genres NATURAL JOIN PaintingGenres
                WHERE PaintingGenres.PaintingID = ' . $paintingID;
    }
}

?>