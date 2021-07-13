<?php ob_start(); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
    $video_response = $_video_fetch_utils->get_video_response($_GET['id']);
    $video = $_video_fetch_utils->fetch_video_rid($video_response['toid']);
?>
<?php
if($video['author'] == $_SESSION['siteusername']) {
    $stmt = $conn->prepare("DELETE FROM video_response WHERE id = ?");
    $stmt->bind_param("s", $_GET['id']);
    $stmt->execute();
    $stmt->close();
}

header('Location: /watch?v=' . htmlspecialchars($video['rid']));
?>