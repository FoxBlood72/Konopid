<?php
session_start();
require_once '../database/admin.php'; 
if(isset($_SESSION['admin']) && isset($_SESSION['adminuser']) && $_SESSION['admin'] === true)
{
    header("Location: index.php");
    die();
}

if(isset($_POST['username']) && isset($_POST['pwd']))
{
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $r = $admindb->getAdmin($username);
    if(password_verify($pwd, $r['password']))
    {
        $_SESSION['admin'] = true;
        $_SESSION['adminuser'] = $r['username'];
        header('Location: index.php');
        die();
    }
    else
    {
        $errpwd = true;
    }
}

?>