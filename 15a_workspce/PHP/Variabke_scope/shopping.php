<!--Sample Output
Shop: Unique Shop
Order Number: #1
Product: Laptop
Quantiy: 1
Total: $5000
------------------------------------------------------------------------------------------
Shop: Unique Shop
Order Number: #2
Product: Mouse
Quantiy: 1
Total: $40
------------------------------------------------------------------------------------------
Shop: Unique Shop
Order Number: #3
Product: Keyboard
Quantiy: 1
Total: $50
------------------------------------------------------------------------------------------
-->

<?php
//Global Variable
$shopName = "Unique";

//Function 
function createOrder($product, $price, $quantity){
    //Local Variable 
    $total = $price * $quantity;

    //Static Variable 
    static $orderNumber = 0;
    $orderNumber++;

    //Access Global Variable
    global $shopName;

    //Output
    echo "Shop: " .$shopName . "<br>";
    echo "Order Number: #" .$orderNumber. "<br>";
    echo "Product: " .$product . "<br>";
    echo "Quantity: " .$quantity . "<br>";
    echo "Total: $" .$total . "<br>";
    echo "---------------------------------------<br>";
    }

    createOrder("Laptop", 500, 1);
    createOrder("Mouse", 20, 2);
    createOrder("Keyboard", 50, 1);
?>