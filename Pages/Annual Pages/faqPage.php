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
    <?php $content->Startup('FAQ'); ?>
    <?php $styles->FAQPageStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent($logged_in); ?>
        <div class="main-page-flexbox">
            <?php 
                if ($logged_in) {
                    $content->LeftProfileLinks();
                } else {
                    $content->LeftLoginForm('Pages/Annual Pages/ContactUs.php'); 
                }
            ?>
            <div class="right-main-window">
                <?php $content->WindowText('Frequently Asked Questions'); ?>
                <h4>[ FAQ ]</h4>
                <div class="faq-page-window">
                    <div class="faq-page-content">
                        <div>
                            <ul class="faq-page-list">
                                <li><a href="#window1">What is Thefacebook?</a></li>
                                <li><a href="#window2">How do you get our information? Does the school give it to you?</a></li>
                                <li><a href="#window3">How can I protect my privacy?</a></li>
                                <li><a href="#window4">What is the social net?</a></li>
                                <li><a href="#window5">Why does the social net repeat people?</a></li>
                                <li><a href="#window6">How do I search for something besides names?</a></li>
                                <li><a href="#window7">If I reject someone, will they find out?</a></li>
                                <li><a href="#window8">How can I view the visualization?</a></li>
                                <li><a href="#window9">Why is the visualization slow?</a></li>
                                <li><a href="#window10">How do I navigate through the visualization?</a></li>
                                <li><a href="#window11">Can I change my name and password?</a></li>
                                <li><a href="#window12">My old picture keeps showing up. Why is this?</a></li>
                                <li><a href="#window13">When I try to log in, the page just refreshes. What's going on?</a></li>
                                <li><a href="#window14">What is poking?</a></li>
                                <li><a href="#window15">Who made this site?</a></li>
                                <li><a href="#window16">When was the site started?</a></li>
                                <li><a href="#window17">Is this a class project?</a></li>
                                <li><a href="#window18">What kind of graph theory algorithms are you using to process connections?</a></li>
                                <li><a href="#window19">I have a question that's not covered in the FAQ. How can I ask it?</a></li>
                            </ul>
                        </div>
                        <div class="annual-page-content-box" id="window1">
                            <?php $content->WindowText('What is Thefacebook?'); ?>
                            <div>
                                <p>Thefacebook is an online directory that connects people through social networks at colleges and universities.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window2">
                            <?php $content->WindowText('How do you get our information? Does the school give it to you?'); ?>
                            <div>
                                <p>Your school is not providing us with any information about you. All information and pictures are provided voluntarily by users.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window3">
                            <?php $content->WindowText('How can I protect my privacy?'); ?>
                            <div>
                                <p>You can adjust your privacy settings to allow only people within certain divisions of certain schools to see it. You can also set it so that only people who share something in common with you (eg. house, year, a course, friends) can see your information. And further, you can create different privacy settings for the four different parts of your profile: contact information, personal information, courses and friends.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window4">
                            <?php $content->WindowText('What is the social net?'); ?>
                            <div>
                                <p>Your <a href="">social net</a> is the group of users whoese privacy settings allow you to view their information. To make things more interesting, we also limit it to only users who have submitted pictures. When you click on "social net", ten random users from your social net are displayed.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window5">
                            <?php $content->WindowText('Why does the social net repeat people?'); ?>
                            <div>
                                <p>Since the selection of who is displayed is random, there is a chance that the same person will be displayed on two pages. This problem will alleviate itself as more people join.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window6">
                            <?php $content->WindowText('How do I search for something besides names?'); ?>
                            <div>
                                <p>You can ether click on the "Search all Fields" button on the <a href="">search</a> page, or try the <a href="">advanced search</a> page.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window7">
                            <?php $content->WindowText('If I reject someone, will they find out?'); ?>
                            <div>
                                <p>No. When you reject someone, their friend request will leave your list of friendships to confirm, but they will not be notified. They will also not be able to sent you another friend request for some amount of time, so to them, it will just seem as if you haven't confirmed their friendship yet.</p>
                            </div>                    
                        </div>
                        <div class="annual-page-content-box" id="window8">
                            <?php $content->WindowText('How can I view the visualization?'); ?>
                            <div>
                                <p>In order to see the visualization of the social nets, you need to have the SVG plugin for your browser. Installation takes about 15 seconds; you can get it <a href="">here</a>.</p>                                
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window9">
                            <?php $content->WindowText('Why is the visualization slow?'); ?>
                            <div>
                                <p>Every time you view a visualization, we need to figure out wheather you have the appropriate privileges to see each person on the graph. This takes time. In addition, in order to maintain the overall performance of the rest of the site, we have set up the site to process other requests with a higher priority than requests to generate visualizations.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window10">
                            <?php $content->WindowText('How do I navigate through the visualization'); ?>
                            <div>
                                <p>Hold down 'Alt' while dragging to scroll, or right-click to zoom. We apologize for the difficulty of navigating the visualizations. We didn't make the SVG viewer; we just use it to bring you pretty pictures.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window11">
                            <?php $content->WindowText('Can I change my name and password?'); ?>
                            <div>
                                <p>Yes - you can request a name change and change your password on your <a href="">my account</a> page. For quality control purposes, we confirm all name changes before they take place. Password changes take effect immediately.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window12">
                            <?php $content->WindowText('My old picture keeps showing up. Why is this?'); ?>
                            <div>
                                <p>This is due to your browser caching images to improve display time. Hold down CTRL while reloading the page to force the browser to refresh the image.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window13">
                            <?php $content->WindowText("When I try to log in, the page just refreshes. What's going on?"); ?>
                            <div>
                                <p>You need to enable cookies on your browser. In order to do this in Internet Explored, go to tools: options from the menu at top. Then click on the privacy tab, and alter your privacy settings to allow cookies. Finally, close and restart your browser and try logging in again.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window14">
                            <?php $content->WindowText('What is poking?'); ?>
                            <div>
                                <p>We have about as much of an idea as you do. We thought it would be fun to make a feature that has no specific purpose and to see what happens from there. So mess around with it, because you're not getting an explanation from us.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window15">
                            <?php $content->WindowText('Who made this site'); ?>
                            <div>
                                <p>See the <a href="<?php echo PageData::ROOT . 'Pages/Annual Pages/About.php?logged-in=' . $logged_in; ?>">about</a> page.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window16">
                            <?php $content->WindowText('When was the site started?'); ?>
                            <div>
                                <p>It was launched to the public on Wednesday, February 4th, 2004.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window17">
                            <?php $content->WindowText('Is this a class project?'); ?>
                            <div>
                                <p>Nope, just for fun.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box" id="window18">
                            <?php $content->WindowText('What kind of graph theory algorithms are you using to process connections?'); ?>
                            <div>
                                <p>I'm going to pretend you didn't just ask that.</p>
                            </div>                            
                        </div>
                        <div class="annual-page-content-box" id="window19">
                            <?php $content->WindowText("I have a question that's not covered in the FAQ. How can I ask it? "); ?>
                            <div>
                                <p><a href="<?php echo PageData::ROOT . 'Pages/Annual Pages/ContactUs.php?logged-in=' . $logged_in; ?>">Eamil us</a>.</p>
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