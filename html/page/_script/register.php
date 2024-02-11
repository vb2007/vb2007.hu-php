<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit('POST request method required.');
}
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$gender = $_POST["gender"];

//sqlite adatbázishoz csatlakozik
$db = new SQLite3('/var/www/html/data/data.db');
if (!$db) {
    // die("Database connection failed: " . $db->lastErrorMsg());
    die("Database connection failed.");
}

//tábla létrehozása (ha még nem létezik)
$db->exec('
CREATE TABLE IF NOT EXISTS users(
    id INTEGER PRIMARY KEY,
    username TEXT,
    password TEXT,
    email TEXT,
    gender TEXT,
    dateAdded TEXT
)');

//megnézi benne van-e már a felhasználónév az adatbázisban
$query = $db->prepare("SELECT * FROM users WHERE username = :username");
$query->bindParam(':username', $username);
$result = $query->execute();
$existingUser = $result->fetchArray(SQLITE3_ASSOC);

if ($existingUser) {
    echo "Username already exists. Please choose a different one.";
    exit;
}
else {
    //jelszó hashelés insert előtt
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //beteszi az adatot a users sqlite3 táblába
    $query = $db->prepare("INSERT INTO users (username, password, email, gender, dateAdded) VALUES (:username, :password, :email, :gender, :dateAdded)");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $hashedPassword);
    $query->bindParam(':email', $email);
    $query->bindParam(':gender', $gender);
    $query->bindValue(':dateAdded', date('Y-m-d H:i:s'));
    $query->execute();

    echo "Registration successful. You can now <a href='/login'>login</a>.";
}

$db->close();
?>