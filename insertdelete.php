<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydbpdo";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";
//insert data
try {
    if (!empty($_REQUEST['save'])) {
        $getfirstname = $_REQUEST['firstname'];
        $getlastname = $_REQUEST['lastname'];
        $getemail = $_REQUEST['email'];
        $sql = "INSERT INTO myguests (firstname, lastname, email) VALUES ('$getfirstname', '$getlastname', '$getemail')";
        // use exec() because no results are returned
        if ($conn->exec($sql)) {
            echo "New record created successfully";
        } else {
            echo "failed";
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
//delete  data
try {
    if (isset($_REQUEST['did'])) {
        $id = $_REQUEST['did'];

        $query = "delete from myguests where id=$id";
        $state = $conn->prepare($query);

        if ($state->execute()) {
            echo "delete successful";
        } else {
            echo "there is an error";
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

// $conn = null;
?>

<Html>

<head>
    <title></title>
</head>

<body>
    <form method="get" action="">
        firstname<input type="text" name="firstname" /><br /><br />
        lastname<input type="text" name="lastname" /><br /><br />
        email<input type="text" name="email" /><br /><br />
        <input type="submit" name="save" value="Save the Form" />
    </form>
    <table border="1" width=80%>
        <tr>
            <th>ID</th>
            <th>firstname</th>
            <th>lastname</th>
            <th>email</th>
            <th>date</th>
            <th>delete</th>
        </tr>
        <?php
        //display data
        $sql = $conn->query("select * from myguests");
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        // if (count($result)) {
        foreach ($result as $row) {
        ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['firstname'] ?></td>
                <td><?php echo $row['lastname'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['reg_date'] ?></td>
                <td><a href="insertdelete.php?did=<?php echo $row['id'] ?>">Delete</a></td>
            <?php }
            ?>
    </table>

</body>

</html>