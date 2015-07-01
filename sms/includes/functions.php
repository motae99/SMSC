<?php
	
	function sendsms($message,$to){
	 $url ='/cgi-bin/sendsms?username=kannel&password=kannel&charset=UCS-2&coding=2'
	 		. "&to={$to}"
	  		. '&text=' . urlencode(iconv('utf-8', 'ucs-2', $message));
	 $results = file('http://localhost:13013'.$url);
	 }

	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function validate_presence($value) {

	return isset($value) && $value !== "" && is_numeric($value);
	
	}
	
	function get_location($location){
		global $connection;
		//$safe_location = mysql_prep($location);

		$query  = "SELECT `city` FROM `location` WHERE `id` = {$location} LIMIT 1";
		$result = mysqli_query($connection, $query);
		$loc_city = mysqli_fetch_assoc($result);
		$city = $loc_city['city'];
		return $city;
		
	}
	
	function count_location($city){
		global $connection;

		$query  = "SELECT count(location) AS loc, location  FROM sms WHERE location = '{$city}'";
		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);
		return $result_set ;
	}


	function count_servie($se){
		global $connection;

		$query  = "SELECT count(service) AS no, service  FROM sms WHERE service = '{$se}'";
		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);
		return $result_set ;
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Unknown location or service");
		}
	}

	function find_pharmacy($location){
		global $connection;
		$safe_location = mysql_prep($location);

		$query  = "SELECT * ";
		$query .= "FROM pharmacy ";
		$query .= "WHERE loc_id = {$safe_location} ";
		$query .= "ORDER BY name ASC";
		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);
		return $result_set;
	}

	function find_lab($location){
		global $connection;
		$safe_location = mysql_prep($location);

		$query  = "SELECT * ";
		$query .= "FROM lab ";
		$query .= "WHERE loc_id = {$safe_location} ";
		$query .= "ORDER BY name ASC";
		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);
		return $result_set;
	}
	
	

	function find_all($service, $location){
		global $connection;
		$safe_location = mysql_prep($location);
		$safe_service = mysql_prep($service);
		
		$query  = "SELECT * ";
		$query .= "FROM {$safe_service} ";
		$query .= "WHERE loc_id = {$safe_location} ";
		$query .= "ORDER BY name ASC";
		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);
		return $result_set;
	}

	function find_dr($dr, $location){
		global $connection;
		$safe_location = mysql_prep($location);
		$safe_dr = mysql_prep($dr);
		$query  = "SELECT `works_at`.`availability` , `clinic`.`name` , `clinic`.`address` , `specialist`.`dr_name` ";
		$query .= "FROM works_at ";
		$query .= "LEFT JOIN `smsc`.`clinic` ON `works_at`.`clinic_id` = `clinic`.`id` ";
		$query .= "LEFT JOIN `smsc`.`specialist` ON `works_at`.`dr_id` = `specialist`.`id` ";
		$query .= "WHERE ( ";
		$query .= "(specialist.key = '{$safe_dr}') ";
		$query .= "AND ";
		$query .= "(loc_id = {$safe_location}) ";
		$query .= ")";
		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);
		return $result_set;
	}

	function save_text($no, $service, $location, $response){
		global $connection;
		
		$safe_location = mysql_prep($location);
		$safe_service = mysql_prep($service);		
		$safe_no = mysql_prep($no);	
		$safe_response = mysql_prep($response);	
		
		$query  = "INSERT INTO sms (";
		$query .= "  no, location, service, text";
		$query .= ") VALUES (";
		$query .= "  {$safe_no}, '{$safe_location}', '{$safe_service}', '{$safe_response}' ";
		$query .= ")";
		$result = mysqli_query($connection, $query);
	
	}
	
	function find_admin_by_username($username) {
		global $connection;
		
		$safe_username = mysqli_real_escape_string($connection, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	
	function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function attempt_login($username, $password) {
		$admin = find_admin_by_username($username);
		if ($admin) {
			// found admin, now check password
			if (password_check($password, $admin["hashed_password"])) {
				// password matches
				return $admin;
			} else {
				// password does not match
				return false;
			}
		} else {
			// admin not found
			return false;
		}
	}

	function logged_in() {
		return isset($_SESSION['admin_id']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("login.php");
		}
	}

?>

