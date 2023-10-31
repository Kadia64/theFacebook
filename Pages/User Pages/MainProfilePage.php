<?php 
    $_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/styles.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/dynamic-content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/data-handle.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/session-functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/sql-functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/ftp-handle.php';
    $content = new Content();
    $dynamic = new DynamicContent();
    $styles = new Styles();
    $pages = new PageData();
    $dh = new DataHandle();
    $sh = new SessionHandle();
    $sql = new SQLHandle();
    $ftp = new FTPHandle();
    session_start();
    $sh->CheckActiveSession();    
    
    // $sql->Connect();
    // $ftp->Connect();
    // $ftp->Login();   


    $update_profile = false;
    $user_data = null;
    $return_status = $_GET['return-status'];
    $edit_profile_link = PageData::ROOT . 'Pages/User Pages/MainProfilePage.php?return-status=update-profile';
    $edit_profile_button = 'Information';
    $edit_groups_button = 'Groups';
    $current_school = null;
    $profile_iamge = null;
    $default_profile_image = null;

    if (($return_status == 'account-created' || $return_status == 'logged-in') && !isset($_COOKIE['user-data'])) {
        // if the user logged in or created their account
        $sql->Connect();
        $email = $_SESSION['email'];
        $id = $sql->GetIDByEmail($email);
        $current_session_data = $sh->GetUserSessionDataByEmail($sql, $email);
        $_SESSION['session-id'] = $current_session_data['session_id'];
        
        $account_data = $sql->GetDataByEmail('account_info', $email, $dh->AccountInfoColumn, false);
        $user_data = $sql->GetDataByEmail('personal_info', $email);
        $account_stats = $sql->GetDataByEmail('account_stats', $email);
        $cookie_array = $sh->ParseUserDataCookie($sql, $email);

        # Future Function =>
        $default_image_check = $sql->CheckValueNull('profile_image', 'account_info', 'email', $email);
        $profile_image_name = !$default_image_check ? $dh->GetProfileImageName($sql, $id) : '';
        $profile_image_extension = !$default_image_check ? $sql->GetValueByEmail('profile_image_extension', 'account_info', $email) : '';
        $friends_id_list = $sql->GetValueByEmail('friends_id_list', 'account_info', $email);
        $account_attributes_array = array(
            'profile-image' => $default_image_check,
            'profile-image-id' => $profile_image_name,
            'profile-image-extension' => $profile_image_extension,
            'class-connection-count' => 0,
            'friends-id-list' => $friends_id_list,
            'friend-connection-count' => 0,
            'friend-message-count' => 0,
            'group-message-count' => 0
        );
        $sh->SetUserDataCookie($cookie_array, $account_attributes_array, $default_image_check);
        $sql->CloseConnection();
        $sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=normal');
        exit;
    } else {
        $cookie_data = json_decode($_COOKIE['user-data']);
        $account_attributes = json_decode($_COOKIE['account-attributes']);                

        if ($return_status == 'normal') {
            // normal page load            
            $display_array = $dh->GetDisplayAttributesFromCookie($_COOKIE['user-data']);
        } else if ($return_status == 'update-profile') {
            // update profile page
            $update_profile = true;
            $cookie_array = $dh->GetDisplayAttributesFromCookie($_COOKIE['user-data'], true);
        } else if ($return_status == 'update-finished') {
            // will now reset the cookie and will get data from the database
            $sql->Connect();
            $old_cookie = json_decode($_COOKIE['user-data']);
            $old_username = $old_cookie->{'username'};
            $old_email = $old_cookie->{'email'};
            $new_username = $_GET['new-username'];
            $new_email = $_GET['new-email'];
            if ($new_username == null) {
                $new_username = $old_username;
            }
            if ($new_email == null) {
                $new_email = $old_email;
            }        
            $id = $sql->GetIDByEmail($new_email);

            $account_data = $sql->GetDataByEmail('account_info', $new_email);
            $user_data = $sql->GetDataByEmail('personal_info', $new_email);
            $account_stats = $sql->GetDataByEmail('account_stats', $new_email);
            $display_array = $dh->GetDisplayAttributesFromDB($sql, $new_email, $account_data, $account_stats);
            $old_cookie = $display_array;
            array_unshift($old_cookie, $account_data['first_name'], $account_data['last_name']);

            # Future Function =>
            $default_image_check = $sql->CheckValueNull('profile_image', 'account_info', 'email', $new_email);
            $profile_image_name = !$default_image_check ? $dh->GetProfileImageName($sql, $id) : '';
            $profile_image_extension = !$default_image_check ? $sql->GetValueByEmail('profile_image_extension', 'account_info', $new_email) : '';
            $friends_id_list = $sql->GetValueByEmail('friends_id_list', 'account_info', $email);
            $account_attributes_array = array(
                'profile-image' => $default_image_check,
                'profile-image-id' => $profile_image_name,
                'profile-image-extension' => $profile_image_extension,
                'class-connection-count' => 0,
                'friend-connection-count' => 0,
                'friends-id-list' => $friends_id_list,
                'friend-message-count' => 0,
                'group-message-count' => 0
            );            
            $sh->UpdateCookies($sql, $new_email, $sh->ParseUserDataCookie($sql, $new_email), $account_attributes_array);
            $sql->CloseConnection();
            $sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=normal');
            exit;
        } else {
            // normal
            $display_array = $dh->GetDisplayAttributesFromCookie($_COOKIE['user-data']);
        }
        if ($return_status == 'just-updated') {
            // back to profile, will now uddate database
            $sql->Connect();
            $session_array = $dh->GetDisplayAttributesFromCookie($_COOKIE['user-data'], true);
            $dh->UpdatePersonalInfo($sql, $display_array, $session_array);            
            $sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=update-finished&new-username=' . $_GET['username'] . '&new-email=' . $_GET['email']);           
            $sql->CloseConnection();
        }
    }
    if ($update_profile) {
        $edit_profile_button = '<a href="javascript:history.go(-1)" class="window-text-button">[ Back ]</a>';
    }
    $default_profile_image = $account_attributes->{'profile-image'};
    $profile_image_name = $account_attributes->{'profile-image-id'};
    $profile_image_extension = $account_attributes->{'profile-image-extension'};    
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Your Profile'); ?>
    <?php $styles->MainProfilePageStyle(); ?>
    <script src="<?php echo PageData::ROOT . 'static-values.js'?>"></script>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(true); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftProfileLinks(); ?>            
            <div class="right-main-window">
                <?php $content->WindowText('Profile (this is you)', $current_school); ?>
                <div class="main-profile-page-window">
                    <div class="main-profile-page-flexbox">

                        <!-- Left Side -->
                        <div class="main-profile-page-left">
                            
                            <!-- Profile Picture -->
                            <div class="window-content profile-image-window">                            
                                <?php $content->WindowText('Picture', '
                                    <form method="POST" action="' . PageData::ROOT . 'Server Functions/upload-image.php" id="upload-image-form">
                                        <label class="profile-image-upload-text">
                                            <input type="file" enctype="multipart/form-data" name="profile-image" id="profile-image-upload" class="profile-image-upload-input">
                                            <div id="status"></div>
                                            [ edit ]
                                        </label>
                                    </form>
                                '); ?>
                                <script>
                                    const form = document.getElementById('upload-image-form');
                                    const fileInput = document.getElementById('profile-image-upload');
                                    const statusDiv = document.getElementById('status');

                                    fileInput.addEventListener("change", () => {
                                        const file = fileInput.files[0];                                        

                                        if (file) {
                                            const formData = new FormData();
                                            const img = new Image();
                                            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                            const maxFileSize = 5 * 1024 * 1024;                                            
                                            formData.append('profile-image', file);

                                            if (!allowedTypes.includes(file.type)) {
                                                alert('Only .jpeg, .png, and .gif file types are allowed!');
                                                return;
                                            }
                                            if (file.size > maxFileSize) {
                                                alert('The max file size is 5MB!');
                                                return;
                                            }

                                            img.src = window.URL.createObjectURL(file);
                                            img.onload = function() {
                                                fetch("<?php echo PageData::ROOT . 'Server Functions/upload-image.php?bruh=omg' ?>", {
                                                    method: "POST",
                                                    body: formData
                                                })
                                                .then(response => response.text())
                                                .then(result => {
                                                    statusDiv.textContent = result;
                                                })
                                                .catch(error => {
                                                    statusDiv.textContent = "error getting file: " + error;
                                                });
                                            }
                                        }
                                        setTimeout(function() {
                                            window.location.href = "MainProfilePage.php?return-status=normal";
                                        }, 800);
                                    });
                                </script>
                                <?php
                                    if ($default_profile_image) {
                                        $dynamic->DisplayCachedDefaultProfileImage();
                                    } else {
                                        $dynamic->DisplayCachedProfileImage($profile_image_name, $profile_image_extension);
                                    }
                                ?>
                            </div>
                            
                            <!-- Links Below Profile Image -->
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

                                // Connection Window
                                $connection_window = '
                                    <div class="window-content empty-connection-window">
                                        ' . $content->WindowText('Connection', null, true) . '
                                        <p>This is you</p>
                                    </div>
                                ';

                                // Other Schools Window
                                $friends_window = '
                                    <div class="window-content other-schools-window">
                                        ' . $content->WindowText('Other Schools', null, true) . '
                                        <p>null</p>
                                    </div>
                                ';
                                echo $connection_window;
                                echo $friends_window;
                            ?>
                        </div>

                        <!-- Right Side -->
                        <div class="main-profile-page-right">

                            <!-- Account Information Window -->
                            <div class="window-content">
                                <?php $content->WindowText($edit_profile_button, '<a href="' . $edit_profile_link . '">[ edit ]</a>'); ?>
                                <div class="main-profile-page-info-grid">
                                    <?php 
                                        $attribute_displays = $dh->DisplayAccountAttributes;
                                        $attributes_update_displays = $dh->DisplayUpdateAccountAttributes;
                                        $highlighted = array(3, 4, 5, 12);
                                        $highlight_class = null;
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
                                                if (in_array($i, $highlighted)) {
                                                    $highlight_class = 'class="highlighted-field"';
                                                } else {
                                                    $highlight_class = null;
                                                }

                                                echo '
                                                    <div>
                                                        <p>' . $attribute_displays[$i] . ':</p>
                                                    </div>
                                                    <div>
                                                        <span ' . $highlight_class . ' >' . $content->InfoField($display_array[$i]) . '</span>
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

                            <!-- Groups Window -->
                            <div class="window-content">
                                <?php $content->WindowText($edit_groups_button, '<a href="">[ edit ]</a>'); ?>
                                <div class="main-profile-page-groups">
                                    <?php 
                                        $groups = array();
                                        if (count($groups) == 0) {
                                            echo '
                                                <div class="no-groups">
                                                    <p>You are in 0 groups</p>
                                                </div>
                                            ';
                                        } else {
                                            for ($i = 0; $i < count($groups); ++$i) {
                                                echo '
                                                    <span class="groups-bullets">
                                                        &#8226
                                                    </span>
                                                    <a href=""> ' . $groups[$i] . ' </a>
                                                ';
                                            }
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- Courses Window -->
                            <div class="window-content">
                                <?php $content->WindowText('Courses', '<a href="">[ edit ]</a>'); ?>
                                <div class="main-profile-page-courses">
                                    <?php 
                                        $courses = array();                                        
                                        if (count($courses) == 0) {
                                            echo '
                                                <div class="no-courses">
                                                    <p>You are in 0 courses</p>
                                                </div>
                                            ';
                                        } else {
                                            echo '<ul>';
                                            for ($i = 0; $i < count($courses); ++$i) {
                                                echo '<li>' . $courses[$i] . '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- The Wall Window -->
                            <div class="window-content">
                                <?php $content->WindowText($cookie_data->{'first_name'} . '\'s Wall', '<a href="">[ edit ]</a>'); ?>
                                <div class="main-profile-page-wall">
                                    <?php 
                                        echo '<div><p>null</p></div>';
                                    ?>
                                </div>
                            </div>

                            <!-- Friends Window -->
                            <div class="window-content">
                                <?php $content->WindowText('Friends', '<a href="">[ edit ]</a>'); ?>
                                <div class="main-profile-page-friends">
                                    <?php 
                                        echo '<div><p>null</p></div>';
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $content->BottomContent(1); ?>        
    </div>
</body>
</html>