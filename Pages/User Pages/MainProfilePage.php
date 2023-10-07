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
    
    if ((!isset($_COOKIE['user-token'])) && ((isset($_GET['username'])) && (isset($_GET['email'])))) {
        $sh->SetUserTokenCookie($_GET['username'], $_GET['email']);
        $sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=' . $_GET['return-status']);
        exit;
    } else if (!isset($_COOKIE['user-token'])) {
        $sh->Redirect('Server Functions/logout.php');
        exit;
    }

    // account attributes cookie
    //print_r($_COOKIE['account-attributes']);

    $update_profile = false;
    $user_data = null;
    $return_status = $_GET['return-status'];
    $edit_profile_link = PageData::ROOT . 'Pages/User Pages/MainProfilePage.php?return-status=update-profile';
    $edit_profile_button = 'Information';
    $edit_groups_button = 'Groups';
    $current_school = null;
    $default_profile_image = '<img src="' . PageData::ROOT . 'Images/default-profile-image.jpg">';
    $profile_iamge = null;

    if (($return_status == 'account-created' || $return_status == 'logged-in') && !isset($_COOKIE['user-data'])) {
        // if the user logged in or created their account
        $email = $_SESSION['email'];
        $sql->Connect();
        $account_data = $sql->GetDataByEmail('account_info', $email, $dh->AccountInfoColumn, false);
        $user_data = $sql->GetDataByEmail('personal_info', $email);
        $account_stats = $sql->GetDataByEmail('account_stats', $email);
        $cookie_array = $sh->ParseUserDataCookie($sql, $email);
        $session_array = array_values($cookie_array);        
        $display_array = $dh->GetDisplayAttributesFromDB($sql, $email, $account_data, $account_stats);        

        $sh->SetUserDataCookie($cookie_array);
        $sql->CloseConnection();
        $sh->Redirect('Pages/User Pages/MainProfilePage.php?return-status=normal');
        exit;
    } else {
        $cookie_data = json_decode($_COOKIE['user-data']);
        $account_attributes = json_decode($_COOKIE['account-attributes']);
        
        // needs to be cached in the account attributes
        $sql->Connect();
        if ($sql->CheckValueNull('profile_image', 'account_info', 'email', $cookie_data->{'email'})) {
            $account_attributes->{'profile-image'} = false;
        }

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

            $account_data = $sql->GetDataByEmail('account_info', $new_email);
            $user_data = $sql->GetDataByEmail('personal_info', $new_email);
            $account_stats = $sql->GetDataByEmail('account_stats', $new_email);
            $display_array = $dh->GetDisplayAttributesFromDB($sql, $new_email, $account_data, $account_stats);
            if ($sql->CheckValueNull('profile_image', 'account_info', 'email', $new_email)) {
                $account_attributes['profile-image'] = false;
            }

            $old_cookie = $display_array;
            array_unshift($old_cookie, $account_data['first_name'], $account_data['last_name']);
            $sh->ResetSessionCookies($new_username, $new_email, $sh->ParseUserDataCookie($sql, $new_email));
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
    $diff_profile_image = $account_attributes->{'profile-image'};
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
                        <div class="main-profile-page-left">
                            <div class="window-content profile-image-window">                            
                                <?php $content->WindowText('Picture', '
                                    <form method="POST" action="' . PageData::ROOT . 'Server Functions/upload-image.php">
                                        <label class="profile-image-upload-text">
                                            <input type="file" enctype="multipart/form-data" name="profile-image" id="profile-image-upload" class="profile-image-upload-input">
                                            <div id="status"></div>
                                            [ edit ]
                                        </label>
                                    </form>
                                '); ?>
                                <script>
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
                                    });
                                </script>
                                <?php
                                    if ($diff_profile_image) {
                                        // if you have a different profile image                                        
                                    } else {
                                        echo $default_profile_image;
                                    }
                                ?>
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
                                $connection_window = '
                                    <div class="window-content empty-connection-window">
                                        ' . $content->WindowText('Connection', null, true) . '
                                        <p>This is you</p>
                                    </div>
                                ';
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
                        <div class="main-profile-page-right">
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
                                                        <span ' . $highlight_class . ' >' . $dh->InfoField($display_array[$i]) . '</span>
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
                            <div class="window-content">
                                <?php $content->WindowText($cookie_data->{'first_name'} . '\'s Wall', '<a href="">[ edit ]</a>'); ?>
                                <div class="main-profile-page-wall">
                                    <?php 
                                        echo '<div><p>null</p></div>';
                                    ?>
                                </div>
                            </div>
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