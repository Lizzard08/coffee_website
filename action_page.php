<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "localhost";

// Create connection
$db =  new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
echo "Connected successfully";

// Take in input from form
if (isset($_POST['register_user'])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    if (empty($fname)) {
        echo "First name required";
    }
    if (empty($lname)){
        echo "Last name required";
    }
    if (empty($email)){
        echo "Email required";
    }

    // Check database to see if email already exists
    $checkEmail = "SELECT email_address FROM mail_list WHERE email_address = '{email}'";
    $result = mysqli_query($db, $checkEmail);
    $user = mysqli_fetch_assoc($result);

    if ($user['email'] == $email){
        echo "Email Address already on mailing list";
    } else {
        // Register user
        $query = "INSERT INTO mail_list (first_name, last_name, email_address)
                VALUES ($fname, $lname, $email)";
        mysqli_query($db, $query);
    }
}
if ($db->query($query) === TRUE) {
    echo "New record created successfully";

} else {
echo "Error: " . $query . "<br>" . $db->error;
}

$db->close();
?>