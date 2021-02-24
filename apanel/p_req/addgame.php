<?php 
defined('ADMINLOGED') or die();
require_once '../database/admin.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST["submitg"]) && isset($_POST['gamename']) && isset($_POST['descgame'])) {
    
    $target_dir = "../images/games/";
    
    
    if(!isset($_FILES['fileg']))
        $uploaderr = "Photo cannot be empty!";
    else
    {
        $hfile = hash_file('md5', $_FILES["fileg"]["tmp_name"]);
        $imageFileType = strtolower(pathinfo($_FILES["fileg"]["name"], PATHINFO_EXTENSION));
        $file_name = $hfile . "." . $imageFileType;
        $target_file = $target_dir . $file_name;

        $check = getimagesize($_FILES["fileg"]["tmp_name"]);

        
        if($check !== false) {
            
            $uploaderr = 0;
        } else {
            
            $uploaderr = "The gived file is not an image";
        }

        
        if ($_FILES["fileg"]["size"] > 500000) {
            
            $uploaderr = "Your file is too large";
        }
        
        
        
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            
            $uploaderr = "Only JPG, JPEG, PNG or GIF files are allowed";
        }

        if($admindb->getGame($_POST['gamename']))
        {
            $uploaderr = "Game name already exists";
        }
        
        
        
        if ($uploaderr === 0) {
            if (!move_uploaded_file($_FILES["fileg"]["tmp_name"], $target_file)) {
                //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                die("ERROR IN MOVING THE FILE. POSSIBLE OF THE PERMISSION");
                }
            
            $admindb->uploadGame($_POST['gamename'], $_POST['descgame'], $file_name);

            if(!file_exists('../games/'))
                if(!mkdir('../games', 0755))
                    die('Cannot create the \'games/\' folder, please grant permission to the following folder: main directory');
            
            if(!file_exists('../games/' . $_POST['gamename']))
                if(!mkdir('../games/' . $_POST['gamename'], 0755))
                    die('Cannot create the folder! Please grant permission to the following folder: games');
                
            copy('templates/phptemplate', '../games/' .$_POST['gamename'] . '/index.php');
            copy('templates/scripttemplate', '../games/' .$_POST['gamename'] . '/script.js');
                
            header("Location: index.php?success=1");
            die();
        } 
    }

}



?>