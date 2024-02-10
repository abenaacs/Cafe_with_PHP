<?php 
include("../conn.php");

    $jsonData = file_get_contents('php://input');
    $selected = json_decode($jsonData, true);

         storeFoodList($selected, $conn);
            
    function storeFoodList($foodList, $conn){
    $totalPrice = 0;
    $totalAmount = 0;
    $foods = "";
    $date = date("Y-m-d");
    $waiterId = $_COOKIE["waiter_id"];

    foreach ($foodList as $food) {
        $name = $food['name'];
        $amount = $food['amount'];
        $price = $food['price'];

        $totalPrice += $price * $amount;
        $totalAmount += $amount;
        $foods .= ", " . $name;
    }

    $sql = "INSERT INTO `orders` (`food`, `amount`, `totalPrice`, `date`, `waiter_id`) VALUES ('$foods', '$totalAmount', '$totalPrice', '$date', '$waiterId')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Order stored successfully!";
    } else {
        echo "Failed to store the order.";
    }
}
?>

