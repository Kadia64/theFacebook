<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
class SQLHandle {
    public const ENABLED = true;
    public $Server;
    public $Database;
    public $Username;
    public $Password;
    public $connection;
    private $files;
    private $dh;
    private $_tables;
    public function __construct() {
        $this->files = new FileHandle();
        $this->dh = new DataHandle();
        $this->_tables = new SQLTables();
        $sql_info = $this->files->ServerConfig;
        $this->Server = $sql_info->{"MySQL-Credentials"}->{"Server"};
        $this->Database = $sql_info->{"MySQL-Credentials"}->{"Database"};
        $this->Username = $sql_info->{"MySQL-Credentials"}->{"Username"};
        $this->Password = $sql_info->{"MySQL-Credentials"}->{"Password"};
    }
    public function Connect() {
        $this->connection = mysqli_connect($this->Server, $this->Username, $this->Password, $this->Database);
    }
    public function CloseConnection() {
        $this->connection->close();
    }
    public function CheckConnection() {
        if ($this->connection) {
            return true;
        } else return false;
    }

    public function InsertAccountRow($personal_info, $account_info) {
        $full_name = '"' . $this->Nullable($personal_info['first-name']) . ' ' .  $this->Nullable($personal_info['last-name']) . '"';
        mysqli_query($this->connection, 'INSERT INTO account_settings (allow_mentions, activity_status, suggest_account) VALUES (\'People You Follow\', true, true)');
        mysqli_query($this->connection, 'SET @last_settings_id = LAST_INSERT_ID();');
        mysqli_query($this->connection, 'INSERT INTO account_stats (login_count, logout_count, last_login_timestamp, last_logout_timestamp, password_attempts, last_password_attempt_timestamp, password_change_count, last_password_changed_timestamp, member_since, last_update) VALUES (0, 0, NULL, NULL, 0, NULL, 0, NULL, \'' . $this->dh->GetTimeStamp(0) . '\', \'' . $this->dh->GetTimeStamp(0) . '\');');
        mysqli_query($this->connection, 'SET @last_account_stats_id = LAST_INSERT_ID();');
        mysqli_query($this->connection, 'INSERT INTO social_stats (friend_count, friend_email_list, blocked_count, blocked_username_list, reported_count, message_all_count, unread_message_count, message_sent_count, message_received_count, verification_request_count, verification_request_last_timestamp) VALUES (0, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, NULL);');
        mysqli_query($this->connection, 'SET @last_social_stats_id = LAST_INSERT_ID();');
        mysqli_query($this->connection, 'INSERT INTO personal_info (first_name, last_name, birthday, sex, home_address, home_town, highschool, education_status, website, looking_for, interested_in, relationship_status, political_views, interests, favorite_music, favorite_movies, about_me) VALUES (' . $this->Nullable($personal_info['first-name']) . ',' . $this->Nullable($personal_info['last-name']) . ',' . $this->Nullable($personal_info['birthday']) . ',' . $this->Nullable($personal_info['sex']) . ',' . $this->Nullable($personal_info['home-address']) . ',' . $this->Nullable($personal_info['home-town']) . ',' . $this->Nullable($personal_info['highschool']) . ',' . $this->Nullable($account_info['status']) . ',' . $this->Nullable($personal_info['website']) . ',' . $this->Nullable($personal_info['looking-for']) . ',' . $this->Nullable($personal_info['interested-in']) . ',' . $this->Nullable($personal_info['relationship-status']) . ',' . $this->Nullable($personal_info['political-views']) . ',' . $this->Nullable($personal_info['interests']) . ',' . $this->Nullable($personal_info['favorite-music']) . ',' . $this->Nullable($personal_info['favorite-movies']) . ',' . $this->Nullable($personal_info['about-me']) . ');');
        mysqli_query($this->connection, 'SET @last_personal_info_id = LAST_INSERT_ID();');
        mysqli_query($this->connection, 'INSERT INTO account_info (settings_id, account_stats_id, social_stats_id, personal_info_id, username, email, password, mobile, full_name, password_salt) VALUES (@last_settings_id, @last_account_stats_id, @last_social_stats_id, @last_personal_info_id, ' . $this->Nullable($account_info['username']) . ', ' . $this->Nullable($account_info['email']) . ', ' . $this->Nullable($account_info['password']) . ', ' . $this->Nullable($personal_info['mobile']) . ', ' . $full_name . ', ' . $this->Nullable($account_info['salt']) . ');');
    }
    public function GetTableFieldData($attribute, $table) {
        $result = mysqli_query($this->connection, 'SELECT ' . $attribute . ' FROM ' . $table);
        $values = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $values[] = $row[$attribute];
        }
        return $values;
    }
    public function JsonValuesQuery($table, $selector, $value) {        
        return "SELECT pi.* FROM " . $table . " AS pi
        JOIN account_info AS ai ON pi." . $this->_tables->GetID($table) . " = ai." . $this->_tables->GetID($table) . "
        WHERE ai." . $selector . " = '" . $value . "';";
    }
    public function RelationalValuesQuery($value, $table, $selector, $selector_value) {
        // return 'SELECT pi.' . $value . '
        // FROM personal_info pi
        // JOIN account_info ai ON pi.personal_info_id = ai.personal_info_id
        // WHERE ai.username = 'kadia64';'
        $id = $this->_tables->GetID($table);
        return " SELECT selector." . $value . "
        FROM " . $table . " selector
        JOIN account_info ai ON selector." . $id . " = ai." . $id . "
        WHERE ai." . $selector . " = '" . $selector_value . "';";
        
    }
    public function GetDataByUsername($table, $username, $assoc = false) {
        $query = $this->JsonValuesQuery($table, 'username', $username);
        $result = mysqli_query($this->connection, $query);
        $data = mysqli_fetch_assoc($result);
        return json_decode(json_encode($data), $assoc);
    }
    public function GetDataByEmail($table, $email, $assoc = false) {
        $query = $this->JsonValuesQuery($table, 'email', $email);
        $result = mysqli_query($this->connection, $query);
        $data = mysqli_fetch_assoc($result);
        return json_decode(json_encode($data), $assoc);
    }
    public function GetEmailByUsername($username) {        
        $result = mysqli_query($this->connection, "SELECT email FROM account_info WHERE username = '" . $username . "'");
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row['email'];
        } else return null;
    }
    public function GetUsernameByEmail($email) {
        $result = mysqli_query($this->connection, "SELECT username FROM account_info WHERE email = '" . $email . "'");
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row['username'];
        } else return null;        
    }
    public function GetValueByUsername($value, $table, $username) {
        $result = mysqli_query($this->connection, $this->RelationalValuesQuery($value, $table, 'username', $username));
        $row = mysqli_fetch_assoc($result);
        return $row[$value];
    }
    public function GetValueByEmail($value, $table, $email) {
        $result = mysqli_query($this->connection, $this->RelationalValuesQuery($value, $table, 'email', $email));
        $row = mysqli_fetch_assoc($result);
        return $row[$value];
    }
    public function Nullable($val) {
        if ($val == '') {
            return 'NULL';
        } else {
            return '\'' . mysqli_real_escape_string($this->connection, $val) . '\'';
        }
    }
}
class SQLTables {
    public function GetID($table) {
        if ($table == 'account_info') {
            return 'account_id';
        } else if ($table == 'account_settings') {
            return 'settings_id';
        } else if ($table == 'account_stats') {
            return 'account_stats_id';
        } else if ($table == 'personal_info') {
            return 'personal_info_id';
        } else if ($table == 'social_stats') {
            return 'social_stats_id';
        }
    }
}
?>