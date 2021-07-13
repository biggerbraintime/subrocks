<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
    $video = $_video_fetch_utils->fetch_video_rid($_GET['id']);
?>
<?php

if($video['author'] == $_SESSION['siteusername']) {
    $_video_delete_utils->remove_video($_GET['id']); 
}

header('Location: /video_manager');
?>