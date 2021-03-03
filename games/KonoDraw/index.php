<?php 
define('fromgames', true);
define('GAMENAME', 'KonoDraw');
include '../../website_parts/header.php';

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