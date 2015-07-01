#Installation:

### $sudo apt-get install minicom 

 $minicom -<args> //for args check the manual 
# manual:
$man minicom

Minicom configuration has been explained offline
for more details check the guide "minicom_User_Guide.pdf" . 


##### minicom -s
            +-----[configuration]------+
            | Filenames and paths      |
            | File transfer protocols  |
            | Serial port setup        |
            | Modem and dialing        |
            | Screen and keyboard      |
            | Save setup as dfl        |
            | Save setup as..          |
            | Exit                     |
            | Exit from Minicom        |
            +--------------------------+
Serial port setup and configure the modem
            
########################## EXAMPLES ###################################
            
###  Answer an Incoming call – ATA

To answer an Incoming call via modem, issue the “ATA” command in the minicom.

RING
ATA
OK

*The modem will answer an incoming call on the second ring using the command ATS0=2.*

### Dialing out and hanging up a voice call – ATD – ATH

You can also dial out a voice call from the modem using ATD command.

ATD 0xxxxxxxx; // the number you want to use 
OK


### Getting Signal quality and battery charge status

You can also get the signal quality and the battery charge status using AT extended commands.

AT+CSQ
+CSQ: 29,99

OK
AT+CBC
+CBC: 1,96

OK


### Sending SMS using AT commands

You can also send SMS via AT commands.

AT+CMGF=1
OK
AT+CMGS="99xxxxxxxx"
> This is a test message
> 
OK

The command AT+CMGF=1 sets the “Message format” to “text mode”. The command AT+CMGS, send the SMS to the specified number. < ctrl +z > is used to terminate the message input.



#### Reading SMS Messages from a Message Storage Area Using AT Commands (AT+CMGR)

* to read massege at index no 3 : AT+CMGR=3
* to read massege at index no n : AT+CMGR=n //where in is the index no
 

#### Listing SMS Messages from a Message Storage Area Using AT Commands (AT+CMGL)

* to list massege: AT+CMGL="REC UNREAD" // list unread messages 
* to list massege: AT+CMGL="READ" // list read messages
* to list massege: AT+CMGL="ALL" // list all messages
* 
**Things to be added** 
- tow modes text and pdu 4"all",  0 "rec unread", 1 "rec read"
- (AT+CMGF) to select which modem
- at+cmgf=0 //pdu doesn't support text only numeric values 
- at+cmgf=1 //text

*Storage area* 
for my case its sim card I have 1 text, storage capability is 20
AT+CPMS?

+CPMS: "SM",1,20,"SM",1,20,"SM",1,20


