<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/sql-functions.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    $dh = new DataHandle();
    $sh = new SessionHandle();
    $sql = new SQLHandle();
    session_start();

    if (!isset($_COOKIE['user-token'])) {
        $sh->Redirect('Pages/Logged Out Pages/Login.php');
        exit;
    }

    $friend_count = 0;

    // ask the database if you just created an account, or if you just logged in
    if ($_GET['return-status'] == 'account-created' || $_GET['return-status'] == 'logged-in') {
        $sql->Connect();
        $account_data = $sql->GetDataByEmail('account_info', $_SESSION['email']);
        $user_data = $sql->GetDataByEmail('personal_info', $_SESSION['email']);
        $account_stats = $sql->GetDataByEmail('account_stats', $_SESSION['email']);                
        $display_array = array_slice(array_values($sql->GetDataByEmail('personal_info', $_SESSION['email'], true)), 3);
        array_unshift($display_array,
            $account_data->{'full_name'},
            $account_stats->{'member_since'},
            $account_stats->{'last_update'},
            $account_data->{'username'},
            $account_data->{'email'},
            $account_data->{'mobile'}
        );
        
        // set the user data cookie for the users personal info, and their settings
    } else {
        // else get your information from the cookie
        
    }
    $sql->CloseConnection();
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
                                <?php $content->WindowText('Picture', '<a href="">[ edit ]</a>'); ?>
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
                                <?php $content->WindowText('Information', '<a href="">[ edit ]</a>'); ?>
                                <div class="main-profile-page-info-grid">
                                    <?php 
                                        $attributes = $dh->AccountAttributes;                                        
                                        for ($i = 0; $i < count($attributes); ++$i) {
                                            $attributes[$i] = ucwords($attributes[$i]) . ':';
                                            if ($i == 0) {
                                                echo '
                                                    <div>
                                                        <p><b>Account Info:</b></p>
                                                    </div>
                                                    <div></div>
                                                ';
                                            } else if ($i == 6) {
                                                echo '
                                                    <div>
                                                        <p><b>Basic Info:</b></p>
                                                    </div>
                                                    <div></div>
                                                ';
                                            } else if ($i == 12) {
                                                echo '
                                                    <div>
                                                        <p><b>Extended Info:</b></p>
                                                    </div>
                                                    <div></div>
                                                ';
                                            }
                                            echo '
                                                <div>
                                                    <p>' . $attributes[$i] . '</p>
                                                </div>
                                                <div>
                                                    ' . $dh->InfoField($display_array[$i]) . '
                                                </div>
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