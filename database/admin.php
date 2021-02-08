<?php 
include 'init.php';
include 'config.php';

class KonopidDatabaseAdmin extends DataBaseKonopidBase{
    function __construct($user, $pass, $datab = '', $host = 'localhost', $port = 3306)
    {
        parent::__construct($user, $pass, $datab, $host, $port);
        $r = $this->getAdmin('admin');
        if(!$r)
            $this->insertAdmin('admin', 'admin');
    }

    function insertAdmin($username, $password)
    {
        $hpassword = password_hash($password, PASSWORD_DEFAULT);
        $payload = array(":username" => $username, ":password" => $hpassword);
        $stmt = $this->odb->prepare("INSERT INTO `admins` VALUES(NULL, :username, :password)");
        $stmt->execute($payload);
    }

    function getAdmin($username)
    {
        $payload = array(":username" => $username);
        $stmt = $this->odb->prepare("SELECT * FROM `admins` WHERE username = :username");
        $stmt->execute($payload);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    function changePassword($username, $newpass)
    {
        $hpassword = password_hash($newpass, PASSWORD_DEFAULT);
        $payload = array(":username" => $username, ":newpass" => $hpassword);
        $stmt = $this->odb->prepare("UPDATE `admins` SET password = :newpass WHERE username = :username");
        $stmt->execute($payload);
    }

    function uploadGame($gamename, $gamedesc, $photopath)
    {
        $payload = array(":gamename" => $gamename, ":gamedesc" => $gamedesc, ":photopath" => $photopath);
        $stmt = $this->odb->prepare("INSERT INTO games VALUES(NULL, :gamename, :gamedesc, :photopath, 0)");
        $stmt->execute($payload);
    }

    function getGame($game_name)
    {
        $payload = array(":gamename" => $game_name);
        $stmt = $this->odb->prepare("SELECT * FROM games WHERE gamename = :gamename");
        $stmt->execute($payload);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getGames()
    {
        $stmt = $this->odb->query("SELECT * FROM games");
        return $stmt;
    }

    function removeGame($id)
    {
        $payload = array(":id" => $id);
        $stmt = $this->odb->prepare("SELECT ID, url FROM games WHERE ID = :id");
        $stmt->execute($payload);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row)
            return false;
        
        $stmt = $this->odb->prepare("DELETE FROM games WHERE ID = :id");
        $stmt->execute($payload);
        unlink('../images/games/' . $row['url']);

        return true;
    }

    function modifyGame($id, $gametitle, $gamedesc, $active)
    {
        $payload = array(":id" => $id, ":gamename" => $gametitle, ":desc" => $gamedesc, ":act" => $active);
        $stmt = $this->odb->prepare("UPDATE games SET gamename = :gamename, description = :desc, active = :act WHERE ID = :id ");
        $stmt->execute($payload);
    }

}

$admindb = new KonopidDatabaseAdmin($USERNAME, $PASSWORD, $DB_NAME, $HOST, $PORT);

?>