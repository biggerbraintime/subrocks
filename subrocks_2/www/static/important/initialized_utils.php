<?php
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/base.php");
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/delete.php");
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/fetch.php");
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/insert.php");
require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/update.php");

$_user_fetch_utils = new user_fetch_utils($conn);
$_video_fetch_utils = new video_fetch_utils($conn);
$_base_utils = new config_setup($conn);