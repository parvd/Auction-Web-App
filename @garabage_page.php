<?php 
	// Setting up connection with database Geeks 
	
	
	// Check connection 
	include_once "config.php";
	// query to fetch Username and Password from 
	// the table geek 
	$query = "SELECT username FROM participation WHERE bid_id = 'bid5ec2d8e567046'  "; 
	
	// Execute the query and store the result set 
	$result = mysqli_query($link, $query); 
	
	if ($result) 
	{ 
		// it return number of rows in the table. 
		$row1 = mysqli_num_rows($result); 
		echo $row1."<br>";
		if ($row1) 
			{ 
        //echo "dd";
        //echo mysql_fetch_array($result);
        printf("Number of row in the table : " . $row1."<br>"); 
        $i = 1;

      while($row = mysqli_fetch_array($result)) {
	  ${"r" . $i . "1"} = $row['username'];
	  if($row['username']===$usern1){echo "Already Registered";}
      echo $row['username']."<br>";
      $i++;
      }
			} 
		// close the result. 
		mysqli_free_result($result); 
	} 

	// Connection close 
	mysqli_close($link); 
?> 
