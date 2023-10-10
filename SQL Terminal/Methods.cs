using System;
using System.Collections.Generic;
using System.Data;
using System.Diagnostics.Metrics;
using System.Linq;
using System.Net;
using System.Numerics;
using System.Runtime.InteropServices;
using System.Security.Claims;
using System.Security.Policy;
using System.Text;
using System.Threading.Tasks;
using Google.Protobuf.WellKnownTypes;
using MySql.Data.MySqlClient;
using MySqlX.XDevAPI.Relational;
using Newtonsoft;
using Newtonsoft.Json;
using System.Security.Cryptography;
using Newtonsoft.Json.Linq;
using Org.BouncyCastle.Crypto;
using Org.BouncyCastle.Crypto.Macs;
using static System.Net.Mime.MediaTypeNames;
using static System.Runtime.InteropServices.JavaScript.JSType;

namespace SQL_Terminal {
    public class Methods {
        
        public void PrintCursor(ConsoleColor color = ConsoleColor.White) {
            Console.ForegroundColor = color;
            Console.Write("> ");
            Console.ResetColor();
        }
        public void CommandOutput(string text, bool print = false, ConsoleColor color = ConsoleColor.White, bool extra_lines = true) {
            if (print) {
                Console.ForegroundColor = color;
                if (extra_lines) Console.WriteLine();                    
                this.Print(text);
                Console.ResetColor();
                if (extra_lines) Console.WriteLine("\n");
            } else {
                if (extra_lines) Console.WriteLine();                
                Console.Write(text);
                if (extra_lines) Console.WriteLine("\n");                
            }
        }
        public void HelpOutput(string description, string[] flags, string[]? alias = null, string[]? parameters = null) {
            Console.WriteLine();
            
            Console.ForegroundColor = ConsoleColor.Yellow;
            Console.WriteLine(description);
            Console.ForegroundColor = ConsoleColor.Cyan;

            Console.WriteLine("\nFlags:");
            Console.ResetColor();
            for (int i = 0; i < flags.Length; ++i) {
                Console.WriteLine($" {flags[i]}");
                Thread.Sleep(10);
            }

            Console.ForegroundColor = ConsoleColor.Cyan;
            Console.WriteLine("\nAlias:");
            Console.ResetColor();
            if (alias != null) {
                for (int i = 0; i < alias.Length; ++i) {
                    Console.WriteLine($" -- {alias[i]}");
                    Thread.Sleep(10);
                }
            } else {
                Console.ForegroundColor = ConsoleColor.DarkGray;
                Console.WriteLine(" --none");
                Console.ResetColor();
            }

            Console.ForegroundColor = ConsoleColor.Cyan;
            Console.WriteLine($"\nParameters:");
            Console.ResetColor();
            if (parameters != null) {
                for (int i = 0; i < parameters.Length; ++i) {
                    Console.WriteLine($"-- {parameters[i]}");
                    Thread.Sleep(10);
                }
            } else {
                Console.ForegroundColor = ConsoleColor.DarkGray;
                Console.WriteLine(" --none");
                Console.ResetColor();
            }

            Console.WriteLine();
        }
        public void SuccessOutput(string input, bool print = false) {
            Console.WriteLine();
            Console.ForegroundColor = ConsoleColor.Green;

            Console.WriteLine();
        }
        public void ErrorOutput(string input, bool print = false) {
            Console.WriteLine();
            Console.ForegroundColor = ConsoleColor.Red;
            if (print) {
                this.Print(input);
            } else {
                Console.WriteLine(input);
            }
            Console.ResetColor();
            Console.WriteLine("\n");
        }
        public bool Hault(string text, ConsoleColor color = ConsoleColor.White) {
            bool read = true;
            while (true) {
                Console.ForegroundColor = color;                
                if (read) this.Print("\n" + text + "\n");
                read = false;
                Console.Write("   [y/n]\n\n");
                Console.ResetColor();
                Console.Write("> ");
                string input = Console.ReadLine();
                
                if (input == "y" || input == "Y") {
                    return true;
                } else if (input == "n" || input == "N") {
                    return false;
                } else {
                    Console.WriteLine("\nTry Again\n");
                }                
            }
        }
        public List<string> ValueOutput(string[] parameters) {
            List<string> values = new List<string>();            
            for (int i = 0; i < parameters.Length; ++i) {
                Console.ForegroundColor = ConsoleColor.Yellow;
                Console.Write($"  {parameters[i]}: ");

                Console.ResetColor();
                string input = Console.ReadLine();
                values.Add(input);
            }
            return values;
        }
        public void Print(string text, int speed = 10) {
            foreach (char c in text) {
                Console.Write(c);
                Thread.Sleep(speed);
            }
        }
        public int R(int min, int max) {
            Random random = new Random();
            return random.Next(min, max);
        }
        public string RandCharacters(int length) {
            return new string(Enumerable.Repeat("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", length).Select(s => s[new Random().Next(s.Length)]).ToArray());            
        }
        public string sha256(string input) {
            byte[] data = Encoding.UTF8.GetBytes(input);

            using (SHA256 sha256 = SHA256.Create()) {
                byte[] hashBytes = sha256.ComputeHash(data);
                string hashString = BitConverter.ToString(hashBytes).Replace("-", "").ToLower();
                return hashString;
            }
        }
        public string GetFilePath(string filePath) {
            string projectDirectory = Directory.GetCurrentDirectory();
            for (int i = 0; i < 3; ++i) projectDirectory = Directory.GetParent(projectDirectory).FullName;
            return Path.Combine(projectDirectory, filePath);
        }
    }
#pragma warning disable CS8602 // Dereference of a possibly null reference.
    public class SQL {
        public MySqlConnection Connection;
        public string IP_Address;
        public int Port;
        public string Database;
        public string Username;
        public string Password;
        public string[] AccountInfo = { "username", "email", "password", "mobile", "first_name", "last_name", "password_salt" };
        public string[] AccountSettings = { "allow_mentions", "activity_status", "suggest_account" };
        public string[] AccountStats = { "login_count", "logout_count", "last_login_timestamp", "last_logout_timestamp", "password_attempts", "last_password_attempt_timestamp", "password_change_count", "last_password_change_timestamp", "member_since", "member_since_time", "last_update", "last_update_time" };
        public string[] PersonalInfo = { "first_name", "last_name", "birthday", "sex", "home_address", "home_town", "highschool", "education_status", "website", "looking_for", "interested_in", "relationship_status", "political_views", "interests", "favorite_music", "favorite_movies", "about_me" };
        public string[] SocialStats = { "friend_count", "friend_email_list", "blocked_count", "blocked_username_list", "reported_count", "message_all_count", "unread_message_count", "message_sent_count", "message_received_count", "verification_request_count", "verification_request_last_timestamp" };
        private Methods methods;
        public SQL() {
            this.methods = new Methods();
            var jo = JObject.Parse(File.ReadAllText(methods.GetFilePath("config.json")));
            this.IP_Address = jo["Database-Credentials"]["IP-Address"].ToString();
            this.Port = Convert.ToInt32(jo["Database-Credentials"]["Port"]);
            this.Database = jo["Database-Credentials"]["Database"].ToString();
            this.Username = jo["Database-Credentials"]["Username"].ToString();
            this.Password = jo["Database-Credentials"]["Password"].ToString();
        }
        public void Connect() {
            string connectionString = $"Server={this.IP_Address};Database={this.Database};Uid={this.Username};Pwd={this.Password}";
            this.Connection = new MySqlConnection(connectionString);
            this.Connection.Open();
        }
        public void CloseConnection() {
            this.Connection.Close();
        }
        public bool CheckConnection() {
            if (this.Connection.State == System.Data.ConnectionState.Open) {
                return true;
            } else return false;                
        }
        public string Query(string query_string) {
            try {
                using (MySqlCommand command = new MySqlCommand(query_string, this.Connection)) {
                    command.ExecuteNonQuery();
                }
            } catch (Exception e) {
                return e.Message;
            }
            return "";
        }
        public void ClearDatabase() {
            List<string> tableNames = new List<string>();
            using (DataTable dt = this.Connection.GetSchema("Tables")) {
                foreach (DataRow row in dt.Rows) {
                    string tableName = row["TABLE_NAME"].ToString();
                    tableNames.Add(tableName);
                }
            }
            foreach (string tableName in tableNames) {
                string dropTable = $"DROP TABLE {tableName}";
                this.Query(dropTable);
            }
        }        

