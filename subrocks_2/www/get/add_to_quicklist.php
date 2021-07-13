<?php ob_start(); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
$stmt = $conn->prepare("INSERT INTO quicklist_videos (video, author) VALUES (?, ?)");
$stmt->bind_param("ss", $_GET['v'], $_SESSION['siteusername']);
$stmt->execute();
$stmt->close();

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>