<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
$friend = $_user_fetch_utils->fetch_friend_id($_GET['id']);

if($friend['sender'] == true) {
    die("You do not own this friendship."); 
}

if(!isset($_GET['id'])) {
    die("ID is not set"); 
}

$stmt = $conn->prepare("UPDATE friends SET status = 'd' WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$stmt->close();

header('Location: /friends');
?>