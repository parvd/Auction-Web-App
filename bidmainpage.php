<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    
?>

<?php
}
 else{
header('location:goku.jpg');
}
?>