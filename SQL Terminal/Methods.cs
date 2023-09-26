using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

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
        public void HelpOutput(string description, string[] flags, string[]? alias = null, string? parameter_example = null, string[]? parameters = null) {
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
            Console.WriteLine($"\nParameters: {parameter_example}");
            Console.ResetColor();
            if (parameters != null) {
                for (int i = 0; i < parameters.Length; ++i) {
                    Console.WriteLine(parameters[i]);
                    Thread.Sleep(10);
                }
            } else {
                Console.ForegroundColor = ConsoleColor.DarkGray;
                Console.WriteLine(" --none");
                Console.ResetColor();
            }

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
        public void Print(string text, int speed = 10) {
            foreach (char c in text) {
                Console.Write(c);
                Thread.Sleep(speed);
            }
        }
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
        public void CloseConnection() {
            this.Connection.Close();
        }
        public bool CheckConnection() {
            if (this.Connection.State == System.Data.ConnectionState.Open) {
                return true;
            } else return false;                
        }
    }
}
