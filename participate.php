<?php
include_once 'config.php';
require_once 'mailer/class.phpmailer.php';
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
echo $_POST["submit"]."<br>";
$productid=$_POST["submit"];
$usern1=$_SESSION["username"];
echo "Hello".$usern1."<br>".$productid;
$pwdgen=uniqid("pwd");
$mail = new PHPMailer(true);
$sql="SELECT emailid,id from user_t where username=?";
$sql3="SELECT bid_id from bid_registration where product_id=?";
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    
    // Set parameters
    $param_username = $usern1;
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        /* store result */
        echo "<br>";
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        //echo $row['emailid'];
        //echo "<br>".$row['id']."<br>".$pwdgen;
            //email sending
    
        $email= $row['emailid'];
        if($stmt3 = mysqli_prepare($link, $sql3)){
            mysqli_stmt_bind_param($stmt3, "s", $param_user_pro);
    
            // Set parameters
            $param_user_pro = $productid;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt3)){
                /* store result */
                echo "<br>";
                $res3 = $stmt3->get_result();
                $row3 = $res3->fetch_assoc();
               // echo $row3['bid_id'];
                $bidid=$row3['bid_id'];
            }
            else{
                echo "bid id not generated";
            }
        echo $bidid."<br>";
        /*
        //Mail Message
        $subject="Bid Participation Done";
        $text_message= "Namaste";      
        //$message="Hello '{$usern1}', Credentials are '{$row['emailid']}' and '{$pwdgen}'";
        $msg = "Hello '{$usern1}', Credentials are '{$email}' and '{$pwdgen}'";
        
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,200);
        mail($email,$subject,$msg);*/
        $sql4 = "SELECT username FROM participation WHERE bid_id = ? AND username=?";
        
        if($stmt4 = mysqli_prepare($link, $sql4)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt4, "ss", $param_bid_id,$param_user);
            
            // Set parameters
            $param_bid_id= $bidid;
            $param_user=$usern1;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt4)){
            $result=$stmt4->get_result();
            $re = mysqli_num_rows($result);
            echo "<br>".$re;
            //echo var_dump($result);
            //echo "in stmt4";
            if($re==0){
            $sql2="INSERT INTO participation (product_id,bid_id,username,part_pwd) VALUES (?,?,?,?)";
            if($stmt2 = mysqli_prepare($link, $sql2)){
            // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt2, "ssss", $p_productid,$p_bidid,$p_usern1,$p_pwdgen);
            
            // Set parameters
                $p_productid=$productid;
                $p_bidid=$bidid;
                $p_usern1=$usern1;
                $p_pwdgen=$pwdgen;
            // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt2)){
                // Redirect to login page
                    echo "successfully registered";
                    $sql7="INSERT INTO process (bid_id,username,bid_price) VALUES ('{$bidid}','{$usern1}','0')";
                    if (mysqli_query($link, $sql7)) {
                    echo "New record created successfully";
                    } else {
                    echo "Error: " . $sql7 . "<br>" . mysqli_error($link);
                }
               }
               else{
                echo "participation insertion error";
                }
        
              } 
              else{
                  echo "prepare hi insert error";
              }
            }
            else{
                echo "User Exist";
            }
             }
             else
             {
                 echo "user exist";
             }
     }
    else{
        echo "participation connection error";
    }
   }
   else{
       echo "stmt3 productid link error";
   }
  }
  else{
      echo "stmt exec error";
  }
 }
else{
    echo "stmt emailid link error ";
}
}
else
{
    echo "fuck you login now"; 
}
?>