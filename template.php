<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'ScrewOff') {
        function ScrewOff() {
            echo "what the hell";
            exit;
        }

        ScrewOff();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="search-results-box">
        <!-- Initial content goes here -->
    </div>
    <button id="load-more-button" type="button">Load More</button>

    <script>
    $(document).ready(function() {
        $('#load-more-button').click(function() {
            $.ajax({
                type: 'POST',
                data: { action: 'ScrewOff' },
                success: function(response) {
                    $('#search-results-box').html(response);
                }
            });
        });
    });
    </script>
</body>
</html>
