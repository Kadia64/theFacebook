In order to run the python session manager program, you need to activate the virtual
environment on your linux machine. If you do not have it already, you will need to install
python3's virtual environment package:

$ sudo apt install python3.10-venv

You can then create you virtual python environment. 'envname' is the name for your environment:

$ python3 -m venv envname

You will also need to select the source of the environment like this in your relavent
directory of your environment:

$ source envname/bin/activate

With this command ran, you should now be able to download the required libraries for the python
script while your virtual environment is running:

$ pip install mysql-connector-python
$ pip install colorama

If you are doing these steps more than once, you will need to still reinstall the python
library for the script to work.
To stop the environment from running, you simply run this:

$ deactivate