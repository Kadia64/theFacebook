<?php 
    $_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/styles.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/data-handle.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/session-functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/sql-functions.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    $dh = new DataHandle();
    $sh = new SessionHandle();
    $sql = new SQLHandle();
    
    session_start();
    
    if (isset($_GET['id'])) {        
        $sql->Connect();
        $user_data = $sql->GetDataByEmail('account_info', $sql->GetEmailByID($_GET['id']));
        print_r($user_data);

    }

    $id = isset($_GET['id']) ? $_GET['id'] : '';

    //echo $id;

    //$user_data = $dh->GetUserProfileInfo($sql, $_GET['id']);    
    //$sh->CacheProfileInformation($user_data);
    //echo $_COOKIE['cached-profile-info'];

    //print_r($sql->GetDataByID('account_info', $_GET['id']));

?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Names\'s Profile'); ?>
    <!-- PageStyle(); -->
    <style>
        .profile-page-window {
            width: calc(var(--standard-page-width) - 200px);
            margin: 0 auto;
        }
        .profile-page-window {
            border: 1px solid black;
            display: flex;
            
        }
        .profile-page-left {
            flex: 1;
        }
        .profile-page-right {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(true); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftProfileLinks(); ?>
            <div class="right-main-window">
                <?php $content->WindowText('Template'); ?>
                <div class="profile-page-window">
                    
                    <!-- Left Side -->
                    <div class="profile-page-left">

                    </div>

                    <!-- Right Side -->
                    <div class="profile-page-right">

                    </div>


                </div>
            </div>            
        </div>
        <?php $content->BottomContent(true); ?>        
    </div>
</body>
</html>