<!-- Static Variable: it is declared inside a function but 
 remembers its value between function calls -->

<?php
    //function declaration
    function createOrder(){
        static $orderNumber = 0;
        $orderNumber++;

        echo "Order Number: ".$orderNumber."<br>";
    }
    //function call
    createOrder();
    createOrder();
    createOrder();
    createOrder();
    
?>