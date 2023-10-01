<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/dynamic-content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
    $content = new Content();
    $dynamic = new DynamicContent();
    $styles = new Styles();
    $pages = new PageData();
    $dh = new DataHandle();
    $sh = new SessionHandle();
    $sql = new SQLHandle();
    session_start();

    if (!isset($_COOKIE['user-token'])) {
        setcookie('user-data', '', 0, '/');
        $sh->Redirect('Pages/Logged Out Pages/Login.php');
        exit;
    }
    $friend_count = 0;
    $update_profile = false;
    $user_data = null;
    $return_status = $_GET['return-status'];
    $edit_profile_link = PageData::ROOT . 'Pages/User Pages/MainProfilePage.php?return-status=update-profile';          

    if (($return_status == 'account-created' || $return_status == 'logged-in') && !isset($_COOKIE['user-data'])) {
        // if the user logged in or created their account
        $email = $_SESSION['email'];
        $sql->Connect();
        $account_data = $sql->GetDataByEmail('account_info', $email);
        $user_data = $sql->GetDataByEmail('personal_info', $email);
        $account_stats = $sql->GetDataByEmail('account_stats', $email);
        $display_array = $dh->GetDisplayAttributes($sql, $email, $account_data, $account_stats);
        $session_array = $dh->GetSessionArray($display_array, $account_data);
        $sh->SetUserDataCookie($session_array);
        $sql->CloseConnection();
    } else {
        if ($return_status == 'normal') {
            // normal page load            
            $display_array = $dh->ResetDisplayAttributes(json_decode($_COOKIE['user-data']));
        } else if ($return_status == 'update-profile') {
            // update profile page
            $update_profile = true;
            $cookie_array = $dh->GetUpdateProfileCookieData(array_values(json_decode($_COOKIE['user-data'])));
        } else if ($return_status == 'update-finished') {
            // will now reset the cookie and will get data from the database
            $sql->Connect();
            $session_array = json_decode($_COOKIE['user-data']);
            $old_username = $session_array[5];
            $old_email = $session_array[6];
            $new_username = $_GET['new-username'];
            $new_email = $_GET['new-email'];
            if ($new_username == null) {
                $new_username = $old_username;
            }
            if ($new_email == null) {
                $new_email = $old_email;
            }

            $account_data = $sql->GetDataByEmail('account_info', $new_email);
            $user_data = $sql->GetDataByEmail('personal_info', $new_email);
            $account_stats = $sql->GetDataByEmail('account_stats', $new_email);
            $display_array = $dh->GetDisplayAttributes($sql, $new_email, $account_data, $account_stats);

            $session_array = $display_array;
            array_unshift($session_array, $account_data->{'first_name'}, $account_data->{'last_name'});
            $sh->ResetSessionCookies($new_username, $new_email, $session_array);
            $sql->CloseConnection();
            $sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=normal');
        } else {
            // unknown case
            $cookie_data = $_COOKIE['user-data'];
            $session_array = json_decode($cookie_data);
            $display_array = $dh->ResetDisplayAttributes($session_array);
        }
        if ($return_status == 'just-updated') {
            // back to profile, will now uddate database
            $sql->Connect();
            $dh->UpdatePersonalInfo($sql, $display_array, $session_array);
            $sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=update-finished&new-username=' . $_GET['username'] . '&new-email=' . $_GET['email']);           
            $sql->CloseConnection();
        }
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Your Profile'); ?>
    <?php $styles->MainProfilePageStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(true); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftProfileLinks(); ?>            
            <div class="right-main-window">
                <?php $content->WindowText('Profile (this is you)'); ?>
                <div class="main-profile-page-window">
                    <div class="main-profile-page-flexbox">
                        <div class="main-profile-page-left">
                            <div class="window-content profile-image-window">
                                <?php $content->WindowText('Picture', '<a href="' . $edit_profile_link . '">[ edit ]</a>'); ?>
                                <img src="<?php echo PageData::ROOT ?>Images/default-profile-image.jpg">
                            </div>
                            <div class="window-content profile-links-window">
                                <ul>
                                    <li><a href="">Visualize My Friends</a></li>
                                    <li><a href="">Edit My Profile</a></li>
                                    <li><a href="">My Account Preferences</a></li>
                                    <li><a href="">My Privacy Preferences</a></li>
                                </ul>
                            </div>
                            <?php 
                                $connection_window = null;
                                $friends_window = null;
                                if ($friend_count == 0) {
                                    $connection_window = '
                                        <div class="window-content empty-connection-window">
                                            ' . $content->WindowText('Connection', null, true) . '
                                            <p>This is you</p>
                                        </div>
                                    ';
                                    $friends_window = '
                                        <div class="window-content empty-friends-window">
                                            ' . $content->WindowText('Friends', null, true) . '
                                            <p>You have ' . $friend_count . ' friends</p>
                                        </div>                              
                                    ';
                                }
                                echo $connection_window;
                                echo $friends_window;
                            ?>
                        </div>
                        <div class="main-profile-page-right">
                            <div class="window-content">
                                <?php $content->WindowText('Information', '<a href="' . $edit_profile_link . '">[ edit ]</a>'); ?>
                                <div class="main-profile-page-info-grid">
                                    <?php 
                                        $attribute_displays = $dh->DisplayAccountAttributes;
                                        $attributes_update_displays = $dh->DisplayUpdateAccountAttributes;
                                        if (!$update_profile) {
                                            for ($i = 0; $i < count($attribute_displays); ++$i) {
                                                switch ($i) {
                                                    case 0:
                                                        ParseField('Account Info:');
                                                        break;
                                                    case 6:
                                                        ParseField('Basic Info:');
                                                        break;
                                                    case 12:
                                                        ParseField('Extended Info:');
                                                        break;
                                                }
                                                echo '
                                                    <div>
                                                        <p>' . $attribute_displays[$i] . ':</p>
                                                    </div>
                                                    <div>
                                                        ' . $dh->InfoField($display_array[$i]) . '
                                                    </div>
                                                ';
                                            }
                                        } else {
                                            echo '
                                                <form method="GET" action="' . PageData::ROOT . 'Pages/User Pages/MainProfilePage.php">
                                                    <div class="main-profile-update-grid">
                                                        <input type="hidden" name="return-status" value="just-updated">
                                            ';                                            
                                            for ($i = 0; $i < count($attributes_update_displays); ++$i) {
                                                $attributes_update_displays[$i] = ucwords($attributes_update_displays[$i]) . ':';                                                
                                                switch ($i) {
                                                    case 0:
                                                        ParseField('Account Info:');
                                                        break;
                                                    case 5:
                                                        ParseField('Basic Info:');
                                                        break;
                                                    case 12:
                                                        ParseField('Extended Info:');
                                                        break;
                                                }
                                                $dynamic->DisplayUpdateProfileValues($i, $cookie_array, $attributes_update_displays);                                                                                                
                                            }

                                            echo '
                                                    </div>
                                                    <div class="profile-update-info-button">
                                                        <input type="submit" value="Update!">
                                                    </div>
                                                </form>
                                            ';
                                        }

                                        function ParseField($attribute) {
                                            echo '
                                                <div>
                                                    <p><b>' . $attribute . '</b></p>
                                                </div>
                                                <div></div>
                                            ';
                                        }                                        
                                    ?>                             
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>                    
            </div>            
        </div>
        <?php $content->BottomContent(); ?>        
    </div>
</body>
</html>