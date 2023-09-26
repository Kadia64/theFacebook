using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SQL_Terminal {
#pragma warning disable CS8602 // Dereference of a possibly null reference.
    public class Run {

        private string[] CommandList = {
            "commands", "list commands", "cmds", "clear", "cls", "exit",
            "connect", "con", "disconnect",
            "cleardb", "clear databases", "remove tables", "delete tables",
            "create default",
        };
        private bool Connected = false;
        private string? CurrentCommand = null;
        private string? CommandInput = null;
        private bool Help = false;
        private bool Skip = false;
        private const string HELP_INFO = "-h ~ help mode, will give a description of the command.";
        private const string SKIP_INFO = "-f ~ will execute the command without a prompt.";

        public void MainLoop() {
            Methods methods = new Methods();
            SQL sql = new SQL("10.0.0.139", 3306, "thefacebook", "terminal", "");
            bool running = true;
            string[] inputTokens = new string[] { };
            ConsoleColor color = ConsoleColor.White;

            while (running) {
                if (!Connected) {
                    methods.PrintCursor(ConsoleColor.Red);
                } else {
                    methods.PrintCursor(ConsoleColor.Blue);
                }
                string cmd = Console.ReadLine();
                bool pass = false;                
                if (this.CheckCommand(cmd)) pass = true;
                
                try {
                    inputTokens = this.CommandInput.Split(' ');
                    if (inputTokens.Contains("-f")) this.Skip = true;
                    if (inputTokens.Contains("-h")) this.Help = true;
                } catch { pass = false; }
                if (!pass) methods.ErrorOutput("Unexpected Error", true);

                bool execute = false;
                switch (this.CurrentCommand) {
                    case "clear":
                    case "cls":
                        if (this.Help) {
                            methods.HelpOutput("Clears the screen of the console.", new string[] { HELP_INFO }, new string[] { "clear", "cls" });
                            break;
                        }
                        Console.Clear();
                        break;
                    case "exit":
                        if (this.Help) {
                            methods.HelpOutput("Exists the console program.", new string[] { HELP_INFO }, new string[] { "exit" });
                            break;
                        }
                        Environment.Exit(0);
                        break;
                    case "list commands":
                    case "cmds":
                        if (this.Help) {
                            methods.HelpOutput("Will give a list of each command displayed to the console", new string[] { HELP_INFO }, new string[] { "list commands", "cmds" });
                            break;
                        }
                        Console.WriteLine();
                        for (int i = 0; i < this.CommandList.Length; ++i) {
                            Console.WriteLine(CommandList[i]);
                            Thread.Sleep(10);
                        }
                        Console.WriteLine();
                        break;
                    case "connect":
                    case "con":                        
                        if (this.Help) {
                            methods.HelpOutput("Connects the user to the database, the configuration will be in the config.json file.\nYou must restart the terminal for changes to apply.", new string[] { HELP_INFO, SKIP_INFO }, new string[] { "connect", "con" });
                            break;
                        }
                        try {
                            sql.Connect();                            
                            if (!this.Skip) methods.CommandOutput($"Connected to the SQL database '{sql.Database}' on {sql.IP_Address}:{sql.Port} - {DateTime.Now.ToString("M/d/yy h:mm tt")}", true, ConsoleColor.Cyan);
                            this.Connected = true;
                        } catch (Exception e) {
                            methods.CommandOutput($"Connection Failed: {e.Message}");
                        }
                        break;
                    case "disconnect":
                        if (this.Help) {
                            methods.HelpOutput("Disconnects the user from the database", new string[] { HELP_INFO, SKIP_INFO }, new string[] { "disconnect" });
                            break;
                        }
                        if (this.Connected) {
                            sql.CloseConnection();
                            if (!sql.CheckConnection()) {
                                if (!this.Skip) methods.CommandOutput($"Disconnected from the SQL database - {sql.IP_Address}:{sql.Port}");
                                this.Connected = false;
                            }
                        } else {
                            methods.ErrorOutput("You are currently not connected to a SQL database!", true);
                        }
                        break;
                    case "cleardb":
                    case "clear databases":
                    case "remove tables":
                    case "delete tables":
                        if (this.Help) {
                            methods.HelpOutput("This will delete all of your tables from your database, and all of their data.", new string[] { HELP_INFO, SKIP_INFO }, new string[] { "cleardb", "clear databases", "remove tables", "delete tables" });
                            break;
                        }                        
                        if (!this.Skip) {
                            if (this.Connected) {
                                if (methods.Hault("Are you sure your would like to delete all tables within your database?", ConsoleColor.Red)) execute = true;
                            } else methods.ErrorOutput("You are not connected to the database!");
                        }
                        if (execute || this.Skip) sql.ClearDatabase();
                        break;
                    case "create default":
                        if (this.Help) {
                            methods.HelpOutput("Will create a default structure for your database, and it will include the related tables.\nThis will delete all existing data fields from your database?", new string[] { HELP_INFO, SKIP_INFO }, new string[] { "create default" });
                            break;
                        }
                        if (!this.Skip) {
                            if (this.Connected) {
                                if (methods.Hault("Are you sure you want to create a new database structure? It will delete all existing data in the database.", ConsoleColor.Red)) execute = true;                                
                            } else methods.ErrorOutput("You are not connected to the database!");
                        }
                        if (execute || this.Skip) sql.CreateDefaultStructure();
                        break;
                }
                this.Reset();
            }
        }
        private bool CheckCommand(string input) {
            foreach (string command in this.CommandList) {
                if (input.Equals(command)) {
                    this.CurrentCommand = command;
                    this.CommandInput = string.Empty;
                    return true;
                } else if (input.StartsWith(command + " ")) {
                    this.CurrentCommand = command;
                    this.CommandInput = input.Substring(command.Length + 1);
                    return true;
                }
            }
            return false;
        }
        private void Reset() {
            this.CommandInput = null;
            this.CurrentCommand = null;
            this.Help = false;
            this.Skip = false;
        }
        
    }
#pragma warning restore CS8602 // Dereference of a possibly null reference.
}
