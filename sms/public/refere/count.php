<?php //require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php //require_once("../includes/validation_functions.php"); ?>
<?php //confirm_logged_in(); 

//$query = mysql_query("SELECT count(*) from sms where location = 'khartoum'");
   //global $connection;
// $query = "SELECT no FROM sms" ;
//     $result = mysqli_query($connection, $query);
//         confirm_query($result);

//     while($data = mysql_fetch_assoc($result)){
//     	echo $data['no'] ;
//     }
 //    $try = count_location(1);
 // $data=mysql_fetch_assoc($try);
 // echo $data['name'];
  		

  		$se = 'pharmacy';
	
  		

		$set = count_servie($se) ;
 		 while($result = mysqli_fetch_assoc($set)){
			$service = $result['service'] ;
			$cnt =  $result["no"] ;
		} 
		echo $service . "<br>" ;
		echo $cnt ;
?>
