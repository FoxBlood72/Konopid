<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konopid</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <?php 
    if(defined('fromgames'))
    {
        ?>
        <link rel="stylesheet" href="../../css/header.css">
        <link rel="stylesheet" href="../../css/main.css">
        <link rel="icon" href="../../images/konopid-min.ico">
        <link rel="stylesheet" href="../../css/fancyinp/fancyInput.css">
        <script src='../../css/fancyinp/fancyInput.js'></script>
        <?php
    }
    else
    {
        ?>
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" href="images/konopid-min.ico">
        <link rel="stylesheet" href="css/fancyinp/fancyInput.css">
        <script src='css/fancyinp/fancyInput.js'></script>
        <?php 
    }
    ?>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="default">
        <nav>
            <ul class="deful">
                <?php 
                if(defined('fromgames'))
                {
                ?>
                    <li><a href="../../index.php#pg1">Home</a></li>
                    <li><a href="../../index.php#pg2">Games</a></li>
                    <li><a href="../../index.php#pg3">Special</a></li>
                    <li><a href="../../index.php#pg4">Social</a></li>
                    <li><a href="../../index.php#pg4">Contact</a></li>
                <?php 
                }
                else
                {
                ?>
                    <li><a href="index.php#pg1">Home</a></li>
                    <li><a href="index.php#pg2">Games</a></li>
                    <li><a href="index.php#pg3">Special</a></li>
                    <li><a href="index.php#pg4">Social</a></li>
                    <li><a href="index.php#pg4">Contact</a></li>
                <?php 
                }
                ?>
            </ul>
        </nav>