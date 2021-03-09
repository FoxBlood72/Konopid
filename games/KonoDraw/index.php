<?php 
define('fromgames', true);
define('GAMENAME', 'KonoDraw');
include '../../website_parts/header.php';
require_once '../../lobby/initservercolyseus.php'; 
?>
<div class="main" style="height:90%;">

<?php 
    if(isset($err) && $err === 1)
    {
        ?>
        <a href="#" style="text-decoration:none;cursor:default;color:rgb(253, 36, 47);"><?php echo $errmsg[$err-1]; ?></a>
        <?php
    }

    if((isset($err) && $err !== 1) || !isset($err))
    {
?>
            <div class="centerlobby" style="font-family: 'DotGothic16', sans-serif;font-size:30px;">
                <a href="#" style="text-decoration:none;cursor:default;color:rgb(253, 36, 47);"><?php if(isset($err)) echo $errmsg[$err-1]; else echo 'Please enter your nickname!'; ?></a>
            </div>
            <form method="post" action="index.php">
                <div class="centerbutton">
                    <div class="custom-input">
                        <input name="nickname" id="nickn" onFocusOut="addplaceholder()" onClick="removeplaceholder()" type="text" placeholder="Max 10 characters" >
                    </div>
                </div>
                <br>

                <div class="centerbutton">
                    <?php if(!$createRoom) echo '<input name="lobbyses" value="'. htmlspecialchars($_GET['ses'], ENT_QUOTES, 'UTF-8') .'" type="hidden"/>' ?>
                    
                    <button name="submitnick" type="submit">Enter</button>
                </div>
            </form>

            <div class="">

            </div>

            <?php 
    }
            ?>
</div>

<script>

function removeplaceholder()
{
    document.getElementById('nickn').placeholder = "";
}

function addplaceholder()
{
    document.getElementById('nickn').placeholder = "Max 10 characters";
}

</script>

<?php 
include '../../website_parts/footer.php';
?>