<?php
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
if (!empty($username)) {
    if (!empty($password)) {
        $host = 'localhost';
        $dbusername = 'root';
        $dbpassword = '';
        $dbname = 'test';
        
        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
        
        // Check connection
        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        } else {
            // Prepare and bind the statement
            $stmt = $conn->prepare("INSERT INTO form (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "New record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "Password should not be empty";
        die();
    }
} else {
    echo "Username should not be empty";
    die();
}
?>
