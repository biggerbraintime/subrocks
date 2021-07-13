<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
$friend = $_user_fetch_utils->fetch_friend_id($_GET['id']);

$name = $friend['reciever'];
$sender = $friend['sender'];

if($name != $_SESSION['siteusername']) {
    $doesnotown = true;
} else if($sender != $_SESSION['siteusername']) {
    $doesnotown2 = true;
}

if($doesnotown2 == true) {
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