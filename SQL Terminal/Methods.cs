using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

namespace SQL_Terminal {
    public class Methods {

        
    }
    public class SQL {
        public MySqlConnection Connection;
        public string IP_Address;
        public int Port;
        public string Database;
        public string Username;
        public string Password;

        public SQL(string ip_address, int port, string database, string username, string password) {
            this.IP_Address = ip_address;
            this.Port = port;
            this.Database = database;
            this.Username = username;
            this.Password = password;   
        }
        public void Connect() {
            string connectionString = $"Server={this.IP_Address};Database={this.Database};Uid={this.Username};Pwd={this.Password}";
            this.Connection = new MySqlConnection(connectionString);
            this.Connection.Open();

        }
    }
}
