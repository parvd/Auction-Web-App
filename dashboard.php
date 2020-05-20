<?php
session_start();
include_once 'config.php';
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
  $user_product = $password = "";
  $user_product_err = $password_err = "";
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["uname"]))){
      $user_product_err = "Please enter product id.";
   } else{
      $user_product = trim($_POST["uname"]);
   }
  
  // Check if password is empty
  if(empty(trim($_POST["psw"]))){
      $password_err = "Please enter your password.";
   } else{
      $password = trim($_POST["psw"]);
   }
   $user_name=$_SESSION["username"];
   echo "<br>".$user_product."<br>".$password."<br>".$user_name;

   if(empty($user_product_err) && empty($password_err)){
    // Prepare a select statement
    $sql = "SELECT username, part_pwd FROM participation WHERE product_id = ? AND username=?";
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_user_product,$param_user_name);
        //echo "done1\n";
        // Set parameters
        $param_user_product = $user_product;
        $param_user_name= $_SESSION["username"];
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
          //if(mysqli_stmt_execute($stmt3)){
            /* store result */
            echo "<br>";
            $res3 = $stmt->get_result();
            $row3 = $res3->fetch_assoc();
           // echo $row3['bid_id'];
            $my_user=$row3['username'];
            $my_pwd=$row3['part_pwd'];
            echo $my_user."<br>".$my_pwd."<br>";

            if($my_user===$user_name&&$my_pwd===$password)
            {
              session_start();
              $_SESSION["user"]=$user_name;
              $_SESSION["product"]=$user_product;
              header("location: function.php");

            }
            else{
              $password_err="Incorrect Password"; 
            }



            
        //}
            }
             else{
                // Display an error message if user_product doesn't exist
                $user_product_err = "No account found with that product.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}





?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="mycss.css" >
</head>
<body>

<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Bid Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="goku.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <div>
      <label for="uname"><b>Product_ID</b></label>
      <input type="text" placeholder="Enter Product ID" name="uname" required>
      <span class="help-block"><?php echo $user_product_err; ?></span>
      </div>
      <div>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <span class="help-block"><?php echo $password_err; ?></span> 
      </div>
      <button type="submit">Login</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      
    </div>
  </form>
</div>
</div>


<!--Main Page Starts-->
<div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
</div>
<div class="flex">
  <form action="bidreg.php" class="flex-item">
    <button class="bb-button">Create Bid</button>
  </form>

  <form action="process.php" class="flex-item">
    <button class="bb-button">Participate in Bid</button>
  </form>
</div>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


</body>
</html>

<?php
}
 else{
header('location:goku.jpg');
}
?>