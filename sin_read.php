<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydbpdo";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";
try {
    if (!empty($_GET['eid'])) {
        $id = $_GET['eid'];
        echo "$id";
        $sql = $conn->prepare("select * from myguests where id = $id ");
        $sql->execute();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
<Html>

<head>
    <title></title>
</head>

<body>
    <form method="get" action="">
        <input type="text" name="id" /><br />
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
            <th>edit</th>
        </tr>
        <?php
        $id = $_REQUEST['eid'];
        $sql = $conn->prepare("select * from myguests where id = $id ");
        $sql->execute();
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
                <td><a href="sin_read.php?did=<?php echo $row['id'] ?>">Delete</a></td>
                <!-- $conn = null -->
            <?php }
            ?>

    </table>

</body>

</html>