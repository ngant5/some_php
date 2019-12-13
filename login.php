<?php
session_start();
require "./connection.php";
$conn = conn_db();
$row = "";

$username = $pass = $msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM user WHERE user_name = '{$username}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row["user_pass"] == md5($pass)) {
            echo "thanh cong";
            $session_user = [
                'id' => $row['id'],
                'fullname' => $row['fullname'],
                'role' => $row['role']
            ];
            $_SESSION['user'] = $session_user;
            header("Location: http://localhost/some_php/dashboard.php");
        }
    } else {
        $msg = "User name or password is wrong";
    }
}
mysqli_close($conn);
?>

<?=$msg ?>

<form action="login.php" method="post">
    <table>
        <tr>
            <td>User name:</td>
            <td><input type="text" name="user" id=""></td>
        </tr>

        <tr>
            <td>Password: </td>
            <td><input type="password" name="pass" id=""></td>
        </tr>
    <tr><td><input type="submit" value="LOGIN" ></td></tr>
    </table>
</form>