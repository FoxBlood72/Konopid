<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../database/admin.php';
if(isset($_GET['del']))
{
    $id = $_GET['del'];
    if($admindb->removeGame($id))
        header("Location: index.php?success=2");
    else
        header("Location: index.php?fail=1");

    die();
}

?>