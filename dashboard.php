<?php
//require "./session.php";
require "./connection.php";

$conn = conn_db();

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);

$_data = array();
if (mysqli_num_rows($result) > 0) {
    //for ($i = 0; $i < mysqli_num_rows($result); $i++) {$row = mysqli_fetch_assoc($result);}
    while($row = mysqli_fetch_assoc($result)) {
        $_data[] = $row;
    }
}
mysqli_close($conn);
?>

<style>
    table, th, td{border: 1px solid grey};
</style>

<button> <a href="create.php"> ADD </a></button>
<table>
    <tr>
        <th>ID</th>
        <th>PRODUCT NAME</th>
        <th>QUANLITY</th>
        <th>STATUS</th>
        <th>ACTION</th>
        <th>USER NAME</th>
    </tr>

    <?php foreach ($_data as $key => $value) : ?>

    <tr>
        <td><?=$value['id'] ?></td>
        <td><?=$value['name'] ?></td>
        <td><?=$value['quanlity'] ?></td>
        <td><?=$value['status'] == 1 ? "Active" : "Deactive" ?></td>
        <td>
            <a href="<?="view.php?id={$value['id']}" ?>"> View </a> ||
            <a href="<?="edit.php?id={$value['id']}" ?>"> Edit </a> ||
            <a href="<?="delete.php?id={$value['id']}" ?>"> Delete </a>
        </td>
        <td><?=$value['user'] ?></td>
    </tr>

    <?php endforeach ?>
</table>