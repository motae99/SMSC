<?php //require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php


    $username = 'motae';
    $hashed_password = password_encrypt('motae999');
    $email = 'motae99@gmail.com';
    
    $query  = "INSERT INTO admins (";
    $query .= "  username, hashed_password, email";
    $query .= " ) VALUES (";
    $query .= "  '{$username}', '{$hashed_password}', '{$email}' ";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      echo "admin Created";
    } else {
      echo "failed to create ";
    }
?>


