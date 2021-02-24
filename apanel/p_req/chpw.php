<?php 
defined('ADMINLOGED') or die();
require_once '../database/admin.php';


if(isset($_POST['cpwd']) && isset($_POST['npwd']))
{
    $r = $admindb->getAdmin($_SESSION['adminuser']);
    $pwd = $_POST['npwd'];
    if(password_verify($_POST['cpwd'], $r['password']))
    {
        $admindb->changePassword($_SESSION['adminuser'], $pwd);
        $err = false;
    }
    else
    {
        $err = true;
    }
}

?>