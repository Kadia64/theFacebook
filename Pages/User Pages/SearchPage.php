<?php 
    $_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/styles.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/dynamic-content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/session-functions.php';
    $content = new Content();
    $dynamic = new DynamicContent();
    $styles = new Styles();
    $pages = new PageData();
    $sh = new SessionHandle();
    session_start();
    $sh->CheckActiveSession();

    $user_data_cookie = json_decode($_COOKIE['user-data']);
    $account_attributes = json_decode($_COOKIE['account-attributes']);    
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Search'); ?>
    <!-- PageStyle(); -->
    <style>
        .search-page-window {
            width: calc(var(--standard-page-width) - 160px);
            margin: 0 auto;
        }
        .search-page-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }
        .search-page-form-flexbox {
            padding: 15px;
            margin-left: 5px;
            display: flex;
            gap: 10px;
            display: flex;
            width: 435px;
        }
        .search-page-form-flexbox input:first-child {
            flex: 6;
            font-family: var(--font);
            font-size: var(--font-size);
        }
        .search-page-form-flexbox input:last-child {
            flex: 0.7;
            font-family: var(--font);
            font-size: var(--font-size);
            color: white;
            background-color: var(--button-color);
            border: 1.5px ridge;
        }
        .search-page-box {            
            background-color: var(--input-color);
            border: 1px solid black;
        }
        .search-window {
            flex: 1;
        }
        .search-filter-selection {
            font-family: var(--font);
            font-size: 12px;
        }
        .window-text-dropdown {
            display: block!important;
        }
    </style>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(true); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftProfileLinks(); ?>
            <div class="right-main-window">
                <?php $content->WindowText('Search For People'); ?>
                <div class="search-page-window">
                    <div class="search-page-content">
                        <div class="window-content search-window">                       
                            <form method="POST" action="<?php echo PageData::ROOT . 'Server Functions/search.php'; ?>" class="search-page-form">
                                <?php 
                                    echo '
                                        <div class="window-text window-text-dropdown">
                                            <span class="window-text-left">Search - </span>
                                            <select class="search-filter-selection" name="search-filter">
                                                <option value="name">Name</option>
                                                <option value="username">Username</option>
                                                <option value="email">Email</option>
                                                <option value="sex">Sex</option>
                                                <option value="home-address">Home Address</option>
                                                <option value="home-town">Home Town</option>
                                                <option value="education-status">Education Status</option>
                                                <option value="highschool">Highschool</option>
                                                <option value="looking-for">Looking For</option>
                                                <option value="interested-in">Interested In</option>
                                            </select>
                                        </div>';
                                ?>
                                <div class="search-page-form-flexbox">
                                    <input type="text" name="search-input" class="search-page-box">
                                    <input type="submit" value="Search">
                                </div>
                            </form>
                        </div>
                        <div class="window-content">                            
                            <?php 
                                $content->WindowText('Results');
                                $result_count = 0;
                                $content->LightBlueWindowText("Displaying all $result_count matches.");

                                
                                $dynamic->DisplayFriendSearchResults($result_count);                                
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $content->BottomContent(true); ?>
    </div>
</body>
</html>