<?php
require 'includes/functions.inc.php';

class ServicePaintingDB implements JsonSerializable
{
    private $id;
    private $title;
    private $description;
    private $firstName;
    private $lastName;
    private $image;
    private $cost;
    
    public function jsonSerialize ()
    {
        return ['id' => $this -> id, 'title' => $this -> title, 'description' => $this -> description,
                'first' => $this -> firstName, 'last' => $this -> lastName, 'MSRP' => $this -> cost,
                'imageFileName' => $this -> image];
    }
    // $db = connectToDB();
    // $painting = new PaintingDB ($db);
    
    // if (isset($_GET['artist']) && !empty($_GET['artist']))
    // {
    //     $sql = $painting -> findByArtist($_GET['artist']);
    // }
    // else
    // {
    //     //$sql = $painting -> getAll(null);
    // }
    
    // $results = $painting -> getAll($sql);
    
    // header('Content-Type: application/json');
    // echo json_encode($results);

}
?>