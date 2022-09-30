<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydbpdo";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $email = $_REQUEST['email'];
    $sql = $conn->prepare("update myguests set firstname='$firstname',lastname='$lastname',email='$email' where id=$id");
    $result = $sql->execute();
    if ($result) {
        echo "updated";
    } else {
        echo "failed to update";
    }
    $sqll = $conn->prepare("select * from myguests");
    $sqll->execute();
} else {
    echo "failed to update";
}
