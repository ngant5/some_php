<?php
require "./session.php";
require "./connection.php";

$conn = $conn_db();
$row = '';

if(isset($_GET["id"]) && $_GET["id"] > 0) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM product WHERE id = {$id} AND status = 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: http://localhost/some_php/login.php");
        die();
    }
} else {
        header("Location: http://localhost/some_php/login.php");
        die();
}

mysqli_close($conn);

?>