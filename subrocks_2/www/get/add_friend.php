<?php ob_start(); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php

if($_SESSION['siteusername'] == $_GET['sending'])
    die("You can't friend yourself!");

$stmt = $conn->prepare("SELECT * FROM friends WHERE sender = ? AND reciever = ?");
$stmt->bind_param("ss", $_SESSION['siteusername'], $_GET['sending']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1) die('You already sent a friend request to this person');
$stmt->close();

$stmt = $conn->prepare("INSERT INTO friends (sender, reciever, status) VALUES (?, ?, 'u')");
$stmt->bind_param("ss", $_SESSION['siteusername'], $_GET['sending']);

$stmt->execute();
$stmt->close();

$_user_insert_utils->send_message($_GET['sending'], "New friend request", 'I sent you a new friend request!', $_SESSION['siteusername']);
header('Location: /friends');
?>