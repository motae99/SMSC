# Short Masseging Service
This project is developed by 
 MO TAHA motae99@gmail.com "masterBranch"

## Install 
wvdial and refere to wvdial.md

minicom to verify your modem support for sending and receiving OPTIONAL refere to minicom.md.

Refere to [kannel](http://www.kannel.org/doc.shtml) the official guide for more details
.. Change kannel configuration file with the provided to "kannel.conf".

php needs to be installed as well as mysql and a working webserver.

For front-end we use [bootstrap](http://getbootstrap.com/) for more information about cosumizing your design.

We use [char.js](http://www.chartjs.org/) library for generation charts.

## Configure your Database 
1. Create new Database and insure that UTF-8 is your char set
2. Import schema to your Database "sms.sql for **ARABIC DATABASE**" "smsEnglish.sql for *English*"
3.  Change configuration on sms/includes/db_connection.php
 - set your database USERNAME
 - set your database PASSWORD
 - set your database NAME

## login and Administration 
* Navigate to sms/public you will be redirected to login page 
   - default login user is "motae"
   - default login password is "motae_999"
   
* To add new user make sure you use The defined function on function.php
   - code snippet is added to sms/puplic/refer/admin.php "to add user and password to ADMIN table"
   - We use Salt and blowfish encryption method to generate password and store Hashed password in database
   
### Contribution 
1. Add model to insert new data in database link it with sidebar or navbar on DASHBOARD 
2. configure bar chart to use timestamp to generate chart accordingly "for now it generates random number"
3. IT ALL YOUR MODIFY IT THE WAY YOU WANT 
