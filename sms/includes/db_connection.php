<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "motae999");
	define("DB_NAME", "smsc");
  // 1. Create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // mysqli_set_charset($connection, "utf8");
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
  if(!mysqli_set_charset($connection, "utf8")){
    printf("Error loading character set utf8", mysqli_error($connection));

  }
  //else {
  //   printf("Current character set : %s\n", mysqli_character_set_name($connection));    
  // }
?>
