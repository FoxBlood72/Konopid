<?php 
include 'init.php';
include 'config.php';

class KonopidDatabaseUser extends DataBaseKonopidBase{
    function __construct($user, $pass, $datab = '', $host = 'localhost', $port = 3306)
    {
        parent::__construct($user, $pass, $datab, $host, $port);
    }

    function getGames()
    {
        $stmt = $this->odb->query("SELECT * FROM games WHERE active = 1");
        return $stmt;
    }
    
}

$userdb = new KonopidDatabaseUser($USERNAME, $PASSWORD, $DB_NAME, $HOST, $PORT);

?>