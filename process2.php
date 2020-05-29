<?php
include_once 'config.php';
$result = mysqli_query($link,"SELECT * FROM product");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>

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
        </div>
    </div>
</div>
<?php
echo "<br>";

if (mysqli_num_rows($result) > 0) {

    $j=3;
    $i=0;
    $k = -2;
    while($row = mysqli_fetch_array($result)) {

        if($i % $j == 0) {?>
        
            <div class="row ">
        <?php } ?>
        


        <div class="col col-12 col-md-4">
            <div class="card mt-5">
                <img src="goku.jpg" alt="" class="card-img-top">
                <div class="card-header"><?php echo $row["product_name"]; ?></div>
            
                <div class="card-body">
                    <!--<div class="card-title"><?php echo $row["product_name"]; ?></div> -->
                    <div class="card-text">
                        <?php echo $row["product_description"]; ?><br>
                        <?php echo $row["product_cost"]; ?><i class="fas fa-rupee-sign ml-2"></i>
                        <br>
                        <label class="mt-3 text-success">click here to participate in bid</label>
                        <form action="participate.php" method="post"> 
                            <input type="submit" class="btn btn-primary btn-outline-success text-white" name="submit" value="<?php echo      $row["product_id"];?> ">
                            </input>
                        </form>
                </div>
                </div>
            </div>
        </div>

        

        <?php
            if($k%$j==0)
            {?>
                </div>
        <?php
            }
        $i++;
        $k++;
    } 
}
else
{
    echo "no result found";
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>