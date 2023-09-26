# theFacebook
A simple facebook clone with some basic website functionalities from the early 2000s. This clone is based off of Mark Zuckerberg's first launch of Facebook when he was in college.

# Project
I currently have this file in a XAMPP workspace, and uses phpMyAdmin for the MySQL database. When cloning this repositoy, you need to move the folder to a XAMPP 'htdocs' location in order for the website to run. For development, I have a seperate server in my local network hosting my XAMPP files that is shared to the computer I will be developing on. I'm not entirely sure on which configuration you need to change in order for your server to broadcast your website to your local network. You will either need to edit: 'httpd.conf', or 'httpd-xampp.conf', and you need to look for a XML setting that says: '<Directory "xampp_path/htdocs">', and add this line: 'Require all granted'. This should allow you to access your website from any device in your local network. You need to type in the IP address of your server into your URL, and you should be greeted with the XAMPP dashboard page.

When committing changes, I open my workspace of my project only (not the entire 'htdocs' folder, you must open your cloned repository file location) with VScode, and commit my changes. You cannot directly do this from your development computer because git doesn't work that way. 

When cloning this repository, my current folder structure looks like this: 'htdocs/Projects/TheFacebook/Git/' and this is the folder structure you need to add in order for the PHP files to reference each other correctly. When you have cloned this repository, it should make an extra folder named 'theFacebook', and thats all you need to do.

## The Database
This project was originally created with XAMPP, but you can use any type of server hosting software for this project that provides mySQL support. You will be able to create your own user base with their registered data. If this is your first time cloning the repository, you may need to run the c# terminal and create the default structure for the database in order for everything to work properly. 

## The SQL Terminal
This is a basic terminal with some commands that is able to interact with the MySQL database. It can be used to type quick commands to create dozens of fake user accounts within seconds. It can also instanly delete all data, create a default structure for the database and it's tables, and it can edit certain values of a particular user/database attribute. 

This has not even been started, but it contains the code that you should be able to use to connect to your database. In the future, the values will be referenced by a JSON file for you to edit. When connecting to the database, you should be able to run the terminal from any computer within your local network, and it should connect depending on your hostname.

Note I have not ran this progam on the server yet, and you may have to change the IP address to '127.0.0.1', and it may still connect. If you are going to run this program from another computer, you will need to copy the 'SQL Terminal' folder from the repository onto your local machine. You will then be able to run it with no errors. You cannot run this program from a shared folder on your server. On your computer, open up the folder, and click the .sln file, and you should be able to run it in Visual Studio. (will be an .exe file in the future)

This may be different for some people, but for me when connecting to the database, I needed to create my own user profile in phpMyAdmin with the hostname being the same thing as the computer's hostname that will be connecting to the database. But recently, I kept getting an error stating that the hostname of my computer isn't allowed to connect to the databse. I then used the hostname for the phpMyAdmin profile of my current computer I was on, and it was successful. Either that, or you can edit the root profile and set the host name as a '%', so it can accept any host name.
