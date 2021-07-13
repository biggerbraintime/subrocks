<?php ob_start(); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
$stmt = $conn->prepare("INSERT INTO video_response (toid, author, video) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $_GET['reciever'], $_SESSION['siteusername'], $_GET['sending']);
$stmt->execute();
$stmt->close();

header('Location: /watch?v=' . htmlspecialchars($_GET['reciever']));
?>