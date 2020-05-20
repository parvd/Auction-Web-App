<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$product =$price= $category = $comment =$selected_val ="";
$product_err =$price_err= $category_err = $comment_err  = "";
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
        $sql= "INSERT INTO bid_registration(bid_id,product_id,product_i_price,username) VALUES (?,?,?,?)";
       if($stmt9 = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt9, "ssds", $param_bid_id,$param_product_id, $param_product_price,$param_user_name);
            $param_bid_id=$bidid;
            $param_product_id= $productid;
            $param_product_price=$price;
            $param_user_name=$usern1;
            
            if(mysqli_stmt_execute($stmt9)){
                // Redirect to login page
                echo "Bid insert done"."<br>";

            } else{
                echo "Bid insert error"."<br>";
            }
        }
        else
        {
            echo "Bid stmt not successful";
        }
    
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
        //$ = "SELECT product_image from product where product_id={?} limit 1"; 
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
   
        echo "</table>";
        }
        } else{
            echo "Product Insert Error";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="bid.css">
</head>
<body>
<div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
</div>
    <div class="wrapper">
        <h2>Create Bid Form</h2>
        <p>Please fill this form to create an bid.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?php echo (!empty($product_name_err)) ? 'has-error' : ''; ?>">
                <label>Product</label>
                <input type="text" name="product" class="form-control" value="<?php echo $product; ?>">
                <span class="help-block"><?php echo $product_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($category_err)) ? 'has-error' : ''; ?>">
                <label>category</label>
                <select id="c" name="category">
                <option value="mobile">Mobile</option>
                <option value="book">Book</option>
                <option value="accessories">Accessories</option>
                <option value="watch">Watch</option>
                </select>
                <span class="help-block"><?php echo $category_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($comment_err)) ? 'has-error' : ''; ?>">
                <label>Description</label>
                <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
                <span class="help-block"><?php echo $comment_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($comment_err)) ? 'has-error' : ''; ?>">
            <input type="file" name="image" />
            <button>Upload</button>        
            </div>
            <div class="form-group <?php echo (!empty($price_name_err)) ? 'has-error' : ''; ?>">
                <label>Price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                <span class="help-block"><?php echo $price_err; ?></span>
            </div>  
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>
<?php
}
 else{
header('location:goku.jpg');
}
?>
