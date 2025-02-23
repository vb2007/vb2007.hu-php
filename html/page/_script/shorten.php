<?php
include_once("_config.php");

//létrehozza a táblát (ha nem létezik)
$mysqli->query("CREATE TABLE IF NOT EXISTS `urlShortener`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `url` text NOT NULL,
    `shortUrl` text NOT NULL,
    `addedBy` text DEFAULT NULL,
    `dateAdded` datetime DEFAULT NULL,
    `votes` int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY(`id`)
)");

//random url generáló függvény
function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

//megnézi be van-e küldv a form (post)
if(isset($_POST['url'])) {
    include "auth.php";
    $url = $_POST['url'];

    //megnézi az adatbázisban hogy rövidítve lett-e már a hosszú link
    $query = $mysqli->prepare("SELECT url FROM urlShortener WHERE url = ?");
    $query->bind_param("s", $url);
    $query->execute();
    
    //ha igen, a már rövidített linket használja
    if($row = $query->fetch()) {
        $shortUrl = $row['shortUrl'];
    }
    else{
        //jelenleg bejelentkezett felhasználó neve
        $addedBy = $_SESSION['username'];

        //5 sec rate limit
        $query = $mysqli->prepare("SELECT dateAdded FROM urlShortener WHERE addedBy = ? ORDER BY dateAdded DESC LIMIT 1");
        $query->bind_param("s", $addedBy);
        $query->execute();
        $result = $query->get_result();
        
        if($lastUrl = $result->fetch_assoc()) {
            $lastUrlTime = strtotime($lastUrl['dateAdded']);
            $currentTime = time();
            
            if(($currentTime - $lastUrlTime) < 5) {
                echo "Please wait 5 seconds between shortening URLs.";
                $mysqli->close();
                exit;
            }
        }
        
        $shortUrl = generateRandomString();

        //megnézi létezik-e már az url az adatbázisban
        $query = $mysqli->prepare("SELECT shortUrl FROM urlShortener WHERE shortUrl = ?");
        $query->bind_param("s", $shortUrl);
        $query->execute();
        $query->bind_result($shortUrl);
        
        while($query->fetch()) {
            $shortUrl = generateRandomString();
            $query = $mysqli->query("SELECT * FROM urlShortener WHERE shortUrl = '$shortUrl'");
        }

        //beteszi a linket a táblába
        $query = $mysqli->prepare("INSERT INTO urlShortener (url, shortUrl, addedBy, dateAdded) VALUES (?, ?, ?, NOW())");
        $query->bind_param("sss", $url, $shortUrl, $addedBy);
        $query->execute();
        $query->close();
    }

    echo "The link has been shortened successfully.<br>You can view it at <a href='/ref/$shortUrl'>https://vb2007.hu/ref/$shortUrl</a>:" ;

    $mysqli->close();
    exit;
}

//megnézi kérték-e a linket (get)
if(isset($_GET['shortUrl'])) {
    $shortUrl = $_GET['shortUrl'];

    //kiszedi az eredeti linket a táblából
    $query = $mysqli->prepare("SELECT url FROM urlShortener WHERE shortUrl = ?");
    $query->bind_param("s", $shortUrl);
    $query->execute();

    if($query->errno) {
        echo "Something went wrong while trying to query the url: " - $query->error;
        exit;
    }

    $query->bind_result($url);

    //átirányít
    if($query->fetch()) {
        $query->close();
        $mysqli->close();
        header("Location: $url");
        exit;
    }
    else{
        echo "The shortened url couldn't be found in the database.";
        $query->close();
        $mysqli->close();
        exit;
    }
}
?>