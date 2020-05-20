<?php
session_start();
include_once 'config.php';
$result = mysqli_query($link,"SELECT * FROM product");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="process.css" >
</head>
<body>

<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>
<br>
<br>
<br>
<?php
echo "<br>";
if (mysqli_num_rows($result) > 0) {
?>
<table>
  
  <tr>
    <td>Product_id</td>
    <td>Product Name</td>
    <td>Product Category</td>
    <td>Product Description</td>
    <td>Product Price</td>
    <td>Click to Join </td>
  </tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
    <td><?php echo $row["product_id"];?></td>
    <td><?php echo $row["product_name"]; ?></td>
    <td><?php echo $row["product_category"]; ?></td>
    <td><?php echo $row["product_description"]; ?></td>
    <td><?php echo $row["product_cost"]; ?></td>
    <td>
    <form action="participate.php" class="flex-item" method="post"> 
    <input type="submit" class="bb-button" name="submit" value="<?php echo $row["product_id"];?> "></input>
  </form></td>
</tr>
<?php
$i++;
}
?>
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