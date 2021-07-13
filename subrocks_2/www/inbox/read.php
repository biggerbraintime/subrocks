<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
    $stmt = $conn->prepare("UPDATE pms SET readed = 'y' WHERE touser = ?");
    $stmt->bind_param("s", $_SESSION['siteusername']);
    $stmt->execute();
    $stmt->close();

    header("Location: index");
?>