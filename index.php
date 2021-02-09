<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konopid</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="images/konopid-min.ico">
</head>
<body>
    <div class="default">
        <nav>
            <ul class="deful">
                <li><a href="index.php#pg1">Home</a></li>
                <li><a href="index.php#pg2">Games</a></li>
                <li><a href="index.php#pg3">Special</a></li>
                <li><a href="index.php#pg4">Social</a></li>
                <li><a href="index.php#pg4">Contact</a></li>
            </ul>
        </nav>

        <div class="main">
            <?php 
            require_once 'website_parts/displaygames.php';
            ?>

        </div>
        
        <div class="footer">
            <p>© Created by FoxBlood</p>
        </div>
    </div>

</body>
</html>