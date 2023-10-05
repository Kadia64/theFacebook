<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    session_start();

    $logged_in = $_GET['logged-in'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Job Descriptions'); ?>
    <?php $styles->JobDescriptionPageStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent($logged_in); ?>
        <div class="main-page-flexbox">
            <?php 
                if ($logged_in) {
                    $content->LeftProfileLinks();
                } else {
                    $content->LeftLoginForm('Pages/Annual Pages/JobDescriptions.php');
                }
            ?>
            <div class="right-main-window">
                <?php $content->WindowText('Job Descriptions'); ?>
                <h4>[ Job Descriptions ]</h4>
                <div class="job-description-page-window">
                    <div class="job-description-page-content">
                        <h3>EXECUTIVE MANAGEMENT</h3>
                        <ul class="parent-list">
                            <li>
                                <p class="parent-title">VP Engineering</p>
                                <p class="parent-text">Are you an all star engineering manager who has successfully scaled a consumer Internet service to millions of users?</p>
                                <p class="sub-header"><i>Requirements:</i></p>
                                <ul class="sub-list">
                                    <li>5+ years engineering management</li>
                                    <li>8+ years engineering</li>
                                </ul>
                            </li>
                        </ul>
                        <h3>ENGINEERING</h3>
                        <ul class="parent-list">
                            <li>
                                <p class="parent-title">Sr. Server Software Engineer</p>
                                <p class="parent-text">Can you build systems that are scalable to support millions of people?</p>
                                <p class="sub-header"><i>Requirements:</i></p>
                                <ul class="sub-list">
                                    <li>BS or MS in Computer Science or equivalent</li>
                                    <li>Experience with large-scale, distributed, and highly scalable systems</li>
                                    <li>Desire to work in a fast-paced, creative environment</li>
                                    <li>Passionate about working on a system used by millions of people</li>
                                </ul>
                                <p class="sub-header">Skills:</p>
                                <ul class="sub-list">
                                    <li>Extensive knowledge of PHP, Apache, SQL, Linux, Qmail, and MySQL</li>
                                    <ul class="sub-list">
                                        <li>C/C++ and Python programming skills (strongly desired)</li>
                                    </ul>
                                </ul>
                            </li>
                            <br>
                            <li>
                                <p class="parent-class">Sr. Interface Software Engineer</p>
                                <p class="parent-text">Are you excited about building interfaces that are simple and intuitive enough to be used by millions of people?</p>
                                <p class="parent-header"><i>Requirements:</i></p>
                                <ul class="sub-list">
                                    <li>BS or MS in Computer Science in equivalent</li>
                                    <li>Experience with large-scale, distributed, and highly scalable systems</li>
                                    <li>Desire to work in a fast-paced, creative environment</li>
                                    <li>Ability to put yourself in the user's shoes</li>
                                    <li>Capable of investing blood, sweat, and time tomake complex features simple and easy to use</li>
                                    <li>Passionate about working on a product used by millions of people</li>
                                </ul>
                                <p class="sub-header"><i>Skills:</i></p>
                                <ul class="sub-list">
                                    <li>Extensive knowledge of PHP, SQL, HTML/DHTML, JavaScript</li>
                                </ul>
                            </li>
                            <br>
                            <li>
                                <p class="parent-title">Customer Support Technician</p>
                                <p class="parent-text">Do you want us to help build the ultimage college networking experience? Are you passionate about interacting with people?</p>
                                <p class="parent-header"><i>Requirements:</i></p>
                                <ul class="sub-list">
                                    <li>BS or MS in Computer Science or programming background preferred</li>
                                    <li>Experience with PHP,HTML, JavaScript a strong plus</li>
                                    <li>Excellent written communication skills</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="job-description-pagea-bottom">
                        <p>If interested in any of the above positions, write to <a href="">jobs@thefacebook.com</a>.</p>
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent($logged_in); ?>        
    </div>
</body>
</html>