<?php
class DataBaseKonopidBase{
    function __construct($user, $pass, $datab = '', $host = 'localhost', $port = 3306)
    {
        try{
            $this->odb = $dbh = new PDO('mysql:dbname='. $datab .';host=' . $host . ';port=' . $port, $user, $pass);
        }catch(PDOException $e){
            echo 'Database Unavailable: ' . $e->getMessage();
            return;
        }

        $this->odb->query('CREATE TABLE IF NOT EXISTS `admins` (
         `ID` INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
         `username` VARCHAR(100) NOT NULL,
         `password` VARCHAR(100) NOT NULL
          )');

        $this->odb->query('CREATE TABLE IF NOT EXISTS `games`
        (`ID` int(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
         `gamename` VARCHAR(100) NOT NULL,
         `description` VARCHAR(100) NOT NULL,
         `url` VARCHAR(400) NOT NULL,
         `active` int(6) NOT NULL
         )');
    }

    function to_array()
    {
        
    }

}


?>