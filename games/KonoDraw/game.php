
<div class="maincanvas" style="float:left;">
    <canvas id="canv" id="canv" height="400" width="955"></canvas>
    <br>
    <input type="color" name="pencol" value="#000000">
    <input type="range" step="2" value="5" name="penwidth" min="1" max="100">
    <button name="rrbutton" style="float:right;">Clear</button>
</div>
<div class="chatbox" id="chat">
    <div class="speech-bubble">
        <p>Messageasfsafasfsafassafsafsafasfasasfsafsafsafasfsafasf</p>
    </div>

    <div class="speech-bubble">
        <p>Message</p>
    </div>
    <div class="speech-bubble">
        <p>Message</p>
    </div>
    <div class="speech-bubble">
        <p>Message</p>
    </div>
    <div class="owner-bubble">
        <p></p>
    </div>

    
</div>

<form method="post" id="msg_form" onSubmit="return false">
    <div class="fancyInput">
        <input type="text" id="fancyinp">
    </div>
    <button id="submit_msg" type="submit" name="submitmsg" style="float:right;width:5%;">Send</button>
</form> 

<script src="gamescript.js" id="scr"></script>