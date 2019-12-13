<?php
//require "./session.php";
require "./connection.php";

$conn = conn_db();

$id = 0;
$row = "";

$nameErr = $quanlityErr = $statusErr = $userErr = "";
$name = $quanlity = $status = $user = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["name"]) && !empty($_POST["name"])) {
        $name = $_POST["name"];
    } else {
        $nameErr = "Name is required";
    }

    if (isset($_POST["quanlity"]) && !empty($_POST["quanlity"])) {
        $quanlity = $_POST["quanlity"];
    } else {
        $quanlityErr = "Quanlity is required";
    }

    if (isset($_POST["status"]) && in_array($_POST["status"], [1,0])) {
        $status = $_POST["status"];
    } else {
        $statusErr = "Status is required";
    }

    if (isset($_POST["user"]) && !empty($_POST["user"])) {
        $user = $_POST["user"];
    } else {
        $userErr = "User is required";
    }

    if (empty($nameErr) && empty($quanlityErr) && empty($statusErr) && empty($userErr)) {
        $sql = "UPDATE product SET product.name = '{$name}', product.quanlity = {$quanlity}, product.status = {$status}, product.user = '{$user}'
        WHERE id={$_POST['id']}";

        if (mysqli_query($conn, $sql)) {
            header("Location: http://localhost/some_php/dashboard.php");
        } else {
            //var_dump(mysqli_error($conn));
            die("false");
        }
        $name = $quanlity = $status = $user = "";
    }
}


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM product WHERE id = {$_GET['id']}";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        //var_dump($row);
        } else {
            header("Location: http://localhost/some_php/dashboard.php");
            die();
            }
        } else {
            header("Location: http://localhost/some_php/dashboard.php");
}

mysqli_close($conn);
?>

<form method="POST" action="edit.php?id=<?=$row['id']?>" >
    <table>
        <tr>
        <td>Name:</td>
        <td><input type="text" name="name" value="<?=$row['name'] ?>"></td>
        </tr>

        <tr>
            <td>Quanlity:</td>
            <td><input type="number" name="quanlity" value="<?=$row['quanlity'] ?>"></td>
        </tr>

        <tr>
            <td>Status:</td>
            <td>
                <select name="status" id="">
                    <option value="1" <?=$row['status'] == 1 ? "selected" : "" ?> >Active</option>
                    <option value="0" <?=$row['status'] == 0 ? "selected" : "" ?> >Deactive</option>
                </select>
            </td>
        </tr>

        <tr><td><input type="hidden" name="id" value="<?=$row['id'] ?>"></td></tr>

        <tr>
             <td>User:</td>
             <td><input type="text" name="user" value="<?=$row['user'] ?>"></td>
         </tr>

         <tr><td colspan="2"><input type="submit" value="SUBMIT "></td></tr>
    </table>
</form>
