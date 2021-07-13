<?php ob_start(); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
$name = $_GET['v'];

if(!isset($_SESSION['siteusername']) || !isset($_GET['v'])) {
    die("You are not logged in or you did not put in an argument");
}

$stmt = $conn->prepare("SELECT * FROM likes WHERE sender = ? AND reciever = ? AND type = 'd'");
$stmt->bind_param("ss", $_SESSION['siteusername'], $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1) {
        $_user_insert_utils->remove_like_video($_SESSION['siteusername'], $name);
    }

$stmt = $conn->prepare("SELECT * FROM likes WHERE sender = ? AND reciever = ? AND type = 'l'");
$stmt->bind_param("ss", $_SESSION['siteusername'], $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1) {
        $_user_insert_utils->remove_like_video($_SESSION['siteusername'], $name);
    } else {
        $_user_insert_utils->add_dislike_video($_SESSION['siteusername'], $name);
    }
$stmt->close();

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>