<?php

	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			
			$output = "<div class=\"alert alert-danger\" role=\"alert\">";
			$output .= "<strong>" . htmlentities($_SESSION["message"]) . "</strong>";
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
	
?>
