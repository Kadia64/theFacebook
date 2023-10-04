<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    session_start();
    
    $logged_in = $_GET['logged-in'] ?? false;
    $home_link = PageData::ROOT . 'Pages/';
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('About'); ?>
    <?php $styles->AboutPageStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent($logged_in); ?>
        <div class="main-page-flexbox">
            <?php 
                if ($logged_in) {
                    $home_link .= 'User Pages/UserHomePage.php';
                    $content->LeftProfileLinks();
                } else {
                    $home_link .= 'Logged Out Pages/Welcome.php';
                    $content->LeftLoginForm('Pages/Annual Pages/About.php');
                }
            ?>
            <div class="right-main-window">
                <?php $content->WindowText('About Thefacebook'); ?>
                <h4>[ About ]</h4>
                <div class="about-page-window">
                    <div class="about-page-content">
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('The Project'); ?>
                            <div class="box1">
                                <p>Thefacebook is an online directory that connects people through social networks at colleges and universities.</p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('The People'); ?>
                            <div class="box2">
                                <div class="box2-grid">
                                    <div>
                                        <p><a href="">Mark Zuckerberg</a></p>
                                    </div>
                                    <div>
                                        <p>Founder, Master and Commander, Enemy of the State.</p>
                                    </div>
                                    <div>
                                        <p><a href="">Eduardo Saverin</a></p>
                                    </div>
                                    <div>
                                        <p>Business Stuff, Corporate Stuff, Brazilian Affairs.</p>
                                    </div>
                                    <div>
                                        <p><a href="">Dustin Moskovitz</a></p>
                                    </div>
                                    <div>
                                        <p>No Longer Expendable Programmer, Paid Assassin.</p>
                                    </div>
                                    <div>
                                        <p><a href="">Andrew McCollum</a></p>
                                    </div>
                                    <div>
                                        <p>Graphic Art, General Rockstar</p>
                                    </div>
                                    <div>
                                        <p><a href="">Chris Hughes</a></p>
                                    </div>
                                    <div>
                                        <p>The Secret Weapon.</p>
                                    </div>
                                </div>
                                <br>
                                <p><a href="<?php echo PageData::ROOT . 'Pages/Annual Pages/ContactUs.php?logged-in=' . $logged_in; ?>">Contact us.</a></p>
                            </div>
                        </div>
                        <div class="annual-page-content-box">
                            <?php $content->WindowText('News Coverage'); ?>
                            <div class="box3">
                                <div class="box3-content">
                                    <div>
                                        <p>[ New York Times ]</p>
                                        <p><a href="">Are We a Match? (04.25.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ CNN.com ]</p>
                                        <p><a href="">Daring to date across party lines (04.15.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Chronicle of Higher Education ]</p>
                                        <p><a href="">Friends, Digitally (05.24.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Harvard Crimson ]</p>
                                        <p><a href="">Sociology of thefacebook.com (03.18.04)</a></p>
                                        <p><a href="">Manifest Destiny, Facebook Style (03.11.04)</a></p>
                                        <p><a href="">Columbia Rebukes thefacebook.com (03.09.04)</a></p>
                                        <p><a href="">Facebook Expands Beyond Harvard (03.01.04)</a></p>
                                        <p><a href="">Harvard Bonds on Facebook Website (02.18.04)</a></p>
                                        <p><a href="">Show Your Best Face (02.17.04)</a></p>
                                        <p><a href="">Hundreds Register for New Facebook Website (02.09.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Harvard Independent ]</p>
                                        <p><a href="">Face to Face (03.04.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Stanford Daily ]</p>
                                        <p><a href="">Thefacebook.com for dummies (03.10.04)</a></p>
                                        <p><a href="">TheFacebook.com's darker side (03.10.04)</a></p>
                                        <p><a href="">All the cool kids are doing it (03.05.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Columbia Spectator ]</p>
                                        <p><a href="">CU, Harvard Sites End 'E-War' (03.22.04)</a></p>
                                        <p><a href="">New Harvard-Based Facebook Adds Columbia To Database (03.04.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Dartmouth ]</p>
                                        <p><a href="">Online facebook sees no end in sight for growth (05.13.04)</a></p>
                                        <p><a href="">The Fashion Statement: 'Face It' (04.09.04)</a></p>
                                        <p><a href="">Students flock to web-based facebook (03.09.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Cornell Daily Sun ]</p>
                                        <p><a href="">Facebook Connects C.U. (03.09.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Daily Pennsylvanian ]</p>
                                        <p><a href="">Students flock to join college online facebook (03.18.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Daily Free Press (BU) ]</p>
                                        <p><a href="">BU newest addition to thefacebook.com (03.24.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Brown Daily Herald ]</p>
                                        <p><a href="">Privacy settings on TheFacebook.com allow users to maintain security (04.14.04)</a></p>
                                        <p><a href="">Harvard online facebook service plans to hook up Brown students (03.24.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Yale Herald ]</p>
                                        <p><a href="">Harvard facebook website now includes Yale (03.26.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Daily Princetonian ]</p>
                                        <p><a href="">The quest for friends -- thefacebook.com (04.16.04)</a></p>
                                        <p><a href="">Students to connect through web facebook (03.31.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Marquette Tribune ]</p>
                                        <p><a href="">'Facebook' popular on campuses (04.02.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Chronicle Duke ]</p>
                                        <p><a href="">Thefacebook.com opens to Duke students (04.14.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Hoya ]</p>
                                        <p><a href="">www.thefacebook.com (04.22.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Daily Californian (Berkeley) ]</p>
                                        <p><a href="">Putting Your Best Face Forward (04.27.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Daily Northwestern ]</p>
                                        <p><a href="">Face It (04.27.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Heights (Boston College) ]</p>
                                        <p><a href="">Facebook expands to BC campus (04.27.03)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Wellesley News ]</p>
                                        <p><a href="">Thefacebook aids in making friends and procrastinating (04.28.04)</a></p>
                                    </div>
                                    <div>
                                        <p>[ The Chicago Maroon ]</p>
                                        <p><a href="">Facebook defies utilitarianism, insults Mill (05.11.04)</a></p>
                                        <p><a href="">Social website draws heavy traffic (05.07.04)</a></p>
                                        <p><a href="">Facebook is the greatest thing since Marx (05.04.04)</a></p>
                                        <p><a href="">U of C connects to new social website (04.30.04)</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about-page-back-button">
                            <a href="<?php echo $home_link; ?>">Home</a>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent($logged_in); ?>
    </div>
</body>
</html>