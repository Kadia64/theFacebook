using System;
using MySql.Data.MySqlClient;

namespace SQL_Terminal {
    public class Program {
        static void Main(string[] args) {
            SQL sql = new SQL("10.0.0.139", 3306, "thefacebook", "terminal", "");
            sql.Connect();

            Console.WriteLine("You have successfully connected");

        }
    }
}