<?php 

include 'website_parts/header.php';

?>

<div class="main" >
        <div class="maincanvas" style="float:left;">
            <canvas id="canv" height="400" width="955"></canvas>
            <br>
            <input type="color" name="pencol" value="#000000">
            <input type="range" step="2" value="5" name="penwidth" min="1" max="100">
            <button name="rrbutton" style="float:right;">Clear</button>
            <script src="script.js"></script>
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

                
            
            
                <form method="post">
                    <div class="fancyInput">
                        <input type="text" id="fancyinp">
                    </div>
                    <button type="submit" name="submitmsg" style="float:right;width:5%;">Send</button>
                </form>
       
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src='css/fancyinp/fancyInput.js'></script>
        <script>
            $('#fancyinp').fancyInput();
        </script>
        
        
</div>




<?php 
include 'website_parts/footer.php';
?>