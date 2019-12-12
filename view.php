<style>
    table, th, td{border: 1px solid grey};
</style>
<?php
//require "./session.php";
require "./connection.php";

$conn = conn_db();
$row[] = '';

if(isset($_GET["id"]) && $_GET["id"] > 0) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM product WHERE id = {$id} AND status = 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>PRODUCT NAME</th>
                <th>QUANLITY</th>
                <th>STATUS</th>
                <th>ACTION</th>
                <th>USER NAME</th>
            </tr>
            <tr>
                <td><?=$row['id'] ?></td>
                <td><?=$row['name'] ?></td>
                <td><?=$row['quanlity'] ?></td>
                <td><?=$row['status'] == 1 ? "Active" : "Deactive" ?></td>
                <td>
                    <a href="<?="view.php?id={$row['id']}" ?>"> View </a> ||
                    <a href="<?="edit.php?id={$row['id']}" ?>"> Edit </a> ||
                    <a href="<?="delete.php?id={$row['id']}" ?>"> Delete </a>
                </td>
                <td><?=$row['user'] ?></td>
            </tr>
        </table>
        <?php
        } else {
        header("Location: http://localhost/some_php/login.php");
        die();
        }
    } else {
        echo "loi";
                header("Location: http://localhost/some_php/login.php");
                die();
        }

mysqli_close($conn);

?>