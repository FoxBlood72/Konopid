<?php 
if(defined('GAMENAME'))
{
    require_once('../../utility/randomstring.php');
    session_start();
    if(!isset($_SESSION['lobby_' . GAMENAME]))
    {
        $_SESSION['lobby_' . GAMENAME] = generateRandomString(6);
    }
}

?>