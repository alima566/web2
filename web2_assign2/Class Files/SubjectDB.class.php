<?php

class SubjectDB extends AbstractDataAccess
{
    public function __construct ($connect)
    {
        parent::__construct($connect);
    }
    
    protected function getSelect ()
    {
        return 'SELECT SubjectID, SubjectName
                FROM Subjects';
    }
    
    protected function getKeyField ()
    {
        return 'SubjectID';
    }
    
    protected function getOrderByField()
    {
        return 'SubjectName';
    }
    
    public function findBySubject ($subjectID)
    {
        return 'SELECT DISTINCT Paintings.PaintingID, Paintings.ImageFileName, Paintings.Title
                FROM Paintings NATURAL JOIN PaintingSubjects 
                INNER JOIN Subjects USING (SubjectID) 
                WHERE Subjects.SubjectID = ' . $subjectID . '
                ORDER BY YearOfWork';
    }
    
    public function findByPaintingSubject ($paintingID)
    {
        return 'SELECT Subjects.SubjectName, Subjects.SubjectID
                FROM Subjects NATURAL JOIN PaintingSubjects
                WHERE PaintingSubjects.PaintingID = ' . $paintingID;
    }
}

?>