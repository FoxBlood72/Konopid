<?php 
define('fromgames', true);
include '../../website_parts/header.php';
?>

<div class="main">
        <div class="maincanvas">
            <canvas height="450px" width="1000px" id="canv"></canvas>
            <br>
            <input type="color" name="pencol" value="#000000">
            <input type="range" step="2" value="5" name="penwidth" min="1" max="100">
            <button name="rrbutton" style="float:right;">Clear</button>
            <script src="script.js"></script>
        </div>
</div>

<?php 
include '../../website_parts/footer.php';
?>