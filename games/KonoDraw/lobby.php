<?php 
define('fromgames', true);
define('GAMENAME', 'KonoDraw');
include '../../website_parts/header.php';
require_once '../../lobby/init.php';

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
<div class="main" style="height:90%;">
<div class="centerlobby" style="font-family: 'DotGothic16', sans-serif;font-size:30px;">
<?php 
    if(isset($err) && $err === 1)
    {
        ?>
        
        <a href="#" style="text-decoration:none;cursor:default;color:rgb(253, 36, 47);">CANNOT ENTER IN YOUR OWN LOBBY</a>

        <?php
    }
    else
    {
    ?>

        <p style="margin:0px; padding:0px;cursor:default;">INVITE LINK:</p>
        <a href="<?php echo htmlspecialchars($actual_link, ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration:none;color:rgb(253, 36, 47);" target="_blank"><?php echo htmlspecialchars($actual_link, ENT_QUOTES, 'UTF-8'); ?></a>
        
        
    <?php 
    }   
?>
</div>
<?php 
if(!isset($err))
{

require_once '../../lobby/initcolyseus.php';
?>
<br>
    <div class="playerscenter">
        <ul class="players" id="playersection">
            <li><img src="../../lobby/player.png" width="100%" height="100%"><a><?php echo htmlspecialchars($_SESSION['nickname'], ENT_QUOTES, 'UTF-8'); ?>
            
        </ul>
    </div>


    <div class="centerbutton">
        <button type="button">START</button>
    </div>

<?php 
}
?>

</div>

<?php 

include '../../website_parts/footer.php';
?>