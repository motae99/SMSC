<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" xml:lang="ar">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"></meta>
</head>


<?php 
	//IT HAS TO BE PRESENCE BECAUSE IT'S FORWARDED TO US
	//BY KANNEL SERVER 
	$sender = $_GET["sender"];
	$no = $sender;
	
	$service = $_GET["sk"];
	
	$location = $_GET["fk"];
	
	//retrieving location's city from database using id 
	$city = get_location($location);
	
	if(!validate_presence($location)){
		$text = "الرجاء تحديد مكان تواجدك";
		$location = "غير معروف";
		$service = "غير معروف";
		
		//sending replay
		sendsms($text,$sender);
		//inserting data into database
		save_text($no, $service, $location, $text);
		
	}elseif(!validate_presence($service)){
		$text = "الرجاء تحديد نوع الخدمة ";
		$service = "غير معروف";
		// echo $text ;

		//send message 
		sendsms($text,$sender);
		//inserting data into database
		save_text($no, $service, $city, $text);
		
	}elseif($service === '100'){
		$result_set = find_pharmacy($location); 
		$response = array();

		while($result = mysqli_fetch_assoc($result_set)){
			$text = $result["name"] . ": " . $result["address"] ;
			// echo $text ; 
			$response[] = $text ;			
		}

		$text = ''.implode('|',$response).'|';
			
			//sending reply
			sendsms($text,$sender);
			
			//inserting data into database
			save_text($no, 'صيدلية', $city, $text);


	}elseif($service === '200'){
		$result_set = find_lab($location); 
		$response = array();

		while($result = mysqli_fetch_assoc($result_set)){
			$text = $result["name"] . ": " . $result["address"]  ;
			//echo $text ; 
			$response[] = $text ;			
		}

		$text = ''.implode('|',$response).'|';

			//sending reply
			sendsms($text,$sender);

			//inserting data into database
			save_text($no, 'معمل', $city, $text);

	}else{
			$doctors = find_dr($service, $location);
			$response = array();
			while($dr = mysqli_fetch_assoc($doctors)){
				$text = "د " . $dr["dr_name"] . " من " . $dr["availability"] . " في " . $dr["name"] . " : " . $dr["address"]  ;
				//echo $text ;
				$response[] = $text ;			
			}
			$text = ''.implode('|',$response).'|';

			
			//sending reply
			sendsms($text,$sender);

			save_text($no, 'دكتور', $city, $text);
	}
 	

	if (isset($connection)) {
	  mysqli_close($connection);
	}

?>
</html>


