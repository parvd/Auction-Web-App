<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$product =$price= $category = $comment =$selected_val = $date1="";
$product_err =$price_err= $category_err = $comment_err =$date_err = "";
$usern1=$_SESSION["username"];
$product_id = $bid_id = $userid="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //test function
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }


    // Validate product_name
    if(empty(trim($_POST["product"]))){
        $username_err = "Please enter a product name.";
    } else{
        $product = trim($_POST["product"]);
       }
    
    //category
    $selected_val = $_POST['category'];
   
    //Description
    if (empty($_POST["comment"])) {
        $comment_err = "Please Enter Description";
      } else {
        $comment = test_input($_POST["comment"]);
      }
    //image
    $image = $_FILES['image']['tmp_name'];
    $img = file_get_contents($image);
    //date
    if(empty(trim($_POST["date1"]))){
        $date_err = "Please enter a date";
    } else{
        $date1 = trim($_POST["date1"]);
       }
    
    //Price
    if(empty(trim($_POST["price"]))){
        $price_err = "Please enter a price.";
    } else{
        $price = trim($_POST["price"]);
        $price_f=number_format($price, 2);
       }
    $flag=1;
    $bidid=uniqid('bid');
    $productid=uniqid('pro');
   echo $product; 
   echo "<br>";
   echo $price;
   echo "<br>";
   echo $category;
   echo "<br>";
   echo $comment;
   echo "<br>";
   echo $selected_val;
   echo "<br>";
   echo $usern1;
   echo "<br>";
   echo $bidid;
   echo "<br>";
   echo $productid;
   echo "<br>";
   echo var_dump($date1);
   echo "<br>";
   $bdate = explode("-",$date1);
   $bdate = "$bdate[2]-$bdate[1]-$bdate[0]";
   echo $bdate."<br>";
    // Check input errors before inserting in database
    if(empty($product_err)&& empty($price_err)&& empty($category_err)&&empty($comment_err))
    {
        $stmt = $link->prepare("SELECT id FROM user_t WHERE username=? limit 1");
        $stmt->bind_param('s', $usern1);
        $stmt->execute();
        $result = $stmt->get_result();
        $val = $result->fetch_assoc();
        $userid1= $val['id'];
        echo $userid1;
        $sql= "INSERT INTO bid_registration(bid_id,product_id,product_i_price,username,bid_date) VALUES (?,?,?,?,str_to_date(?, '%d-%m-%Y'))";
       if($stmt9 = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt9, "ssdss", $param_bid_id,$param_product_id, $param_product_price,$param_user_name,$param_bid_date);
            $param_bid_id=$bidid;
            $param_product_id= $productid;
            $param_product_price=$price;
            $param_user_name=$usern1;
            $param_bid_date=$bdate;
            if(mysqli_stmt_execute($stmt9)){
                // Redirect to login page
                echo "Bid insert done"."<br>";

                 
                //product insert
                $prosql="INSERT INTO product (product_id,product_name,product_category,product_description,product_cost,product_image) VALUES (?,?,?,?,?,?)";
        
                if($stmt2 = mysqli_prepare($link, $prosql)){
                mysqli_stmt_bind_param($stmt2, "sssssb",$param_product_id, $param_product_name,$param_category,$param_description,$param_cost,$param_my_image);
                $param_product_id=$productid;
                $param_product_name=$product;
                $param_category=$selected_val;
                $param_description=$comment;
                $param_cost=$price;
                $param_my_image=$image;
        
                if(mysqli_stmt_execute($stmt2)){
            // Redirect to login page 
                echo "Product Insert done";
                echo "<br>";
        /*$ = "SELECT product_image from product where product_id={?} limit 1"; 
        $res=mysqli_query($link,"SELECT product_image from product where product_id={$productid}");
        echo var_dump($res);
        if($res==TRUE)
        {
            echo "Yesh";

        }
        else{
            echo "Fuck ";
        }
        echo "<table>";
        echo "<tr>";
        while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
        {
        echo "<td>"; 
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['product_image'] ).'" height="200" width="200"/>';
        echo "<br>";
        echo "</td>";
        } 
        echo "</tr>";
   
        echo "</table>";*/
        }
        } else{
            echo "Product Insert Error";
        }
              
            } else{
                echo "Bid insert error"."<br>";
            }
        }
        else
        {
            echo "Bid stmt not successful";
        }
    
    }
    else
    {
        echo "bye ";
    }
    
}
    

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bid registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="bid.css">
    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


</head>
<body>
<div class="page-header text-center bg-info mt-0 py-3 mb-3">
        <h2>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>,</br> Welcome to our site.</h2>
</div>
    <div class="container">
        <div class="row align-item-center justify-content-center">
            <div class="col-8 border">
                <h2>Create Bid Form</h2>
                <p class="text-muted">Please fill this form to create an bid.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group <?php echo (!empty($product_name_err)) ? 'has-error' : ''; ?>">
                        <label>Product</label>
                        <input type="text" name="product" class="form-control" value="<?php echo $product; ?>">
                        <span class="help-block"><?php echo $product_err; ?></span>
                    </div>  
                    <div class="form-group <?php echo (!empty($category_err)) ? 'has-error' : ''; ?>">
                        <label>category</label>
                        <select id="c" name="category" >
                        <option selected="selected">Select Your option</option>
                        <option value="mobile">Mobile</option>
                        <option value="book">Book</option>
                        <option value="accessories">Accessories</option>
                        <option value="watch">Watch</option>
                        </select>
                        <span class="help-block"><?php echo $category_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($comment_err)) ? 'has-error' : ''; ?>">
                        <label>Description</label>
                        <textarea name="comment" class="form-control" rows="4"><?php echo $comment;?></textarea>
                        <span class="help-block"><?php echo $comment_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($comment_err)) ? 'has-error' : ''; ?>">
                        <label for="file">File Input</label>
                        <input type="file" class="form-control-file" name="image" />
                                
                    </div>
                    <div class="text-muted mb-2">
                        *Uploaded item should be in jpeg/jpg/png format.
                    </div>
                    
                    
                    <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                        <label>Date</label>
                        <input type="date" name="date1" class="form-control"  value="<?php echo $date1; ?>">
                        <span class="help-block"><?php echo $date_err; ?></span>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="form-group <?php echo (!empty($price_name_err)) ? 'has-error' : ''; ?>">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                        <span class="help-block"><?php echo $price_err; ?></span>
                    </div>  
                    <div class="text-muted mb-2">
                        *please enter price in Indian currency.
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary btn-outline-success text-white" value="Submit">
                        <input type="reset" class="btn btn-default btn-outline-danger" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    

    <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    autoclose: true,
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>








</body>
</html>
<?php
}
 else{
header('location:goku.jpg');
}
?>
