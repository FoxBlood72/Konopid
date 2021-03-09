<?php
if(isset($_GET['ses']))
{
    if($_GET['ses'] === $_SESSION['lobby_' . GAMENAME])
    {
        $err = 1;
    }
    else
    {
        header("Location: index.php?ses=" . $_GET['ses']);
        die();
    }
    
}

if(!isset($_SESSION['lobby_' . GAMENAME . '_aproved']))
{
    header('Location: index.php');
    die();
}

if(isset($_SESSION['lobby_' . GAMENAME . '_invited']) && $_SESSION['lobby_' . GAMENAME . '_invited'])
    $create = false;
else
    $create = true;

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link .= '?ses=' . $_SESSION['lobby_' . GAMENAME];

?>