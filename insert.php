<?php

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($fullname) || !empty($username) || !empty($email) || !empty($password)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "studentportal";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_errno()) {
        die('Connect('. mysqli_connect_errno().')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register (fullname, username, email, password) values (?, ?, ?, ?)";

        //prepare statement

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            $stmt-> $conn->perpare($INSERT);
            $stmt->bind_param("ssss", $fullname, $username, $email, $password);
            $stmt->execute();
            echo "Account Registered Successfully";
        } else {
            echo "Email Already Exists";
        }
        $stmt->close();
        $conn->close();
    }

} else{
    echo "All Fields are Required";
    die();
}
