<?php
include("config.php");

class DataBase {
    private static $instance = null;
    private static $connection;

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct() {

        echo "database name: $DATABASE_NAME";
        echo "database username: $DATABASE_USERNAME";
        echo "password: $DATABASE_PASSWORD";
        $connection = new PDO(
            "mysql:host=localhost;dbname=" . $DATABASE_NAME,
            "hepl",
            "12345");
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getConnection() {
        if (self::$instance == null) {
            self::$instance = new DataBase();
        }

        return self::$connection;
    }
}

function isConnected() {

    if (isset($_SESSION["connected"]) && $_SESSION["connected"] == true) {
        return true;
    }
    return false;
}

function checkCredentials($username, $password) {
    $db = new PDO(
        "mysql:host=localhost;dbname=hepl_lab_webdev_1",
        "hepl",
        "12345");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("SELECT * from user where pseudo = :username and mdp = password(:pwd)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pwd', $password);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    if ($stmt->fetch() === false) {
        return false;
    }
    return true;
}

function getUsersByFilters($pseudo, $lang, $status, $combination) {
    $db = new PDO(
        "mysql:host=localhost;dbname=hepl_lab_webdev_1",
        "hepl",
        "12345");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($status == "Connecté") {
        $dbStatus = 1;
    } else if ($status == "Hors ligne") {
        $dbStatus = 2;
    } else {
        $dbStatus = 3;
    }
    if ($combination == null) {
        $stmt = $db->prepare("SELECT * FROM `user`");
    } else if ($combination == "ET") {
        $stmt = $db->prepare("SELECT * FROM `user` WHERE `pseudo` LIKE :pseudo AND `langue` LIKE :lang AND status=:status");
    } else {
        $stmt = $db->prepare("SELECT * FROM `user` WHERE `pseudo` LIKE :pseudo OR `langue` LIKE :lang OR status=:status");
    }
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':lang', $lang);
    $stmt->bindParam(':status', $dbStatus);
    $stmt->execute();

    // set the resulting array to associative
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();
}

?>
