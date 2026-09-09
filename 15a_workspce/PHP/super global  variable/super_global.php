<?php
/*
superglobals -predefined variables that are available in all scope (functions,class and other 
parts of php program without using global keyword They always start with $_prefix,expect $GLOBALS  )
1. $GLOBALS - is an array that contains all variables defined in global scope ,it can be used inside a function to access variable that were created outside the function
*/


//Example 

$x=10;
$y=20;
function add(){
    echo $GLOBALS['x']+$GLOBALS['y'];

}
add();


/*
2.$_SERVER: contains information about server,request,headers,paths,and current php script,it is an associative array.
*/

//Example
echo "<br>";
echo $_SERVER['PHP_SELF'];//current php script
echo "<br><br>";
echo $_SERVER['SERVER_NAME'];//server name
echo "<br><br>";
echo $_SERVER['REQUEST_METHOD'];//http request method
echo "<br><br>";
echo $_SERVER['HTTP_USER_AGENT'];//browser/client information
echo "<br><br>";
echo $_SERVER['REMOTE_ADDR'];//client ip address
echo "<br><br>";

echo $_SERVER['REQUEST_URL'];//current ip address
echo "<br><br>";


/*
3.$_GET :It is used to collect data sent through the URL query string,data appears after the ? in a URL 
It is mainly used for:
    1.search
    2.filtering
    3.sorting
    4.page numbers
    5.passing ids
    6.url parameters
Example URL:https://example.com/index.php?name=Jhon
*/
echo $_GET['name'];//no output
echo "<br>";
echo $_GET['age'];

/*
4.$_POST : It is used to collect data submitted through an HTTP POST request,it is commonly used with html forms
 */
echo $_POST['username'];
echo "<br>";
echo $_POST['password'];


/*
5. $_REQUEST:It can contains data from :$_GET,$_POST,$_COOKIE
*/
echo $_REQUEST['username'];
echo "<br>";
echo $_REQUEST['password'];


/*
6.$_SESSION: it is used to store information about a user across multiple pages during a session , it is commonly used for:
    1.login systems
    2.user authentication
    3.shooping carts
    4.user preferences
    5.temporary user information

 */
session_start();
$_SESSION['username']="John";
echo $_SESSION('username');



/*
7. $_COOKIE: it is used to access cookies stored the user's browser,
Cookies are commonly used for:
    1.remembering preferences
    2.language setting
    3.theme setting
    4.remember-me functionality
    5.tracking/session-related purposes
 */
//Create a cookies
setcookie(
    "username",
    "John",
    time()+3600
);//cookie will be availabe for approximately 1 hour

echo $_COOKIE['username'];

/*
$_FILES: it is used to collect information about files uploaded through an HTML FORM it is commonly used for:
    1.profile pictures
    2.documents
    3.pdfs
    4.images
    5.videos
*/

//$_FILES Porperties
echo $_FILES['photo']['name'];//original filename
echo "<br>";
echo $_FILES['photo']['size'];//file size in bytes
echo "<br>";
echo $_FILES['photo']['type'];//file type
echo "<br>";


?>