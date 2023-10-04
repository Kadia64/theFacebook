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
    <?php $content->Startup('Terms of Use'); ?>
    <?php $styles->TermsPageStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent($logged_in); ?>
        <div class="main-page-flexbox">
        <?php 
                if ($logged_in) {
                    $content->LeftProfileLinks();
                } else {
                    $content->LeftLoginForm('Pages/Annual Pages/TermsAndConditions.php');
                }
            ?>
            <div class="right-main-window">
                <?php $content->WindowText('Terms of Use'); ?>
                <h4>[ Terms of Use ]</h4>
                <div class="terms-page-window">
                    <div class="terms-page-content">
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Introduction'); ?>
                            <div>
                                <p>Welcome to Thefacebook, an online directory that connects people through social networks of academic centers. Thefacebook service is operated by Thefacebook network ("Thefacebook"). By using Thefacebook web site (the "Web site") you agree to be bound by these Terms of Use (this "Agreement"). If you wish to become a Member and communicate with other Members and make use of Thefacebook service (the "Service"), read these Terms of Use and indicate your acceptance of them by following the instructions on the regristration page.</p>
                                <p>This Agreement sets out the legally binding terms of your use of the Web site and your membership in the Service and may be modified by Thefacebook at any time and without prior notice, such modifications to be effective upon posting by Thefacebook on the Web site. This Agreement includes Thefacebook's acceptable use policy for content posted on the web site, Thefacebook's Privacy Policy, and any notices regarding the Web site.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Eligibility'); ?>
                            <div>
                                <p>You must be eighteen or over to register as a member of Thefacebook or use the Web site. Membership in the Service is void where prohibited. By using the Web site, you represent and warrent that you have the right, authority, and capacity to enter into this Agreement and to abide by all of the terms and conditions of this Agreement.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Term'); ?>
                            <div>
                                <p>This Agreement will remain in full force and effect while you use the Web site and/or are a Member. Thefacebook may terminate your membership for any reason, at any time. Even after a membership is terminated, this Agreement will remain in effect.</p>                                
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Non Commercial Use by Members'); ?>
                            <div>
                                <p>The Web site is for the personal use of individual Members only and may not be used in connection with any commercial endeavors. Organizations, companies, and/or businesses may not become Members and should not use the Service or Web site for any purpose. Illegal and/or unauthorized uses of the Web site, including collecting email addresses of members by electronic or other means for the purpose of sending unsolicited email and unauthorized framing of or linking to the Web site will be investigated, and appropriate legal action will be taken, including without limitation, civil, criminal, and injunctive redress.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Proprietary Rights in Content on Thefacebook'); ?>
                            <div>
                                <p>Thefacebook owns and retains all proprietary rights in the Web site and the Service. The Web site contains the copyrighted material, trademarks, and other proprietary information of Thefacebook, and its licensors, Except for that information which is in the public domain or for which you have been given written permission, you may not copy, modify, publish, transmit, distribute, perform, display, or sell any such proprietary information.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Content Posted on the Site'); ?>
                            <div>
                                <p>You understand and agree that Thefacebook may review and delete any content, photos or profiles (collectively "Content") that in the sole judgement of Thefacebook violate this Agreement of which might be offensive, illegal, or that might violate the rights, harm, or threaten the safety of Members.</p>
                                <p>Your profile must describe you, an individual person. Examples of inappropriate profiles include, but are not limited to, profiles that purport to represent an animal, place, inanimate objects, fictional character, or real individual who is not you.</p>
                                <p>You are solely responsible for the Content that you publish or display on the Service, or transmit to other Members.</p>
                                <p>By posting Content to any public area of Thefacebook, you automatically grand, and you represent and warrant that you have the right to grant, to Thefacebook an irrevocable, prepetual, non-exclusive, fully paid, worldwide license to use, copy, perform, display, and distribute such information and content and to prepare derivative works of, or inforporate into other works, such information and content, and to grant and authorize sublicenses of the foregoing.</p>
                                <p>Thefacebook reserves the right to investigate and take appropriate legal action in its sole descretion against anyone who violates this provision, including without limitation, removing the offending communication from the Service and terminating the membership of such violators. Even though such use is strictly prohibited, there is a small chance that you might become exposed to such items and you further waive your right to any damages (from any party) related to such experience.</p>
                                <p>you must use the Service in a manner consistent with any and all applicabel laws and regulations.</p>
                                <p>You may not engage in adversiting to, or solicitation or, other Members to buy or sell any products or services through the Service. You may not transmit any chain letters or junk email to other members. Although Thefacebook cannot monitor the conduct of its members off the Web site, it is also a violation of these rules to use any information obtained from the Service in order to harass, abuse, or harm another person, or in order to advertise to, solicit, or sell to any member without their prior consent.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Copyright Policy'); ?>
                            <div>
                                <p>You may not post, distribute, or reproduce in any way any coprighted material, trademarks, or other proprietary information without obtaining the prior written consent of the owner of such proprietary rights. Without limiting the foregoing, if you believe that your work has been copied and posted on the Service in a way that constitutes copyright infringement, please provide us with the following information: an electronic or physical signature of the person authorized to act on behalf of the owner of the copright interest; a description of the copyrighted work that you claim has been infringed; a description of where the material that you claim has been infringed is located on the Web site; your address, telephone number, and email address; a written statement by you that you have good faith belief that the disputed use it not authorized by the copyright owner, its agent, or the law; a statement by you, made under penalty or perjury, that the above information in your notice is accurate and that you are the copyrightowner or authorized to act on the copyright owner's behalf. Thefacebook can be reached at <a href="">info@thefacebook.com</a>.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Member Disputes'); ?>
                            <div>
                                <p>You are soley responsible for your interactions with other Thefacebook Members. Thefacebook reserves the right, but has no obligation, to monitor disputes between you and other Members.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Privacy'); ?>
                            <div>
                                <p>Use of the Website and/or the Service is also governed by our <a href="<?php echo PageData::ROOT . 'Pages/Annual Pages/PrivacyPolicy.php?logged-in=' . $logged_in; ?>">Privacy Policy</a>.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Disclaimers'); ?>
                            <div>
                                <p>Thefacebook is not responsible for any incorrect or inaccurate Content posted on the Web site or in connection with the Service, wheather caused by users of the Web site, Members or by any of the equipment or programming associated with or utilized in the Service. Thefacebook is not responsible for the conduct, wheather online or offline, of any user of the Web site or Member of the Service, Thefacebook assumes no responsibility for any error, omission, interruption, deleion, defect, delay in operation or transmission, communications line failure, theft or destruction or unauthorized access to, or alteration of, user or Member communications. Thefacebook is not responsible for any problems or technical malfunction of any telephone network or lines, computer online systems, servers or providers, computer equipment, software, failure of email or players on account of technical probelms or traffic congestion on the Internet or at any web site or combition thereof, including injury or damage to users and/or Memebers or to any other person's computer related to or resulting from participating or downloading materials in connection with the Web and/or in connection with the Service, Under no circumstances will Thefacebook be responsible for any loss of damage, including personal injury or death, resulting from anyone's use of the Web site or the Service, any Content posted on the Web site or transmitted to Members, or any interactions between users of the Web site, wheather online or offline. The Web site and the Service are provided "AS-IS" and Thefacebook expressly disclaims any warranty of fitness for a particular purpose or non-infringement. Thefacebook cannot guarantee and does not promise any specific results from the use of the Web site and/or the Service. The service may be temporarily unavailable from time to time for maintenance or other reasons. No advice or information, wheather oral or written, obtained by user from Thefacebook or through or from the service shall create any warranty noy expressly stated herein.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Limitation on Liability'); ?>
                            <div>
                                <p>Except in jurisdictions where such provisions are restricted, in no event will Thefacebook be liable to you or any third person for any indirect, consequential, exemplary, incidential, special or punitive damages, including also lost profits arising from your use of the Web site or the Service, even if Thefacebook has been advised of the possibility of such damages. Notwithlstanding anything to the contrary contained herein, Thefacebook's liability to you for any cause whatsoever and, regardless of the form of the action, will at all times be limited to the amount paid, if any, by you to Thefacebook for the Service during the term of membership.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Disputes'); ?>
                            <div>
                                <p>If there is any dispute about or involving the Web site and/or the Service, by using the Web site, you agree that the dispute will be governed by the laws of the State of Massachusetts without regard to its conflict of law provisions. You agree to personal jurisdiction by and venue in the state and federal courts of the State of Massachusetts, City of Boston.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Links'); ?>
                            <div>
                                <p>This site may contain links to other websites, Thefacebook is not responsible for the privacy practices of other Web sites. We encourage our users to beware when the leave our site and to read the privacy statements of each and every web site that collections personally identifiable information. This privacy statement applies solely to information collected by this web site.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Third Party Adversiting'); ?>
                            <div>
                                <p>Adversitements that appear on this web site are delivered to users by our advertising partners. Our advertising partners may set cookies. Doing this allows the advertising network recognize your computer each time they send you an advertisement. In this way, they may compile information about where youm or others who are using your computer, saw their advertisements and determine which advertisements are clicked. This information allows an advertising network to deliver targeted advertisements that they believe will be of most interest to you. Thefacebook does not have access to or control of the cookie sthat may be placed by third party advertising servers of ad networks.</p>
                                <p>This privacy statement covers the use of cookies by Thefacebook and does not cover the use of cookies by any of its advertisers.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Changing or Removing Information'); ?>
                            <div>
                                <p>Thefacebook users may modify or remove any of their personal information at any time by logging into their account. Information will be updated immediately and old information will never be displayed to any user of the site.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('Security'); ?>
                            <div>
                                <p>Thefacebook accounts are password-protected. This website takes every precaution to protect out users' information. Passwords are stored in a hashed form in our database, and different sections of user's profiles are stored in different parts of our database to seperate access to all of the information and make it more difficult to piece everything together. If you have any questions about the security of our web site, pleasa <a href="<?php echo PageData::ROOT . 'Pages/Annual Pages/ContactUs.php?logged-in=' . $logged_in; ?>">contact us</a>.</p>
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
                                <p>If you have any questions about this privacy statement, the practices of this site, or you dealings with this web site, please <a href="<?php echo PageData::ROOT . 'Pages/Annual Pages/ContactUs.php?logged-in=' . $logged_in; ?>">contact us</a>.</p>
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