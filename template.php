
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
    <?php $content->Startup('Template'); ?>
    <!-- PageStyle(); -->
    <style>
        .template-page-window {
            width: calc(var(--standard-page-width) - 240px);
            margin: 0 auto;
        }
        .template-page-content {

        }
    </style>
</head>
<body>
    <div class="main-pagebox">
        <?php $content->TopContent(); ?>
        <div class="main-page-flexbox">
            <?php $content->LeftLoginForm(); ?>
            <div class="right-main-window">
                <?php $content->WindowText('Template'); ?>
                <h4>Template</h4>
                <div class="template-page-window">
                    <div class="template-page-content">
                        <!-- Content -->
                    </div>
                </div>
            </div>            
        </div>
        <?php $content->BottomContent(); ?>        
    </div>
</body>
</html>