<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="process.css" >
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="bg-info">
<?php
include_once "config.php";
session_start();
date_default_timezone_set("Asia/Calcutta");
$product_uid=$_SESSION["product"];
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
$usern1=$_SESSION["user"];

$i=0;
$flag=5;
$user_p="";

/*echo "flag at starting=".$flag;
echo "<br>";
echo "<br>";echo "<br>";echo "<br>";
echo $product_uid;*/
$sql="SELECT bid_id,product_id from participation where username=? AND product_id=? ";
if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "ss", $param_username,$param_pro);

    // Set parameters
    $param_username = $usern1;
    $param_pro = $product_uid;
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        /* store result */
        echo "<br>";
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $productid=$row['product_id'];
        $bidid=$row['bid_id'];
        //echo $productid."<br>".$bidid."<br>";

        $sql3="SELECT * from bid_registration where bid_id=? and flag=0";
        if($stmt3 = mysqli_prepare($link, $sql3)){
            mysqli_stmt_bind_param($stmt3, "s", $param_bid_id);
    
            // Set parameters
            $param_bid_id = $bidid;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt3)){
                /* store result */
                echo "<br>";
                $res3 = $stmt3->get_result();
                $row3 = $res3->fetch_assoc();
               // echo $row3['bid_id'];
                $own_user=$row3['username'];
                $ini_price=$row3['product_i_price'];
                $bid_date=$row3['bid_date'];
                //echo $own_user."<br>".$ini_price."<br>".$bid_date;
                
            }
            else{
                echo "stmt3 error";
            }
        }
        else{
            echo "bid and product details are not generated";
        }
    }
    else{
        echo "stmt error";
    }
}
echo "<h1>"."Hi,"."<b>".$usern1."</b>".". Welcome to our site."."</h1>";



if($_SERVER["REQUEST_METHOD"] == "POST"){

if(empty(trim($_POST["uprice"]))){
    $username_err = "No value enter";
} else{
    $user_p = trim($_POST["uprice"]);
}

$price_f=(int)$user_p;
//echo $price_f;
}

if(isset($price_f))
{
?>
<div class="text-success bg-white text-center d-4 border-2 border-black">
<div class="legend h2 d-2">Updates..</div>
<?php
echo "\nStatus: Price Entered \n"."<br>";
?>

<?php
$ini_price=(int)$ini_price;
echo "Bid-id:".$bidid." & Username:".$usern1."<br> "."Price Entered".$price_f;
if($price_f<$ini_price)
{
?>
<div class="text-danger">
<?php
echo "Invalid Price , Price Must Be Greater than '{$ini_price}' ";
?>
</div>
<?php
}
else
{
  //echo "<br>"."f=".is_null($flag);
  if(1)
  {
  echo "Bid Starts...";
 
  echo "<br>"."Updating price to '{$price_f}'";
  $sql6="UPDATE process SET bid_price=? WHERE bid_id=? AND username=?";
  if($stmt6 = mysqli_prepare($link, $sql6))
  {
    mysqli_stmt_bind_param($stmt6, "iss",$param_uprice, $param_bidid,$param_username);
    $param_bidid=$bidid;
    $param_username=$usern1;
    $param_uprice=$price_f;
    if(mysqli_stmt_execute($stmt6)){
      // Redirect to login page
     echo "Updated";
     

  } else{
      echo "stmt6 execution error";
  }
 }
 else{
  echo "error in prepare stmt6";
 }

  }
 }

}
//echo "flag at starting=".$flag;

?>

</div>


<br>
<br>
<br>
<?php
echo $bid_date;
$dateTime = new DateTime();
$d1=$dateTime->format('Y-m-d');
$t1=$dateTime->format('H:i:s');//
$active="";
echo "<br>".$d1." ".$t1."<br>";
echo "<br>";

        
       
       $d1 = new DateTime();
       $today=$d1->format('d-m-Y');
       $t1=$d1->format('H:i:s');
       $exp = $bid_date;//"01-06-2020";
       $expt="23:59:59";
       $expDate =  date_create($exp);
       $todayDate = date_create($today);
       $diff =  date_diff($todayDate, $expDate);
       echo $exp." ".$today."\n";
       if($diff->format("%R%a")==="+0" and $t1<$expt){
             echo "active\n";
              $active="active";
       }else{
           echo "inactive\n";
           $active="inactive";
       }
       echo "Remaining Days ".$diff->format("%R%a days")."\n";





if (mysqli_stmt_execute($stmt3)) {
?>
<table class="bg-info">
  
  <tr>
    <td>Owner Name</td>
    <td>Product_id</td>
    <td>Bid id</td>
    <td>Product Initial Price</td>
    <td>Input Price</td>
  </tr>

  <tr>
    <td><?php echo $own_user;?></td>
    <td><?php echo $productid;?></td>
    <td><?php echo $bidid;?></td>
    <td><?php echo $ini_price;?></td>
    <td>
    <?php 
    if($own_user===$usern1) 
    { 
      echo "Input not allowed";
    } 
    elseif ($active==="inactive"){
      echo "inactive";
    }
    else 
    {
    ?>
    <div class="d-4 p-2">
    <?php
    echo "Owner:".$own_user.", Current Bidder: ".$usern1;
    ?>
    </div>
    
    <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="flex-item" method="POST">
      <input class="form-control inline" type="text" name="uprice" value=""></input>
      <input class="form-control inline btn btn-outline-success" type="submit" class="bb-button" name="submit" />
    </form>
    <?php
    }
    ?>
    </td>
  </tr>

</table>
 <?php
}
else{
?>
<div class="textcenter">
<?php echo "No Data Found"; ?>
<?php
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



</body>
</html>

<?php
}
else
{
echo "error\n";
}
?>