        public void CreateDefaultStructure() {
            string output = this.Query(@"
                CREATE TABLE session_data (
                    session_data_id INT PRIMARY KEY,
                    session_id VARCHAR(512),
                    logged_in TIMESTAMP
                );
                CREATE TABLE account_settings (
  	                settings_id INT PRIMARY KEY AUTO_INCREMENT,
  	                allow_mentions VARCHAR(255),
  	                activity_status BOOLEAN,
  	                suggest_account BOOLEAN
                );
                CREATE TABLE account_stats (
                    account_stats_id INT PRIMARY KEY AUTO_INCREMENT,
                    login_count INT UNSIGNED,
                    logout_count INT UNSIGNED,
                    last_login_timestamp VARCHAR(32),
                    last_logout_timestamp VARCHAR(32),
                    password_attempts INT UNSIGNED,
                    last_password_attempt_timestamp VARCHAR(32),
                    password_change_count INT UNSIGNED,
                    last_password_changed_timestamp VARCHAR(32),
                    member_since VARCHAR(32),
                    last_update VARCHAR(32)
                );
                CREATE TABLE social_stats (
                    social_stats_id INT PRIMARY KEY AUTO_INCREMENT,
                    friend_count INT UNSIGNED,
                    friend_email_list VARCHAR(512),
                    blocked_count INT UNSIGNED,
                    blocked_username_list VARCHAR(512),
                    reported_count INT UNSIGNED,
                    message_all_count INT UNSIGNED,
                    unread_message_count INT UNSIGNED,
                    message_sent_count INT UNSIGNED, 
                    message_received_count INT UNSIGNED, 
                    verification_request_count INT UNSIGNED,
                    verification_request_last_timestamp VARCHAR(32)
                );
                CREATE TABLE personal_info (
                    personal_info_id INT PRIMARY KEY AUTO_INCREMENT,
                    birthday VARCHAR(32),
                    sex VARCHAR(32),
                    home_address VARCHAR(128),
                    home_town VARCHAR(128),
                    highschool VARCHAR(128),
                    education_status VARCHAR(32),
                    website VARCHAR(128),
                    looking_for VARCHAR(32),
                    interested_in VARCHAR(32),
                    relationship_status VARCHAR(32),
                    political_views VARCHAR(128),
                    interests VARCHAR(128),
                    favorite_music TEXT,
                    favorite_movies TEXT,
                    about_me TEXT
                );
                CREATE TABLE account_info (
                    account_id INT PRIMARY KEY AUTO_INCREMENT,
                    settings_id INT,
                    account_stats_id INT, 
                    social_stats_id INT,
                    personal_info_id INT,
                    username VARCHAR(128),
                    email VARCHAR(128),
                    password VARCHAR(128),
                    password_salt VARCHAR(32),
                    mobile VARCHAR(128),
                    first_name VARCHAR(128),
                    last_name VARCHAR(128),
                    full_name VARCHAR(255),
                    profile_image LONGBLOB,
                    CONSTRAINT account_settings_fk FOREIGN KEY (settings_id) 
                   		REFERENCES account_settings (settings_id),
                    CONSTRAINT account_stats_fk FOREIGN KEY (account_stats_id)
                    	REFERENCES account_stats (account_stats_id),
                    CONSTRAINT social_stats_fk FOREIGN KEY (social_stats_id)
                        REFERENCES social_stats (social_stats_id),
                    CONSTRAINT personal_info_fk FOREIGN KEY (personal_info_id)
                    	REFERENCES personal_info (personal_info_id)
                );
            ");
        }
        public void TruncateAllRelationalTables() {
            this.Query(@"
                ALTER TABLE account_info DROP FOREIGN KEY account_settings_fk;
                ALTER TABLE account_info DROP FOREIGN KEY account_stats_fk;
                ALTER TABLE account_info DROP FOREIGN KEY social_stats_fk;
                ALTER TABLE account_info DROP FOREIGN KEY personal_info_fk;
                TRUNCATE TABLE session_data;
                TRUNCATE TABLE account_settings;
                TRUNCATE TABLE account_stats;
                TRUNCATE TABLE social_stats;
                TRUNCATE TABLE personal_info;
                TRUNCATE TABLE account_info;
                ALTER TABLE account_info ADD CONSTRAINT account_settings_fk FOREIGN KEY (settings_id) REFERENCES account_settings(settings_id);
                ALTER TABLE account_info ADD CONSTRAINT account_stats_fk FOREIGN KEY (account_stats_id) REFERENCES account_stats(account_stats_id);
                ALTER TABLE account_info ADD CONSTRAINT social_stats_fk FOREIGN KEY (social_stats_id) REFERENCES social_stats(social_stats_id);
                ALTER TABLE account_info ADD CONSTRAINT personal_info_fk FOREIGN KEY (personal_info_id) REFERENCES personal_info(personal_info_id);
            ");
        }
        public void CreateRandomAccount(int amount) {
            string[] domainNames = { "@example.com","@email.net","@gmail.com","@rocket.org","@emailbox.com","@example.net","@emailpros.com","@emailworld.net","@example.org","@emailzone.com","@emailhub.net","@emailspot.org","@examplemail.com","@emailplanet.net","@exampleplace.com","@emailville.org","@emailglobe.com","@exampleuniverse.net","@emailcountry.com","@emailocean.org","@emaildomain.net","@emailcity.com","@emailwave.com","@emailland.org","@emailplanet.com","@emailworld.org","@emailheaven.com","@emailforest.net","@emailpeak.com","@emailvalley.org" };
            List<string> emails = new List<string>();
            for (int i = 0; i < domainNames.Length; ++i) {
                emails.Add(methods.RandCharacters(4) + domainNames[i]);
            }
            string[] usernames = { "Banana","Sunshine","Elephant","Adventure","Mystery","Serendipity","Chocolate","Universe","Harmony","Blossom","Whisper","Radiant","Symphony","Firefly","Tranquil","Wanderlust","Lighthouse","Butterfly","Aurora","Waterfall","Enchanted","Sapphire","Velvet","Tornado","Twilight","Euphoria","Infinity","Rainbow","Stardust","Mirage" };
            string[] first_names = { "Emerson", "Ryan", "Marlee", "Kameron", "Malaya", "Thaddeus", "Marlowe", "Ira", "Mira", "Zyaire", "Savanna", "Lorenzo", "Ivory", "Johnathan", "Journee", "Lee", "Rosemary", "Jamari", "Giselle", "Deacon", "Ana", "Armani", "Aileen", "Calum", "Harmoni", "Jakob","Faye", "Jeremy", "Lena", "Jaime" };
            string[] last_names = { "Cruz","Trevino","Huber","Sims","Carpenter","Arellano","McMahon","Tanner","Finley","Ponce","Terry","Harper","Gibbs","Byrd","Valenzuela","Reese","Lester","Vazquez","Cardenas","Collier","Webb","Roy","Blake","Wise","Chung","Horne","Palacios","Hensley","Fowler","Fitzgerald" };


            for (int i = 0; i < amount; ++i) {
                string username = usernames[methods.R(0, usernames.Length - 1)] + methods.RandCharacters(3);
                string email = emails[methods.R(0, emails.Count - 1)];
                string password_salt = methods.RandCharacters(32);
                string password = methods.sha256("asd" + password_salt);
                string mobile = $"{methods.R(100, 999)}-{methods.R(100, 999)}-{methods.R(1000, 9999)}";
                int randNameIndex = methods.R(0, first_names.Length - 1);
                string first_name = first_names[randNameIndex];
                string last_name = last_names[randNameIndex];
                string full_name = $"{first_name} {last_name}";

                string query = $@"
                    INSERT INTO account_settings (allow_mentions, activity_status, suggest_account) VALUES (NULL, NULL, NULL);
                    SET @last_settings_id = LAST_INSERT_ID();
                    INSERT INTO account_stats (login_count, logout_count, last_login_timestamp, last_logout_timestamp, password_attempts, last_password_attempt_timestamp, password_change_count, last_password_changed_timestamp, member_since, last_update) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                    SET @last_account_stats_id = LAST_INSERT_ID();
                    INSERT INTO social_stats (friend_count, friend_email_list, blocked_count, blocked_username_list, reported_count, message_all_count, unread_message_count, message_sent_count, message_received_count, verification_request_count, verification_request_last_timestamp) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                    SET @last_social_stats_id = LAST_INSERT_ID();
                    INSERT INTO personal_info (birthday, sex, home_address, home_town, highschool, education_status, website, looking_for, interested_in, relationship_status, political_views, interests, favorite_music, favorite_movies, about_me) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                    SET @last_personal_info_id = LAST_INSERT_ID();
                    INSERT INTO account_info (settings_id, account_stats_id, social_stats_id, personal_info_id, username, email, password, password_salt, mobile, first_name, last_name, full_name, profile_image) VALUES (@last_settings_id, @last_account_stats_id, @last_social_stats_id, @last_personal_info_id, '{username}', '{email}', '{password}', '{password_salt}', '{mobile}', '{first_name}', '{last_name}', '{full_name}', NULL);
                ";
                MySqlCommand command = new MySqlCommand(query, this.Connection);
                command.Parameters.Add("@last_settings_id", MySqlDbType.Int32).Direction = ParameterDirection.Output;
                command.Parameters.Add("@last_account_stats_id", MySqlDbType.Int32).Direction = ParameterDirection.Output;
                command.Parameters.Add("@last_social_stats_id", MySqlDbType.Int32).Direction = ParameterDirection.Output;
                command.Parameters.Add("@last_personal_info_id", MySqlDbType.Int32).Direction = ParameterDirection.Output;
                command.ExecuteNonQuery();
            }
        }
        public void CreateNullUserAccount() {
            string query = $@"
                INSERT INTO account_settings (allow_mentions, activity_status, suggest_account) VALUES (NULL, NULL, NULL);
                SET @last_settings_id = LAST_INSERT_ID();
                INSERT INTO account_stats (login_count, logout_count, last_login_timestamp, last_logout_timestamp, password_attempts, last_password_attempt_timestamp, password_change_count, last_password_changed_timestamp, member_since, last_update) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                SET @last_account_stats_id = LAST_INSERT_ID();
                INSERT INTO social_stats (friend_count, friend_email_list, blocked_count, blocked_username_list, reported_count, message_all_count, unread_message_count, message_sent_count, message_received_count, verification_request_count, verification_request_last_timestamp) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                SET @last_social_stats_id = LAST_INSERT_ID();
                INSERT INTO personal_info (birthday, sex, home_address, home_town, highschool, education_status, website, looking_for, interested_in, relationship_status, political_views, interests, favorite_music, favorite_movies, about_me) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                SET @last_personal_info_id = LAST_INSERT_ID();
                INSERT INTO account_info (settings_id, account_stats_id, social_stats_id, personal_info_id, username, email, password, password_salt, mobile, first_name, last_name, full_name, profile_image) VALUES (@last_settings_id, @last_account_stats_id, @last_social_stats_id, @last_personal_info_id, '{methods.RandCharacters(6)}', '{methods.RandCharacters(6) + "@icloud.com"}', '123', NULL, NULL, NULL, NULL, NULL, NULL);
            ";
            MySqlCommand command = new MySqlCommand(query, this.Connection);
            command.Parameters.Add("@last_settings_id", MySqlDbType.Int32).Direction = ParameterDirection.Output;
            command.Parameters.Add("@last_account_stats_id", MySqlDbType.Int32).Direction = ParameterDirection.Output;
            command.Parameters.Add("@last_social_stats_id", MySqlDbType.Int32).Direction = ParameterDirection.Output;
            command.Parameters.Add("@last_personal_info_id", MySqlDbType.Int32).Direction = ParameterDirection.Output;
            command.ExecuteNonQuery();
        }
    }
#pragma warning restore CS8602 // Dereference of a possibly null reference.
}
