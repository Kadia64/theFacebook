using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SQL_Terminal {
#pragma warning disable CS8602 // Dereference of a possibly null reference.
    public class Run {

        private string[] CommandList = {
            "commands", "list commands", "cls",
            "connect", "con", "disconnect"
        };
        private bool Connected = false;
        private string? CurrentCommand = null;
        private string? CommandInput = null;
        private bool Help = false;
        private const string HELP_INFO = "-h ~ help mode, will give a description of the command.";
        private const string SKIP_INFO = "-f ~ will execute the command without a prompt.";

        public void MainLoop() {
            Methods methods = new Methods();
            SQL sql = new SQL("10.0.0.139", 3306, "thefacebook", "terminal", "");
            bool running = true;
            bool skip = false;
            string[] inputTokens = new string[] { };
            ConsoleColor color = ConsoleColor.White;

            while (running) {
                methods.PrintCursor();
                string cmd = Console.ReadLine();
                bool pass = false;                
                if (this.CheckCommand(cmd)) pass = true;
                
                try {
                    inputTokens = this.CommandInput.Split(' ');
                    if (inputTokens.Contains("-f")) skip = true;
                    if (inputTokens.Contains("-h")) this.Help = true;
                } catch { pass = false; }
                if (!pass) methods.ErrorOutput("Unexpected Error", true);
                
                switch (this.CurrentCommand) {
                    case "connect":                        
                    case "con":
                        if (this.Help) {
                            methods.HelpOutput("Connects the user to the database, the configuration will be in the config.json file.\nYou must restart the terminal for changes to apply.", new string[] { HELP_INFO, SKIP_INFO }, new string[] { "connect", "con" });
                            break;
                        }
                        try {
                            sql.Connect();
                            methods.CommandOutput($"Connected to the SQL database '{sql.Database}' on {sql.IP_Address}:{sql.Port} - {DateTime.Now.ToString("M/d/yy h:mm tt")}", true, ConsoleColor.Cyan);
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
                                methods.CommandOutput($"Disconnected from the SQL database - {sql.IP_Address}:{sql.Port}");
                                this.Connected = false;
                            }
                        } else {
                            methods.ErrorOutput("You are currently not connected to a SQL database!", true);
                        }
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
        }
        
    }
#pragma warning restore CS8602 // Dereference of a possibly null reference.
}
