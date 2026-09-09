<!-- Local Variable: it is declared inside a function and can only be used inside that function -->
<?php
//function declaration
function calculateOrder(){
    $price = 20;
    $quantity = 3;
    $total = $price * $quantity;

    echo "Total Price: $". $total;
}
//function call
calculateOrder();
?>