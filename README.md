# Short Masseging Service
This project is developed by 
1- 
2-
3-
4- MO TAHA motae99@gmail.com "masterBranch"

# Install wvdial and refere to wvdial.md
# Install minicom to verify your modem support for sending and receiving OPTIONAL refere to minicom.md
# Install kannel and refere to http://www.kannel.org/doc.shtml the official guide for more details
- change kannel configuration file with the provided to "kannel.conf"

# Php needs to be installed as well as mysql and a working webserver 

# For front-end we use bootstrap refere to http://getbootstrap.com/ for more information about cosumizing your design
# We use char.js library for generation charts refere to http://www.chartjs.org/

# Configure your Database 
1. Create new Database and insure that UTF-8 is your char set
2. Import schema to your Database "sms.sql for ARABIC DATABASE" "smsEnglish.sql for english"
3. Change configuration on sms/includes/db_connection.php
3.1 set your database USERNAME
3.2 set your database PASSWORD
3.3 set your database NAME

# login and Administration 
* Navigate to sms/public you will be redirected to login page 
   - default login user is "motae"
   - default login password is "motae_999"
   
   To add new user make sure you use The defined function on function.php
   . code snippet is added to sms/puplic/refer/admin.php "to add user and password to ADMIN table"
   . We use Salt and blowfish encryption method to generate password and store Hashed password in database
   
# contripution 
1- Add model to insert new data in database link it with sidebar or navbar on DASHBOARD 
2- configure bar chart to use timestamp to generate chart accordingly "for now it generates random NO"
3- IT ALL YOUR MODIFY IT THE WAY YOU WANT 
