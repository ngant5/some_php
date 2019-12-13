<?php
require "./session.php";
require "./connection.php";

$conn = conn_db();

$id = @$_GET['id'];

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sql = "SELECT * FROM product WHERE id = {$id}";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $sql = "DELETE FROM product WHERE id = {$id}";
        if (mysqli_query($conn, $sql)) {
            header("Location: http://localhost/some_php/dashboard.php");
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        header("Location: http://localhost/some_php/dashboard.php");
        die();
    }
}


?>