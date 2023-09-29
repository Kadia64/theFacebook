<?php 
    $path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/content.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/session-functions.php';
    $content = new Content();
    $styles = new Styles();
    $pages = new PageData();
    $dh = new DataHandle();
    $sh = new SessionHandle();
    session_start();
    $sh->CheckTraversal();

    if (isset($_GET['account-create-fail'])) {
        if ($_GET['account-create-fail'] == 'username') {
            $dh->Alert('Username already exists!');
        } else if ($_GET['account-create-fail'] == 'email') {
            $dh->Alert('Email already exists!');
        } else if ($_GET['account-create-fail'] == 'both') {
            $dh->Alert('Both the username and email exist!');
        }
        $sh->Redirect('Logged Out Pages/RegisterUser.php', 'js');
    }        
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <?php $content->Startup('Register'); ?>
    <?php $styles->RegisterUserStyle(); ?>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(false); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftLoginForm(); ?>
            <div class="right-main-window">
                <?php $content->WindowText('Registration'); ?>
                <div class="register-page-window">
                    <div class="register-page-content">
                        <p>To register for thefacebook.com, just fill out the four fields below. You will have a chance to enter additional information and submit a picture once you have registered.</p>
                        <div class="register-page-middle">
                            <form method="POST" action="<?php echo PageData::ROOT; ?>/Server Functions/session-registration.php?prev-page=<?php echo 'Pages/Logged Out Pages/RegisterAboutUser.php'; ?>" class="register-page-form">
                                <div class="register-page-grid">
                                    <div>
                                        <label>Username:</label>
                                    </div>
                                    <div>
                                        <input type="text" id="username" name="username" class="register-username" required>
                                    </div>
                                    <div>
                                        <label>Status:</label>
                                    </div>
                                    <div>
                                        <select id="status" name="status" class="register-status" required>
                                            <option value="student">Student</option>
                                            <option value="grad-student">Grad-Student</option>
                                            <option value="alumnus-alumna">Alumnus/Alumna</option>                                            
                                            <option value="faculty">Faculty</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label>Email: (choose)</label>
                                    </div>
                                    <div>
                                        <input type="email" id="email" name="email" class="register-email" required>
                                    </div>
                                    <div>
                                        <label>Password*: (choose)</label>
                                    </div>
                                    <div>
                                        <input type="password" id="password" name="password" class="register-password" required>
                                    </div>                                    
                                </div>
                                <div class="register-page-bottom-box">
                                    <div class="register-page-checkbox">
                                        <input type="checkbox" required>
                                        <p>I have read and understood the <?php $content->Link('Terms of Use', $pages->TERMS_AND_CONDITIONS, PageData::LINK_CLASS); ?>, and I agree to them.</p>
                                    </div>
                                    <div class="register-page-password">
                                        <p>*</p>
                                        <p>You can choose any password. It does not have to be, and should not be, your school password.</p>
                                    </div>
                                </div>
                                <div class="register-page-button">
                                    <input type="submit" id="register" name="register" value="Register">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent(); ?>        
    </div>
</body>
</html>