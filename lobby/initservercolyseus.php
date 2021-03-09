<?php 
if(isset($_GET['ses']))
{
    if($_GET['ses'] === $_SESSION['lobby_' . GAMENAME])
    {
        $err = 1;
    }
    $createRoom = false;
}
else
{
    require_once '../../lobby/init.php';
    $createRoom = true;
}



if(isset($_POST['submitnick']) && isset($_POST['nickname']))
{
    $nick = trim($_POST['nickname']);
    if(strlen($nick) >= 10)
        $err = 2;
    else
    if(strlen($nick) <= 2)
        $err = 3;
    else
    if(preg_match('/\s/',$nick))
        $err = 4;

    if(!isset($err))
    {
        $_SESSION['nickname'] = $nick;
        $_SESSION['lobby_' . GAMENAME . '_aproved'] = true;
        if(isset($_POST['lobbyses']))
        {
            $_SESSION['lobby_' . GAMENAME] = $_POST['lobbyses'];
            $_SESSION['lobby_' . GAMENAME . '_invited'] = true;
        }
        header("Location: lobby.php");
        die();
    }
}

if(isset($err))
{
    $errmsg = ['CANNOT ENTER IN YOUR OWN LOBBY', 'The nickname is too long! Please retry', 'The nickname is too short! PLease retry', 'The nickname contains whitespaces! Please retry'];
}

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link .= '?ses=' . $_SESSION['lobby_' . GAMENAME];
?>