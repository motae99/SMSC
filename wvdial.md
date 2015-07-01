# INSTALLATION
$sudo apt-get install wvdial

####################################################################

# Configuration *
- wvdialconf /etc/wvdial.conf
- wvdial
navigate to /etc/wvdial.cong and you should see your device configuration 
should look something like this 

[Dialer Defaults]
Init1 = ATZ
Init2 = ATQ0 V1 E1 S0=0 &C1 &D2 +FCLASS=0
Modem Type = Analog Modem
ISDN = 0
Modem = /dev/ttyUSB2
Baud = 9600

//Modem is where your modem is mapped at /dev/ttyUSB? OR /dev/tty??? 

We gonna need these config later .....

####################################################################

3. Configure internet connection manually (optional)

[Dialer thenet]
Phone = *99***1#
Username = thenetuser
Password = thenetpw
; Username = 9180****** (If your provider use without Username)
; Password = 9180****** (If your provider use without Password)
Stupid Mode = 1
Baud = 460800
Init3 = AT+CGDCONT=1,"IP","apn.thenet.net"



