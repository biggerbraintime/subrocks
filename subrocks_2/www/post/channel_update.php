<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/initialized_utils.php"); ?>
<?php
    switch(true)
    {
        case isset($_POST['bioset']):
            $_user_update_utils->update_user_bio($_SESSION['siteusername'], $_POST['bio']);
            break;
        case isset($_POST['channelset']):
            $_user_update_utils->update_user_channels($_SESSION['siteusername'], $_POST['videoid']);
            break;
        case isset($_POST['featuredset']):
            $_user_update_utils->update_user_featured_video($_SESSION['siteusername'], $_POST['videoid']);
            break;
        case isset($_POST['setbannerdisplay']):
            //setbannerdisplay
            $_user_update_utils->update_user_margin_top($_SESSION['siteusername'], $_POST['bannerdisplay']);
            break;
        case isset($_POST['twitterset']):
            //updateUserTwitter($_SESSION['siteusername'], $_POST['twitter'], $conn);
            break;
        case isset($_POST['instaset']):
            //updateUserInstagram($_SESSION['siteusername'], $_POST['instagram'], $conn);
            break;
        case isset($_POST['twitchset']):
            //updateUserTwitch($_SESSION['siteusername'], $_POST['twitch'], $conn);
            break;
        case isset($_POST['urlset']):
            //updateUserURL($_SESSION['siteusername'], $_POST['customurl'], $conn);
            break;
        case isset($_POST['facebookset']):
            //updateUserFacebook($_SESSION['siteusername'], $_POST['facebook'], $conn);
            break;
        case isset($_POST['customtitleset']):
            $_user_update_utils->update_user_featured_title($_SESSION['siteusername'], $_POST['featuredtitle']);
            break;
        case isset($_POST['setbannerdisplay']):
            $_user_update_utils->update_user_banner_display($_SESSION['siteusername'], $_POST['bannerdisplay']);
            break;
        case isset($_POST['setchannellayout']):
            //updateUserChannelLayout($_SESSION['siteusername'], $_POST['channellayout'], $conn);
            break;
        case isset($_POST['primary']):
            $_user_update_utils->update_user_primary_color($_SESSION['siteusername'], $_POST['solidcolor']);
            break;
        case isset($_POST['secondary']):
            $_user_update_utils->update_user_secondary_color($_SESSION['siteusername'], $_POST['solidcolor']);
            break;
        case isset($_POST['third']):
            $_user_update_utils->update_user_third_color($_SESSION['siteusername'], $_POST['solidcolor']);
            break;
        case isset($_POST['textcolor']):
            $_user_update_utils->update_user_text_color($_SESSION['siteusername'], $_POST['solidcolor']);
            break;
        case isset($_POST['textprimarycolor']):
            $_user_update_utils->update_user_primary_text_color($_SESSION['siteusername'], $_POST['solidcolor']);
            break;
        case isset($_POST['bgoptionset']):
            $bgoption = $_POST['bgoption'];
            $bgcolor = $_POST['solidcolor'];
    
            $stmt = $conn->prepare("UPDATE users SET 2012_bgoption = ? WHERE `users`.`username` = ?;");
            $stmt->bind_param("ss", $bgoption, $_SESSION['siteusername']);
            $stmt->execute();
            $stmt->close();    
    
            $stmt = $conn->prepare("UPDATE users SET 2012_bgcolor = ? WHERE `users`.`username` = ?;");
            $stmt->bind_param("ss", $bgcolor, $_SESSION['siteusername']);
            $stmt->execute();
            $stmt->close();    
    
            if($bgoption == "solid") {
                $stmt = $conn->prepare("UPDATE users SET 2012_bgcolor = ? WHERE `users`.`username` = ?;");
                $stmt->bind_param("ss", $bgcolor, $_SESSION['siteusername']);
                $stmt->execute();
                $stmt->close();        
                
                $stmt = $conn->prepare("UPDATE users SET 2012_bg = ? WHERE `users`.`username` = ?;");
                $stmt->bind_param("ss", $default, $_SESSION['siteusername']);
                $default = "default.png";
                $stmt->execute();
                $stmt->close();    
            }
            break;
        case isset($_POST['pfpset']):
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
    
            //This is terribly awful and i will probably put this in a function soon
            $target_dir = "/dynamic/pfp/";
            $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
            $target_name = md5_file($_FILES["fileToUpload"]["tmp_name"]) . "." . $imageFileType;
    
            $target_file = $target_dir . $target_name;
    
            $uploadOk = true;
            $movedFile = false;
    
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $fileerror = 'unsupported file type. must be jpg, png, jpeg, or gif';
                $uploadOk = false;
            }
    
            if (file_exists($target_file)) {
                $movedFile = true;
            } else {
                $movedFile = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            }
    
            if ($uploadOk) {
                if ($movedFile) {
                    $stmt = $conn->prepare("UPDATE users SET pfp = ? WHERE `users`.`username` = ?;");
                    $stmt->bind_param("ss", $target_name, $_SESSION['siteusername']);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    $fileerror = 'fatal error';
                }
            }
            break;
        case isset($_POST['bgset']):
          ini_set('display_errors', 1);
          ini_set('display_startup_errors', 1);
          error_reporting(E_ALL);
    
          //This is terribly awful and i will probably put this in a function soon
          if(!empty($_FILES["fileToUpload"]["name"])) {
                $target_dir = "/dynamic/banners/";
                $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
                $target_name = md5_file($_FILES["fileToUpload"]["tmp_name"]) . "." . $imageFileType;
    
                $target_file = $target_dir . $target_name;
    
                $uploadOk = true;
                $movedFile = false;
    
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    $fileerror = 'unsupported file type. must be jpg, png, jpeg, or gif';
                    $uploadOk = false;
                }
    
                if (file_exists($target_file)) {
                    $movedFile = true;
                } else {
                    $movedFile = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                }
    
                if ($uploadOk) {
                    if ($movedFile) {
                        $stmt = $conn->prepare("UPDATE users SET 2012_bg = ? WHERE `users`.`username` = ?;");
                        $stmt->bind_param("ss", $target_name, $_SESSION['siteusername']);
                        $stmt->execute();
                        $stmt->close();
                    } else {
                        $fileerror = 'fatal error';
                    }
                }
            }
        case isset($_POST['ssubtset']):
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
    
            
      
            $target_dir = "/dynamic/subscribe/";
            $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
            $target_name = md5_file($_FILES["fileToUpload"]["tmp_name"]) . "." . $imageFileType;
    
            $target_file = $target_dir . $target_name;
            
            $uploadOk = true;
            $movedFile = false;
    
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $fileerror = 'unsupported file type. must be jpg, png, jpeg, or gif';
                $uploadOk = false;
            }
    
            
            if (file_exists($target_file)) {
                $movedFile = true;
            } else {
                $movedFile = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            }
    
            if ($uploadOk) {
                
                if ($movedFile) {
                    
                    $stmt = $conn->prepare("UPDATE users SET subbutton = ? WHERE `users`.`username` = ?;");
                    $stmt->bind_param("ss", $target_name, $_SESSION['siteusername']);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    $fileerror = 'fatal error';
                }
            }
            break;
    }

    // header('Location: ' . $_SERVER['HTTP_REFERER']); !????!
    die(header("Location: /user/".htmlspecialchars($_SESSION['siteusername'])));
?>