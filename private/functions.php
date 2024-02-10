<?php
include("../conn.php");

if(isset($_POST['res'])){
    $deleteName = $_POST['res'];
$sql = "DELETE FROM `food` WHERE `name` = '$deleteName'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Food Item Deleted successfully!";
} else {
    echo "Failed to Delete Item.";
}
}
?>

