<?php
    // Create connection
	$db = new SQLite3('coffeedb.sq3');
	// Check connection
    
	if (!$db) {
		die("Connection failed: " . $db->lastErrorMsg());
	}

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    $checkEmail = $db->querySingle("SELECT COUNT(*) as count FROM customers WHERE email_address ='$email'");

    if ($checkEmail > 0){
        echo "Email already exists in database.";
    } else {
        $query = "INSERT INTO customers (first_name, last_name, email_address) VALUES ('$fname', '$lname', '$email')";
        $result = $db->exec($query);

        if ($result){
            echo "Data inserted successfully.";
        } else {
            echo "Error inserting data: " . $db->lastErrorMsg();
        }

    }

    $db->close();

?>
	
