<?php
include("config.php");

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
