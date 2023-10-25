<?php 
$_path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/session-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/sql-functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $_path . 'Scripts/methods.php';
$sh = new SessionHandle();
$sql = new SQLHandle();
$methods = new Methods();
$sql->Connect();
session_start();

$account_attributes = json_decode($_COOKIE['account-attributes']);

$search_filter_input = $_POST['search-filter'];
$search_input = $_POST['search-input'];

$parts = explode(':', $search_filter_input);
$search_filter = $parts[0];
$search_filter_index = $parts[1];

if ($search_filter == 'name') {
    $search_filter = 'full_name';
}
if ($search_filter_index >= 3) {
    $selector = 'p';
} else {
    $selector = 'a';
}

$query = "SELECT a.account_id, a.full_name, a.email, p.highschool
    FROM account_info a
    INNER JOIN personal_info p ON p.personal_info_id = a.account_id
    WHERE $selector.$search_filter LIKE '%$search_input%';";
$result = mysqli_query($sql->connection, $query);
$row = mysqli_fetch_assoc($result);

$resultsArray = array();
$resultsArray[] = $row;
while ($row = mysqli_fetch_assoc($result)) {
    $resultsArray[] = $row;
}
$session_results = json_encode($resultsArray);    
$_SESSION['search-results'] = $session_results;
$_SESSION['search-results-count'] = ($resultsArray[0] == null) ? 0 : count($resultsArray);

// if (count($resultsArray) >= 30) {
//     $_SESSION['search-results-count-limit'] = 30;
// } else {
//     $_SESSION['search-results-count-limit'] = count($resultsArray);
// }

$results_count = count($resultsArray);
$_SESSION['search-results-count'] = $results_count;

if ($results_count >= 30) {
    $_SESSION['new-display-section'] = 30;    
} else {
    $_SESSION['new-display-section'] = $results_count;
}

$_SESSION['searched'] = false;
$sql->CloseConnection();
$sh->Redirect('Pages/User Pages/SearchPage.php?return-status=searched&continued-search=1');
exit;
?>