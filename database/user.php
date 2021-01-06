<?php 
include 'init.php';
include 'config.php';

class KonopidDatabaseAdmin extends DataBaseKonopidBase{
    function __construct($user, $pass, $datab = '', $host = 'localhost', $port = 3306)
    {
        parent::__construct($user, $pass, $datab = '', $host = 'localhost', $port = 3306);
    }
}

?>