<?php 
    $_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/styles.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/dynamic-content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/session-functions.php';
    $content = new Content();
    $styles = new Styles();
    $dynamic = new DynamicContent();
    $pages = new PageData();
    $sh = new SessionHandle();
    session_start();
    $sh->CheckActiveSession();

    $user_data_cookie = json_decode($_COOKIE['user-data']);
    $account_attributes = json_decode($_COOKIE['account-attributes']);

    $profile_image_name = $account_attributes->{'profile-image-id'};
    $profile_image_extension = $account_attributes->{'profile-image-extension'};
    $friend_message_count = $account_attributes->{'friend-message-count'};
    $group_message_count = $account_attributes->{'group-message-count'};
    $message_count = $friend_message_count + $group_message_count;
    $default_profile_image = $account_attributes->{'profile-image'};    
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Home'); ?>
    <?php $styles->UserHomePageStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(true); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftProfileLinks(); ?>
            <div class="right-main-window">
                <?php $content->WindowText('Welcome ' . $user_data_cookie->{'first_name'} . '!'); ?>
                <h4>[ Welcome <?php echo $user_data_cookie->{'first_name'}; ?> ]</h4>
                <div class="user-home-page-window">
                    <div class="user-home-page-content">                        
                        <div class="window-content">
                            <?php $content->WindowText('My Account'); ?>
                            <div class="user-home-page-content my-account-box">
                                <div class="user-home-page-profile-image-flexbox">
                                    <div class="user-home-page-profile-image">
                                        <?php 
                                            if ($default_profile_image) {
                                                $dynamic->DisplayCachedDefaultProfileImage();
                                            } else {
                                                $dynamic->DisplayCachedProfileImage($profile_image_name, $profile_image_extension);
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="user-home-page-links-flexbox">
                                    <div class="user-home-page-links">
                                        <p><a href="<?php echo PageData::ROOT . 'Pages/User Pages/MainProfilePage.php?return-status=normal'; ?>">View My Profile</a></p>
                                        <p><a href="">View My Friends</a></p>
                                        <p><a href="">Search for People</a></p>
                                        <p><a href="">Browse My Network</a></p>
                                    </div>
                                </div>
                                <div class="user-home-page-connections-flexbox">
                                    <div>
                                        <p>You are connected to </p>
                                        <p><b><?php echo $account_attributes->{'class-connection-count'}; ?></b></p>
                                        <p>people through classes.</p>
                                        <p>You are connected to</p>
                                        <p><b><?php echo $account_attributes->{'friend-connection-count'}; ?></b></p>
                                        <p>people through friends.</p>
                                    </div>
                                </div>
                                <div class="user-home-page-browse-links-flexbox">
                                    <div>
                                        <p><a href="">[ browse them ]</a></p>
                                        <p><a href="">[ browse them ]</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="window-content">
                            <?php 
                                if ($message_count > 0) {
                                    $content->WindowText('You have a new message');
                                } else {
                                    $content->WindowText('You have no new messages');
                                }
                            ?>
                            <div class="user-home-page-message-flexbox">
                                <div>
                                    <div class="user-home-page-mail">
                                        <img src="<?php echo PageData::ROOT . 'Images/mail-icon.jpg'; ?>" class="mail-icon-image">
                                    </div>
                                </div>
                                <div class="user-home-page-message-count">
                                    <?php
                                        if ($message_count > 0) {
                                            echo "<p>You have <b>$message_count</b> new message.</p>";
                                        } else {
                                            echo "<p>You have no new messages.</p>";
                                        }
                                    ?>
                                </div>
                                <div class="user-home-page-read-mail-button">
                                    <a href="">[ read mail ]</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent(true); ?>        
    </div>
</body>
</html>