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
    
    $sh->CheckActiveSession(false);    

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
        function LoadMoreResults($dynamic, $content) {
            $_SESSION['searched'] = true;
            $_SESSION['load-more-pressed'] += 1;
            $session_results = $_SESSION['search-results'];
            $dynamic->DisplayFriendSearchResults($session_results, $_SESSION['displayed-results']);
            exit;
        }
        function DisplayCount($content) {            
            $content->LightBlueWindowText("Displaying all " . $_SESSION['displayed-results'] . " matches.");
            exit;
        }        
        switch ($_POST['action']) {
            case 'LoadMoreResults':
                LoadMoreResults($dynamic, $content);
                break;
            case "TopDisplayResults":
                DisplayCount($content);
                break;
            case "BottomDisplayResults":
                DisplayCount($content);
                break;
        }
    } else {
        // first page load
        if ($_GET['return-status'] == 'clear') {
            $_SESSION['refresh-count'] = 0;
            $_SESSION['displayed-results'] = 0;
            $_SESSION['load-more-pressed'] = 0;
            $_SESSION['searched-session-count'] = 0;
            $_SESSION['first-searched'] = false;
            unset($_SESSION['search-results']);
            unset($_SESSION['search-results-count']);
            unset($_SESSION['new-display-section']);
            $sh->Redirect('Pages/User Pages/SearchPage.php?return-status=normal');
            exit;
        }
    }
    $_SESSION['refresh-count'] += 1;

    echo $_SESSION['displayed-results'] . "<br>";
    echo $_SESSION['searched-session-count'] . "<br>";
    echo $_SESSION['refresh-count'] . "<br>";

    // if ($_SESSION['refresh-count'] == 2) {
    //     $_SESSION['refresh-count'] = 0;
    //     $sh->Redirect('Pages/User Pages/SearchPage.php?return-status=normal&set-vars=1');
    //     $sh->CheckActiveSession(true);
    //     exit;
    // }
    //print_r($_SESSION);


    //echo $_SESSION['load-more-pressed'];

    $user_data_cookie = json_decode($_COOKIE['user-data']);
    $account_attributes = json_decode($_COOKIE['account-attributes']);
    $max_results_limit = 30;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            font-family: var(--font);
            font-size: var(--font-size);
            color: white;
            background-color: var(--button-color);
            border: 1.5px ridge;
            flex: 0.7;
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
        .search-results-box {
            display: flex;
            flex-direction: column;
        }
        .search-result-profile {
            flex: 1;
            display: flex;
            padding: 8px;
            border-bottom: 1px solid var(--darkblue);
        }
        .profile-image-search-result {
            flex: 1;
        }
        .profile-image-search-result img {
            width: 85px;
            height: 85px;
        }
        .personal-info-search-result {
            flex: 4;
        }
        .personal-info-search-result table {
            margin-top: 15px;
        }
        .personal-info-search-result table tr td {
            font-family: var(--font);
            font-size: var(--font-size);
        }
        .personal-info-search-result table tr td:last-child {
            padding-left: 10px;
        }
        .personal-info-search-result-lb {
            color: var(--lightblue);
        }
        .search-result-buttons {
            flex: 2;
        }
        .search-result-buttons-box {
            border: 1px solid var(--darkblue);
            width: 90px;
            height: 57px;
            margin-top: 15px;            
        }
        .search-result-buttons-box p {
            margin: 0;
        }
        .search-result-buttons-box a {
            font-family: var(--font);
            font-size: var(--font-size);
            color: var(--lightblue);
            text-decoration: none;
            margin-left: 2px;
        }
        .search-result-buttons-box a:hover {
            color: var(--hover-lightblue);
            text-decoration: underline;
        }
        .search-result-buttons-box p:nth-child(even) {
            border-top: 1px solid var(--darkblue);
            border-bottom: 1px solid var(--darkblue);
        }
        .no-results p {
            font-family: var(--font);
            font-size: var(--font-size);
            margin-left: 20px;
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
                            <form method="POST" action="<?php echo PageData::ROOT . 'Server Functions/search.php?continued-search=1'; ?>" class="search-page-form">
                                <div class="window-text window-text-dropdown">
                                    <span class="window-text-left">Search - </span>
                                    <select class="search-filter-selection" name="search-filter">
                                        <option value="name:0">Name</option>
                                        <option value="username:1">Username</option>
                                        <option value="email:2">Email</option>
                                        <option value="sex:3">Sex</option>
                                        <option value="home_address:4">Home Address</option>
                                        <option value="home_town:5">Home Town</option>
                                        <option value="education_status:6">Education Status</option>
                                        <option value="highschool:7">Highschool</option>
                                        <option value="looking_for:8">Looking For</option>
                                        <option value="interested_in:9">Interested In</option>
                                    </select>
                                </div>
                                <div class="search-page-form-flexbox">
                                    <input type="text" name="search-input" class="search-page-box">
                                    <input type="submit" value="Search">
                                </div>
                            </form>
                        </div>
                        <div class="window-content">
                            <?php
                                $page_reload = ($_SESSION['load-more-pressed'] > 0);
                                $_SESSION['new-display-section'] = isset($_SESSION['new-display-section']) ? $_SESSION['new-display-section'] : 0;
                                $content->WindowText('Results');

                                //$result_count = ($_SESSION['search-results-count'] < 30) ? $_SESSION['displayed-results'] : $_SESSION['search-results-count'];
                                //$result_count = isset($_SESSION['displayed-results']) ? $_SESSION['displayed-results'] : 30;
                                //$result_count = $_SESSION['searched'] ? $_SESSION['displayed-results'] : 0;                                
                                //if ()
                                //$result_count = ($first_search && ($total_count));
                                
                                // if ($_SESSION['first-searched']) {
                                //     $result_count = ($_SESSION['search-results-count'] >= 30) ? 30 : $_SESSION['search-results-count'];
                                // } else {
                                //     $result_count = $_SESSION['displayed-results'];
                                // }

                                $result_count = 0;


                                echo $_SESSION['search-results-count'] . '<br>';
                                echo $_SESSION['displayed-results'] . '<br>';
                                

                                
                                echo '<div id="top-result-count-display">';
                                $content->LightBlueWindowText("Displaying all $result_count matches.");
                                echo '</div>';
                                
                                if (isset($_SESSION['search-results-count'])) {
                                    echo '<div class="search-results-box" id="search-results-box">';
                                    $session_results = $_SESSION['search-results'];
                                    $dynamic->DisplayFriendSearchResults($session_results, 0, $page_reload ? true : false, $_SESSION['displayed-results']);
                                    echo '</div>';
                                } else {
                                    echo '
                                        <div class="no-results">
                                            <p>Found 0 results.</p>
                                        </div>
                                    ';
                                }

                                //echo $_SESSION['displayed-results'];
                                if ($_SESSION['new-display-section'] >= $max_results_limit) {
                                    echo '<button id="load-more-button">[ Display More ]</button>';
                                }
                                //echo $_SESSION['displayed-results'];
                                //echo $_SESSION['new-display-section'];

                                echo '<div id="bottom-result-count-display">';
                                $content->LightBlueWindowText("Displaying all $result_count matches.");
                                echo '<div>';                               
                            ?>
                            <script>
                                $(document).ready(function() {
                                    $('#load-more-button').click(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            data: { action: 'LoadMoreResults' },
                                            success: function(response) {
                                                $('#search-results-box').append(response);
                                                $.ajax ({
                                                    type: 'POST',
                                                    data: { action: 'TopDisplayResults' },
                                                    success: function(response) {
                                                        $('#top-result-count-display').html(response);
                                                        $.ajax ({
                                                            type: 'POST',
                                                            data: { action: 'BottomDisplayResults' },
                                                            success: function(response) {
                                                                $('#bottom-result-count-display').html(response);
                                                            }
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                            </script>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $content->BottomContent(true); ?>
    </div>
</body>
</html>