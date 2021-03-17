<?php 
define('fromgames', true);
define('GAMENAME', 'KonoDraw');
include '../../website_parts/header.php';
require_once '../../lobby/init.php';
require_once '../../lobby/initcolyseuslobby.php';

?>
<div class="main" style="height:90%;" id="content">
<div class="centerlobby" style="font-family: 'DotGothic16', sans-serif;font-size:30px;">
<!-- <script src="smooth-curve.js"></script> -->
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


?>
<br>
    <div class="playerscenter">
        <ul class="players" id="playersection">
            <li><img src="../../lobby/player.png" width="100%" height="100%"><a><?php echo htmlspecialchars($_SESSION['nickname'], ENT_QUOTES, 'UTF-8'); ?>
            
        </ul>
    </div>


    <div id="start_game" class="centerbutton" style="display:none;">
        <button type="button" onClick="sendStartGame()">START</button>
    </div>
    <div id="waiting_message" class="centerlobby" style="font-family: 'DotGothic16', sans-serif;font-size:30px;display:none;" >
        <p>Waiting for host to start the game.</p>
    </div>

    

    <?php

    require_once '../../lobby/initcolyseus.php';
}
?>

</div>

<?php 

include '../../website_parts/footer.php';
?>