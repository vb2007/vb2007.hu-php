<?php
include_once("_config.php");

//létrehozza a táblát (ha nem létezik)
$mysqli->query("CREATE TABLE IF NOT EXISTS `pastebin`(
    `id`    int(11) NOT NULL AUTO_INCREMENT,
    `pasteTitle`  text NOT NULL,
    `paste` text DEFAULT NULL,
    `addedBy`   text DEFAULT NULL,
    `dateAdded` datetime DEFAULT NULL,
    PRIMARY KEY(`id`)
)");

//megnézi be van-e küldv a form (post)
if(isset($_POST['paste']) && isset($_POST['pasteTitle'])) {
    include "auth.php";

    //jelenleg bejelentkezett felhasználó neve
    $addedBy = $_SESSION['username'];

    //5 sec rate limit
    $query = $mysqli->prepare("SELECT dateAdded FROM pastebin WHERE addedBy = ? ORDER BY dateAdded DESC LIMIT 1");
    $query->bind_param("s", $addedBy);
    $query->execute();
    $result = $query->get_result();
    
    if($lastUrl = $result->fetch_assoc()) {
        $lastUrlTime = strtotime($lastUrl['dateAdded']);
        $currentTime = time();
        
        if(($currentTime - $lastUrlTime) < 5) {
            echo "Please wait 5 seconds between submitting pastes.";
            $mysqli->close();
            exit;
        }
    }

    $pasteTitle = $_POST["pasteTitle"];
    $paste = $_POST["paste"];

    //beteszi a linket a táblába
    $query = $mysqli->prepare("INSERT INTO pastebin (pasteTitle, paste, addedBy, dateAdded) VALUES (?, ?, ?, NOW())");
    $query->bind_param("sss", $pasteTitle, $paste, $addedBy);
    $query->execute();
    $query->close();

    $pasteId = mysqli_insert_id($mysqli);
    echo "Your paste has been uploaded. <br> You can view it at <a href='/paste?id=$pasteId'>https://vb2007.hu/paste?id=$pasteId</a>:" ;

    $mysqli->close();
    exit;
}
?>
