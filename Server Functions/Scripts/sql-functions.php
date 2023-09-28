<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
class SQLHandle {    
    public $Server;
    public $Database;
    public $Username;
    public $Password;
    public $connection;
    private $files;
    private $dh;
    public function __construct() {
        $this->files = new FileHandle();
        $this->dh = new DataHandle();
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
        mysqli_query($this->connection, 'INSERT INTO account_settings (allow_mentions, activity_status, suggest_account) VALUES (\'People You Follow\', true, true)');
        mysqli_query($this->connection, 'SET @last_settings_id = LAST_INSERT_ID();');
        mysqli_query($this->connection, 'INSERT INTO account_stats (login_count, logout_count, last_login_timestamp, last_logout_timestamp, password_attempts, last_password_attempt_timestamp, password_change_count, last_password_changed_timestamp, member_since, member_since_time, last_update, last_update_time) VALUES (0, 0, NULL, NULL, 0, NULL, 0, NULL, \'' . $this->dh->GetTimeStamp(0) . '\', \'' . $this->dh->GetTimeStamp(2) . '\', \'' . $this->dh->GetTimeStamp(0) . '\', \'' . $this->dh->GetTimeStamp(2) . '\');');
        mysqli_query($this->connection, 'SET @last_account_stats_id = LAST_INSERT_ID();');
        mysqli_query($this->connection, 'INSERT INTO social_stats (friend_count, friend_email_list, blocked_count, blocked_username_list, reported_count, message_all_count, unread_message_count, message_sent_count, message_received_count, verification_request_count, verification_request_last_timestamp) VALUES (0, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, NULL);');
        mysqli_query($this->connection, 'SET @last_social_stats_id = LAST_INSERT_ID();');
        mysqli_query($this->connection, 'INSERT INTO personal_info (first_name, last_name, birthday, sex, home_address, home_town, highschool, education_status, website, looking_for, interested_in, relationship_status, political_views, interests, favorite_music, favorite_movies, about_me) VALUES (' . $this->Nullable($personal_info['first-name']) . ',' . $this->Nullable($personal_info['last-name']) . ',' . $this->Nullable($personal_info['birthday']) . ',' . $this->Nullable($personal_info['sex']) . ',' . $this->Nullable($personal_info['home-address']) . ',' . $this->Nullable($personal_info['home-town']) . ',' . $this->Nullable($personal_info['highschool']) . ',' . $this->Nullable($account_info['status']) . ',' . $this->Nullable($personal_info['website']) . ',' . $this->Nullable($personal_info['looking-for']) . ',' . $this->Nullable($personal_info['interested-in']) . ',' . $this->Nullable($personal_info['relationship-status']) . ',' . $this->Nullable($personal_info['political-views']) . ',' . $this->Nullable($personal_info['interests']) . ',' . $this->Nullable($personal_info['favorite-music']) . ',' . $this->Nullable($personal_info['favorite-movies']) . ',' . $this->Nullable($personal_info['about-me']) . ');');
        mysqli_query($this->connection, 'SET @last_personal_info_id = LAST_INSERT_ID();');
        mysqli_query($this->connection, 'INSERT INTO account_info (settings_id, account_stats_id, social_stats_id, personal_info_id, username, email, password, mobile, full_name) VALUES (@last_settings_id, @last_account_stats_id, @last_social_stats_id, @last_personal_info_id, ' . $this->Nullable($account_info['username']) . ', ' . $this->Nullable($account_info['email']) . ', ' . $this->Nullable($account_info['password']) . ', ' . $this->Nullable($personal_info['mobile']) . ', ' . $this->Nullable($personal_info['first-name']) . ' ' .  $this->Nullable($personal_info['last-name']) . ');');
    }
    public function GetTableData($attribute, $table) {
        $result = mysqli_query($this->connection, 'SELECT ' . $attribute . ' FROM ' . $table);
        $values = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $values[] = $row[$attribute];
        }
        return $values;
    }    
    public function Nullable($val) {
        if ($val == '') {
            return 'NULL';
        } else {
            return '\'' . $val . '\'';
        }
    }
}
?>