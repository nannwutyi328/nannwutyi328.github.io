<!-- Global Variable - it is declared outside a function -->

<?php
    $schoolName = "Metro";
    // Declare Function
    function show(){
        global $schoolName;
        echo "School Name: ".$schoolName;
    }
    // Call Function
    show();
?>














