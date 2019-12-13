<?php
require "./session.php";
require "./connection.php";
$sql_msg = "";
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
        require "./connection.php";
        $conn = conn_db();
        $sql = "INSERT INTO product (name, quanlity, status, user)
        VALUES ('{$name}', {$quanlity}, {$status}, '{$user}')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql_msg = "Add successed <a href='view.php?id={$last_id}' target='_blank' >New item</a>";
        } else {
            $sql_err = "Add Fail";
        }

        mysqli_close($conn);
        $name = $quanlity = $status = $user = "";
    }
}
?>

<?=$sql_msg ?>
<h4><?="Hello {$_SESSION['user']["fullname"]} !" ?></h4>

<form method="POST" action="create.php">
    <table>
        <tr>
        <td>Name:</td>
        <td><input type="text" name="name" value="<?=$name ?>"><span><?=$nameErr ?></span></td>

        </tr>
        <tr>
            <td>Quanlity:</td>
            <td><input type="number" name="quanlity" id=""><span><?=$quanlityErr ?></span></td>
        </tr>
        <tr>
            <td>Status:</td>
            <td>
                <select name="status" id="">
                    <option value="1" <?=$status == 1 ? "selected" : "" ?> >Active</option>
                    <option value="0" <?=$status == 0 ? "selected" : "" ?> >Deactive</option>
                </select><span><?=$statusErr?></span>
            </td>
        </tr>
        <tr>
             <td>User:</td>
             <td><input type="text" name="user" id=""><span><?=$userErr ?></span></td>
         </tr>
         <tr>
            <td colspan="2"><input type="submit" value="SUBMIT "></td>
         </tr>
    </table>

</form>