<?php

class PaintingDB extends AbstractDataAccess implements JsonSerializable
{
    private $id;
    private $title;
    private $description;
    private $firstName;
    private $lastName;
    private $image;
    private $cost;
    
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    public function jsonSerialize ()
    {
        return ['PaintingID' => $this -> id, 'Title' => $this -> title, 'Description' => $this -> description,
                'FirstName' => $this -> firstName, 'LastName' => $this -> lastName, 'MSRP' => $this -> cost,
                'ImageFileName' => $this -> image];
    }
    
    protected function getSelect ()
    {
        return 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.Excerpt, Paintings.MSRP, Paintings.ImageFileName, Paintings.YearOfWork, Paintings.Medium, Paintings.Height, Paintings.Width, Artists.ArtistID, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists';
    }
    
    protected function getKeyField ()
    {
        return 'PaintingID';
    }
    
    protected function getOrderByField ()
    {
        return 'YearOfWork LIMIT 20';
    }
    
    public function findByArtist ($artistID) 
    {
        return 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.Excerpt, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.ArtistID = ' . $artistID . '
                ORDER BY Paintings.YearOfWork LIMIT 20';
    }
    
    public function findByGallery ($galleryID)
    {
        return 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.Excerpt, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                JOIN Galleries USING (GalleryID)
                WHERE Paintings.GalleryID = ' . $galleryID . '
                ORDER BY Galleries.GalleryName LIMIT 20';
    }
    
    public function findByShape ($shapeID)
    {
        return 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.Excerpt, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                JOIN Shapes USING (ShapeID)
                WHERE Paintings.ShapeID = ' . $shapeID . '
                ORDER BY Paintings.YearOfWork LIMIT 20';
    }
    
    public function getSearchResults ($searchFor)
    {
        return 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.Excerpt, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.Title LIKE "' . $searchFor . '"
                ORDER BY Paintings.YearOfWork LIMIT 20';
    }
    public function getSearchBarResults ($searchFor)
    {
        return 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.Excerpt, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.Title LIKE "' . $searchFor . '"
                ORDER BY Paintings.YearOfWork';
    }
    
    public function getLinks ($paintingID)
    {
        return 'SELECT WikiLink, GoogleLink, GoogleDescription
                FROM Paintings
                WHERE PaintingID = ' . $paintingID;
    }
    
    public function getCost ($paintingID)
    {
        return 'SELECT MSRP
                FROM Paintings
                WHERE PaintingID = ' . $paintingID;
    }
    
    public function getMuseum ($paintingID)
    {
        return 'SELECT Galleries.GalleryID, Galleries.GalleryName, Paintings.AccessionNumber, Paintings.CopyrightText, Galleries.GalleryWebSite
                FROM Paintings NATURAL JOIN Galleries
                WHERE Paintings.PaintingID = ' . $paintingID;
    }
    
    public function findByPainting ($paintingID)
    {
        return 'SELECT PaintingID, ImageFileName, Description, Excerpt, Title, MSRP
                FROM Paintings
                WHERE PaintingID = ' . $paintingID;
    }
}

?>