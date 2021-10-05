<?php
	session_start();
//define var and set empty values
	$nameErr = $emailErr = $phoneErr = $serialnoErr = $bidpriceErr ="";
	$name = $email = $phone = $serialno = $bidprice = "";
	
	if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		//name validation, only letters and whitespace
		if (empty($_POST["name"]))
		{ 
			$nameErr ="Name is required";
		}
		else
		{
			$name= test_input ($_POST["name"]);
			if (!preg_match("/^[a-zA-Z-' ]*$/",$name))
			{
				$nameErr="Only letters and white space allowed";
			}
		}
		
		//email validation
		if (empty($_POST["email"]))
		{
			$emailErr="Email is required";			
		}
		else 
		{
			$email= test_input($_POST["email"]);
			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$emailErr="Invalid email format";
			}
		}
		//phone validation 
		if (empty($_POST["phone"]))
		{
			$phoneErr="Phone number is required";
		}
		else 
		{
			$phone=test_input ($_POST["phone"]);
			if(!preg_match("/^[0-9]*$/", $phone)) 
			{
				$phoneErr="Only numbers are allowed";
			}
		}
		//serial number validation 
	 
	    if(empty($_POST["serialno"]))
	    {
	        $serialnoErr = "Field cannot be empty";
	    }
	    else
	    {
	        $serialno = test_input($_POST["serialno"]);

	        if(!preg_match("/^([0-9]{2})(-[0-9]{3})(-[a-z]{3})$/", $serialno))//yy-nnn-ccc
	        {
	            $serialnoErr = "Follow format yy-nnn-ccc";
	        }
	    }
		//bid price validation
		if (empty($_POST["bidprice"]))
		{
			$bidpriceErr= "Field cannot be empty";
		}
		else 
		{
			$bidprice=test_input($_POST["bidprice"]);
			
			if (!preg_match("/^[0-9]+(\.[0-9]{2})?$/",$bidprice))
			{
				$bidpriceErr= "Price can only have 2 numbers after decimals";
			}
		}
		
		
	}// end of form validation	
		
	
	
	function test_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	
	?> 
	 
				 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <title>BP - BUYER</title>
 
        <link href="material.css" rel="stylesheet">
	        <style>
	        input, textarea
	        {
	            border-radius: 15px;
	            border: 1px solid lightgrey;
	            padding: 5px;
	            color:black;
	            width: 150px;
	            height: 20px;
	        }
	        select
	        {
	            border-radius: 20px;
	            border: 1px solid lightgrey;
	            padding: 5px;
	            color:black;
	            width: 150px;
	            height: 30px;
	        }
	    </style>
    </head>
    <body>   
        <div class="topnav">

            <a href="index.php" class="navbar-brand" href="/">
                <div class="logo-image">
                    <img src="image/logo.png" class="img-fluid" height="50px"/>
                </div>
            </a>
            <a  style="width:120px;padding-top: 22px;" href="index.php">HOME</a>
            <a  style="width:120px;padding-top: 22px;"href="contact.php">CONTACT</a>
       

            <div class="logo-image1">
                <img src="image/ww.png" class="img-fluid" height="45px" style="float:right;padding-top: 10px;" >
            </div>
        </div>
  

 	   		<!--container 2 for buyer form-->
			<div class="container2" style="padding: 20px;height: 600px;">
				 
				 <h2> Buyer Interest Form</h2>
		         <?php
		         //declare txt file
		         $infoFile = "ExpInterest.txt";

		         //if submit 
		         if(isset($_POST['submit']))
		         {
		             //if no error
		             if($nameErr==""&&$emailErr==""&&$phoneErr==""&&$serialnoErr==""&&
		                 $bidpriceErr=="")
		             {
		                 //outputting data
		                 $name = stripslashes($_POST["name"]);
		                 $email = stripslashes($_POST["email"]);
		                 $phone= stripslashes($_POST["phone"]);
		                 $serialno = stripslashes($_POST["serialno"]);
		                 $bidprice=stripslashes($_POST["bidprice"]);
               
		                 //inseting data into txt file with this format
		                 $info = "$name~$email~$phone~$serialno~$bidprice\n";
		                 $infomationFile = fopen($infoFile, "ab");//Append, open or create file for writing
		                 if($infomationFile===FALSE)
		                     echo "Information cannot be saved. Please try again.\n";
		                 else
		                 {
		                     //file write 
		                     fwrite($infomationFile, $info);
		                     //file close
		                     fclose($infomationFile);
                    
		                     //send all data of this session to buyervalidation.php
		                     $_SESSION['name'] = $_POST['name'];
							 $_SESSION['email'] = $_POST['email'];
							 $_SESSION['phone'] = $_POST['phone'];
		                     $_SESSION['serialno'] = $_POST['serialno'];
							 $_SESSION['bidprice'] = $_POST['bidprice'];

		                     header('location:buyervalidation.php');
		                 }
		             }
		         }

		         ?>
				 
				 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
					 <br>
					 
		             <span class="error" style="float:right; color:red" >* Required Field</span> <br>
						<h3>Your Personal Details</h3> 
 					   Name:&nbsp; <input type="text" name="name" value="<?php echo $name;?>">
 					   <span class="error" style="color:red">* <?php echo $nameErr;?></span>
					   <br><br>
					   E-mail:&nbsp; <input type="text" name="email" value="<?php echo $email;?>">
					   <span class="error" style="color:red">*  <?php echo $emailErr;?></span>
					   <br><br>
					   Telephone:&nbsp; <input type="integer" name="phone" value="<?php echo $phone;?>">
					   <span class="error" style="color:red">*<?php echo $phoneErr;?></span>
					   <br><br>
					   <h3>Product Details</h3>
					   Serial Number:&nbsp;<input type="text" name="serialno" value="<?php echo $serialno;?>">
					   <span class="error" style="color:red">*<?php echo $serialnoErr;?></span>
					   <br><br>
					   Bid Price:&nbsp; <input type="text" name="bidprice" value="<?php echo $bidprice;?>">
					   <span class="error" style="color:red">*<?php echo $bidpriceErr;?></span>
					   
					   <br><br>
					   <input style="float: right;width: 130px;height:50px;border-radius: 25px;"type="submit" name="submit" value="Submit">
					 </form>
				
					   
			</p>
                
        </div>

      


    
   
</body>
</html>