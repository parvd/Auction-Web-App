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

echo "flag at starting=".$flag;
echo "<br>";
echo "<br>";echo "<br>";echo "<br>";
echo $product_uid;
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
echo $price_f;
}

if(isset($price_f))
{

echo "\nPrice Entered\n"."<br>";
$ini_price=(int)$ini_price;
echo $bidid." ".$usern1." ".$price_f;
if($price_f<$ini_price)
{
echo "Invalid Price , Price Must Be Greater than '{$ini_price}' ";
}
else
{
  echo "<br>"."f=".is_null($flag);
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
echo "flag at starting=".$flag;

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="process.css" >
</head>
<body>


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

       $exp = "01-06-2020";  
       $expt="21:59:59";
       $d1 = new DateTime();
       $today=$d1->format('d-m-Y');
       $t1=$d1->format('H:i:s');
       //$t1="23:59:59";
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
<table>
  
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
    echo $own_user." ".$usern1;
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="flex-item" method="POST">
    <input type="text" name="uprice" value=""></input>
    <input type="submit" class="bb-button" name="submit" />
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



</body>
</html>

<?php
}
else
{
echo "error\n";
}
?>