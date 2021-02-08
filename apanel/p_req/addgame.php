<?php 

require_once '../database/admin.php';

// Check if image file is a actual image or fake image

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
            // "File is an image - " . $check["mime"] . ".";
            $uploaderr = 0;
        } else {
            // "File is not an image.";
            $uploaderr = "The gived file is not an image";
        }

        // Check file size
        if ($_FILES["fileg"]["size"] > 500000) {
            //echo "Sorry, your file is too large.";
            $uploaderr = "Your file is too large";
        }
        
        
        // Allow certain file formats
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploaderr = "Only JPG, JPEG, PNG or GIF files are allowed";
        }

        if($admindb->getGame($_POST['gamename']))
        {
            $uploaderr = "Game name already exists";
        }
        
        
        // Check if $uploaderr is set to 0 
        if ($uploaderr === 0) {
            if (!move_uploaded_file($_FILES["fileg"]["tmp_name"], $target_file)) {
                //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                die("ERROR IN MOVING THE FILE. POSSIBLE OF THE PERMISSION");
                }
            
            $admindb->uploadGame($_POST['gamename'], $_POST['descgame'], $file_name);
            header("Location: index.php?success=1");
            die();
        } 
    }

}



?>