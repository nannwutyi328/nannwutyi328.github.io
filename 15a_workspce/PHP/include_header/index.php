<!-- 
    include : it is used to insert the contents of one PHP file into another PHP file 
    Syntax: include "filename.php"

    include_once:it is used to include a PHP fille only once in a program 
    Syntax: include_once "filename.php"

    require: it is used to include another PHP file in the current PHP file.
    If the required file does not exist or cannot be loaded ,PHP stops the program with a fatal error 
    Syntax:required "filename.php"
-->

<?php
    include "header.php";
    include "menu.php";
?>
<h2>Home Page</h2>
<p>Welcome to my website.</p>

<?php
    include "footer.php";
?>
