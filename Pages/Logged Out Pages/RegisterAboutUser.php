<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('About You'); ?>
    <?php $styles->RegisterAboutUserStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftLoginForm(); ?>
            <div class="right-main-window">
                <?php $content->WindowText('About You'); ?>
                <div class="register-about-window">
                    <div class="register-about-page-content">
                        <div class="register-about-page-middle">
                            <div class="register-about-page-text">
                                <p>Registering with us is quick and easy. Simply fill out the form below to create your account. Once you've completed the registration process, you'll have access to all the features and benefits of being a member of our community.</p>
                            </div>
                            <div class="register-about-page-form">
                                <form method="POST" action="<?php echo PageData::ROOT; ?>/Server Functions/register-user.php">
                                    <div class="register-form-grid">
                                        <div>
                                            <label><b>Basic Info:</b></label>
                                        </div>
                                        <div></div>
                                        <div>
                                            <label for="first-name-input">First Name:</label>
                                        </div>
                                        <div>
                                            <input type="text" id="first-name-input" name="first-name" required>
                                        </div>
                                        <div>
                                            <label for="last-name-input">Last Name:</label>
                                        </div>
                                        <div>
                                            <input type="text" id="last-name-input" name="last-name" required>
                                        </div>
                                        <div>
                                            <label for="sex-input">Sex:</label>
                                        </div>
                                        <div>
                                            <select id="sex-input" name="sex" required>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="birthday-input">Birthday</label>
                                        </div>
                                        <div>
                                            <input type="date" id="birthday-input" name="birthday">
                                        </div>
                                        <div>
                                            <label for="home-address-input">Home Address:</label>
                                        </div>
                                        <div>
                                            <input type="text" id="home-address-input" name="home-address">
                                        </div>
                                        <div>
                                            <label for="home-town-input">Home Town:</label>
                                        </div>
                                        <div>
                                            <input type="text" id="home-town-input" name="home-town">
                                        </div>
                                        <div>
                                            <label for="highschool-input">High School:</label>
                                        </div>
                                        <div>
                                            <input type="text" id="highschool-input" name="highschool">
                                        </div>
                                        <div>
                                            <label for="mobile-input">Mobile:</label>
                                        </div>
                                        <div>
                                            <input type="text" id="mobile-input" name="mobile">
                                        </div>
                                        <div>
                                            <label for="website-input">Website:</label>
                                        </div>
                                        <div>
                                            <input type="url" id="website-input" name="website">
                                        </div>
                                        <div>
                                            <label><b>Personal Info:</b></label>
                                        </div>
                                        <div></div>
                                        <div>
                                            <label for="looking-for-input">Looking For:</label>
                                        </div>
                                        <div>
                                            <select id="looking-for-input" name="looking-for">
                                                <option value="friendship">Friendship</option>
                                                <option value="love">Love</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="interested-in-input">Interested In:</label>
                                        </div>
                                        <div>
                                            <select id="interested-in-input" name="interested-in">
                                                <option value="men">Men</option>
                                                <option value="women">Women</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="relationship-status-input">Relationship Status:</label>
                                        </div>
                                        <div>
                                            <input type="text" id="relationship-status-input" name="relationship-status">                                        
                                        </div>
                                        <div>
                                            <label for="political-views-input">Political Views:</label>
                                        </div>
                                        <div>
                                            <input type="text" id="political-views-input" name="political-views">
                                        </div>
                                        <div>
                                            <label for="interests-input">Interests:</label>
                                        </div>
                                        <div>
                                            <textarea id="interests-input" name="interests"></textarea>
                                        </div>
                                        <div>
                                            <label for="favorite-music-input">Favorite Music:</label>
                                        </div>
                                        <div>
                                            <textarea id="favorite-music-input" name="favorite-music"></textarea>
                                        </div>
                                        <div>
                                            <label for="favorite-movies-input">Favorite Movies:</label>
                                        </div>
                                        <div>
                                            <textarea id="favorite-movies-input" name="favorite-movies"></textarea>
                                        </div>
                                        <div>
                                            <label for="about-me-input">About Me:</label>
                                        </div>
                                        <div>
                                            <textarea id="about-me-input" name="about-me"></textarea>
                                        </div>
                                    </div>
                                    <div class="register-button">
                                        <input type="submit" value="Register Now!">
                                    </div>
                                </form>
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