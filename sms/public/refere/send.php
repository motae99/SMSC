<?php
function sendsms($message,$to)
 {
 $url ='/cgi-bin/sendsms?username=kannel&password=kannel&charset=UCS-2&coding=2'
 		. "&to={$to}"
  		. '&text=' . urlencode(iconv('utf-8', 'ucs-2', $message));
 $results = file('http://localhost:13013'.$url);

 }

  sendsms('السﻻم', '0922066609');
 ?>