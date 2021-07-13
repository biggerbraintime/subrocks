<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
    $video = $_video_fetch_utils->fetch_video_rid($_GET['id']);
?>
<?php

if($video['author'] == $_SESSION['siteusername']) {
    if($video['commenting'] == "a") {
        $_video_update_utils->update_video_commenting($_GET['id'], "d");
    } else {
        $_video_update_utils->update_video_commenting($_GET['id'], "a");
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>