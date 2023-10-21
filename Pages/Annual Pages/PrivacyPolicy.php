<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/styles.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    session_start();

    $logged_in = $_GET['logged-in'] ?? false;
    if (!isset($_COOKIE['user-token'])) {
        $logged_in = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Privacy Policy'); ?>
    <?php $styles->PrivacyPolicyPageStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent($logged_in); ?>
        <div class="main-page-flexbox">
            <?php 
                if ($logged_in) {
                    $content->LeftProfileLinks();
                } else {
                    $content->LeftLoginForm('Pages/Annual Pages/PrivacyPolicy.php');
                }
            ?>
            <div class="right-main-window">
                <?php $content->WindowText('Privacy Policy'); ?>
                <h4>[ Privacy Policy ]</h4>
                <div class="privacy-page-window">
                    <div class="privacy-page-content">
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Coverage'); ?>
                            <div>
                                <p>This privacy statement covers the site www.HarvardConnection.co. Because we want to demonstrate our commitment to our users' privacy, we will disclose our information and privacy practices below.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('About HarvardConnection and Information we Collect'); ?>
                            <div>
                                <p>HarvardConnection is an online directory and social networking community that helps people find freiends and other people. To accomplish this, our users create their own profiles and privacy settings, and some personal information we ask is displayed to people in the groups specified in the users' privacy settings.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Information Collected by HarvardConnection'); ?>
                            <div>
                                <p>HarvardConnection collects user-submitted account information such as name and email address to identify users and send notifications related to use of the site. HarvardConnection also collects user-submitted profile information such as gender, field, location, courses, etc.</p>
                                <p>HarvardConnection also collects information that is not personally identifiable and not submitted directly by users, such as browser type and IP address. This information is gathered for all users to the site.</p>
                                <p>HarvardConnection collects information from other sources, such as newspapers and instant messaging services. This information is gathered regardless of use of the site.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Use of Information Obtained by HarvardConnection'); ?>
                            <div>
                                <p>Profile information, as well as name, email and photo, are displayed to people in the groups specified in a user's privacy settings to support the function of the site. Except when inviting a friend to join the site, a user's name and email will never be given to anyone outside the site. No information submitted to HarvardConnection will be available to any user of the site who does not belong to at least one of the groups specified in a user's privacy settings.</p>
                                <p>We use server, IP and browser type for site administration. We also are information not directly submitted to HarvardConnection by users to supplement users' profiles unless they specify that they do not want this done in their privacy settings.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Spam Policy'); ?>
                            <div>
                                <p>Email addresses will never be sold to anyone, and they will not be used for spam or any other purpose outside of the site itself.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Links'); ?>
                            <div>
                                <p>This site may contain links to other websites. HarvardConnection is not responsible for the privacy practices of other web sites. We encourage our users to be aware when they leave our site and to read the privacy statements of each and every web site that collects personally identifiable information. This privacy statement applies solely to information collected by this web site.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Use of Cookies'); ?>
                            <div>
                                <p>A cookie is a piece of data stored on the user's computer tied to information about the user. We use session ID cookies to confirm that users are logged in. These cookies terminate once the users close the browser. We do not and will not use cookies to collect private information from any user.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Third Party Advertising'); ?>
                            <div>
                                <p>Advertisements that appear on this web site are delivered to users by our advertising partners. Our advertising partners may set cookies. Doing this allows the advertising networks to recognize your computer each time they send you an advertisement. In this way, they may compile information about where you, or others who are using your computer, saw their advertisements and determine which advertisements are clicked. This information allows an advertising network to deliver targeted advertisements that they believe will be of most interest to you. HarvardConnection does not have access to or control of the cookies that may be placed by the third party advertising servers of ad networks.</p>
                                <p>This privacy statement covers the use of cookies by HarvardConnection and does not cover the use of cookies by any of its advertisers.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Changing or Removing Information'); ?>
                            <div>
                                <p>HarvardConnection users may modify or remove any of their personoal information ay any time by logging into their account. Information will be updated immediately and old information will never willl be displayed to any user of the site.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Security'); ?>
                            <div>
                                <p>HarvardConnection accounts are password-protected. This web site takes every precaution to protect our users' information. Passwords are stored in hashed from in our database, and different sections of users' profiles are stored in different parts of our database to separate access to all of the information and make it more difficult to piece everything together. If you have any questions about the security of our website, please <a href="<?php echo PageData::ROOT . 'Pages/Annual Pages/ContactUs.php?logged-in=' . $logged_in; ?>">Contact Us</a>.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Changes in Our Privacy Policy'); ?>
                            <div>
                                <p>We reserve the right to change our privacy policy at any time. If we do this, we will post the changes on our web site so our users are always aware of what information we collect, how we use it, and under what circumstances, if any, we disclose it. If we are going to use users' personally identifiable information in a manner different from that stated at the time of collection, we will notify users via email.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Contacting the Web Site'); ?>
                            <div>
                                <p>If you have any questions about this privacy statement, ths practices of this site, or your delings with this web site, please <a href="<?php echo PageData::ROOT . 'Pages/Annual Pages/ContactUs.php?logged-in=' . $logged_in; ?>">Contact Us</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent($logged_in); ?>        
    </div>
</body>
</html>