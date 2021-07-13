<?php ob_start(); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
$name = $_GET['n'];
if(isset($_SESSION['siteusername'])) { 
    $_user_insert_utils->send_message($_GET['user'], "New subscriber", 'I subscribed to your channel!', $_SESSION['siteusername']);
}

if(!isset($_SESSION['siteusername']) || !isset($_GET['user'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if($name == $_SESSION['siteusername']) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$stmt = $conn->prepare("SELECT * FROM subscribers WHERE sender = ? AND reciever = ?");
$stmt->bind_param("ss", $_SESSION['siteusername'], $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1) die('You already are subscribed to this person!');
$stmt->close();

$stmt = $conn->prepare("INSERT INTO subscribers (sender, reciever) VALUES (?, ?)");
$stmt->bind_param("ss", $_SESSION['siteusername'], $name);

$stmt->execute();
$stmt->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>