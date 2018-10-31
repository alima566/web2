<?php 

class DBHelper
{
    /**
     * Creates a connection to the database
     */
    public static function createConnection ($values=array())
    {
        $pdo = new PDO ($values[0], $values[1], $values[2]);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    
    /**
     * Runs the SQL query
     */ 
    public static function runQuery ($pdo, $sql, $paramaters=array())
    {
        if (!is_array($paramaters))
        {
            $paramaters = array($paramaters);
        }
        
        try
        {
            $statement = null;
            if (count($paramaters) > 0)
            {
                $statement = $pdo -> prepare($sql);
                $statement -> execute($paramaters);
            }
            else
            {
                $statement = $pdo -> query($sql);
            }
            return $statement;
        }
        catch (PDOException $e)
        {
            die($e -> getMessage());
        }
    }
}

?>