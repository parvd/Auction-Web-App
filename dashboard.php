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
<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<!--
<div class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary text-white mb-5">
    <div class="container">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav">
                  <li class="nav-item btn"><a class="active nav-link" href="#home">Home</a></li>
                  <li class="nav-item btn"><a class="nav-link" href="#news">News</a></li>
                  <li class="nav-item btn"><a class="nav-link" href="#contact">Contact</a></li>
                  <li class="nav-item btn"><a class="nav-link" href="#about">About</a></li>
            </ul>
			<button class="btn btn-light ml-auto nav-link" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Bid Login</button>

        </div>
    </div>
</div>
-->

<nav class="navbar navbar-expand-sm navbar-dark bg-primary text-white">
  <div class="container">
    <button class="navbar-toggler btn-lg ml-auto" data-toggle="collapse" data-target="#navid">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navid">
      <ul class="navbar-nav">
        <li class="nav-item btn">
          <a href="#" class="nav-link active"><h2>Home</h2></a>
        </li>
        <li class="nav-item btn">
          <a href="#" class="nav-link"><h2>News</h2></a>
        </li>
        <li class="nav-item btn">
          <a href="#" class="nav-link"><h2>Contact</h2></a>
        </li>
        <li class="nav-item btn">
          <a href="#" class="nav-link"><h2>About</h2></a>
        </li>
      </ul>
      <button class="btn ml-auto nav-link btn-outline-success text-white" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><h2>Bid Login</h2></button>

    </div>  
  </div>
</nav>


<div id="id01" class="modal">
  
  <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="imgcontainer text-center">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="goku.jpg" style="height:500px;width:500px" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <div>
      <label class="h3" for="uname">Product_ID</label>
      <input type="text" placeholder="Enter Product ID" name="uname" required>
      <span class="help-block"><?php echo $user_product_err; ?></span>
      </div>
      <div>
      <label class="h3" for="psw">Password</label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <span class="help-block"><?php echo $password_err; ?></span> 
      </div>
      <button type="submit" class="btn btn-primary btn-outline-success btn-lg text-white">Login</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      
    </div>
  </form>
</div>
</div>


<!--Main Page Starts-->
<header class="mb-4 text-center mt-4">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
</header>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<form action="bidreg.php" class="p-4 item-hl">
			<button class="btn btn-outline-success text-white btn-primary btn-block"><h3>Create Bid</h3></button>
		</form>
	</div>
  
	<div class="col-sm-12 col-md-6">
		<form action="process.php" class="p-4 item-hl">
			<button class="btn btn-outline-info text-white btn-primary btn-block"><h3>Participate in Bid</h3></button>
		</form>
	</div>
  
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

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    


</body>
</html>

<?php
}
 else{
header('location:goku.jpg');
}
?>