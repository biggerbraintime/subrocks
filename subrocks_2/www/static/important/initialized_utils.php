<?php
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/base.php");
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/delete.php");
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/fetch.php");
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/insert.php");
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/update.php");

$_base_utils = new config_setup($conn);
$_user_delete_utils = new user_delete_utils($conn);
$_video_delete_utils = new video_delete_utils($conn);
$_user_fetch_utils = new user_fetch_utils($conn);
$_video_fetch_utils = new video_fetch_utils($conn);
$_user_insert_utils = new user_insert_utils($conn);
$_video_insert_utils = new video_insert_utils($conn);
$_user_update_utils = new user_update_utils($conn);
$_video_update_utils = new video_update_utils($conn);
?>