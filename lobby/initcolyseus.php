<script src="../../js/colyseus.js"></script>
<script>
    
    var host = (window.document.location.host || "localhost").replace(/:.*/, '');
    var client = new Colyseus.Client('ws://' + host + ':2567');
    var room;


    function addPlayerHtml(nickname)
    {
        var ul_players = document.getElementById('playersection');

        var anchor_player = document.createElement('a');
        anchor_player.innerHTML = nickname;

        var img_player = document.createElement('img');
        img_player.setAttribute('src', '../../lobby/player.png');
        img_player.setAttribute('width', '100%');
        img_player.setAttribute('height', '100%');

        var li_player = document.createElement('li');
        li_player.setAttribute('id', nickname);
        li_player.appendChild(img_player);
        li_player.appendChild(anchor_player);

        ul_players.appendChild(li_player);
    }


    function removePlayerHtml(nickname)
    {
        var li_player = document.getElementById(nickname);
        li_player.parentNode.removeChild(li_player);
    }

    function addListeners (room) {
        room.onMessage("new_player_lobby", (message) => {
            console.log("received player:", message);
            addPlayerHtml(message);
        });

        room.onMessage("player_left_lobby", (message) => {
            console.log("player left:", message);
            removePlayerHtml(message);
        });

        room.onMessage("owner_it", (message) => {
            console.log("You are the owner now!");
            showStartButton();
        });

        room.onMessage("not_owner", (message) => {
            console.log("You are not the owner!");
            showWaitingMessage();
        });

        room.onMessage("game_started", (message) => {
            console.log("The Game just started!");
            startGame();
        });
    }


    function join () {
            client.joinOrCreate('konodraw', { session: "<?php echo htmlspecialchars($_SESSION['lobby_' . GAMENAME], ENT_QUOTES, 'UTF-8'); ?>", nickname: <?php echo '"' . htmlspecialchars($_SESSION['nickname'], ENT_QUOTES, 'UTF-8') . '"'; ?> }).then((r) => {
        
            room = r;
            addListeners(room);
            
          
        }).catch(e => {

            console.error(e.code, e.message);
         
        });
    }

    function create () {
          client.joinOrCreate('konodraw', { session: "<?php echo htmlspecialchars($_SESSION['lobby_' . GAMENAME], ENT_QUOTES, 'UTF-8'); ?>", nickname: <?php echo '"' . htmlspecialchars($_SESSION['nickname'], ENT_QUOTES, 'UTF-8') . '"'; ?>  }).then((r) => {
              room = r
              addListeners(room);
              
          });
    }

    function showStartButton()
    {
        document.getElementById("waiting_message").style.display = "none";
        document.getElementById("start_game").style.display = "block";
    }

    function showWaitingMessage()
    {
        document.getElementById("waiting_message").style.display = "block";
        document.getElementById("start_game").style.display = "none";
    }

    function sendStartGame()
    {
        room.send("start_game", undefined);
    }

    function startGame()
    {

        // The javascript cannot be executed when directly included with ajax
        // I implemented to be evaluated with a second ajax request
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var content_place = document.getElementById("content");
                content_place.innerHTML = this.responseText;
                var script_url = content_place.querySelector('#scr').attributes.src.value;
                var xhttp_script = new XMLHttpRequest();
                xhttp_script.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200){
                        //console.log("Received the script " + this.response);
                        eval(this.response);
                    }
                }

                xhttp_script.open("GET", script_url, true);
                xhttp_script.send();
            }
        }

        xhttp.open("GET", "game.php", true);
        xhttp.send();
    }

    


      <?php 
    if($create)
    {
        echo 'create();';
        echo 'showStartButton();';
    }
    else
    {
        echo 'join();';
        echo 'showWaitingMessage();';
    }
      ?>


</script>
