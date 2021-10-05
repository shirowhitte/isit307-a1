<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <title>Buyer Overview</title>
 
        <link href="material.css" rel="stylesheet">
        <style>
            button
            {
                border:none; 
                border-radius: 10px; 
                padding: 10px;
                float: right;
                font-family: Times New Roman, Times, serif;
            }
            input
            {
                border:  none;
                background-color: ghostwhite;
                color: #222222;
                font-family:Didot, sans-serif;
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
  

        <div class="container2" style="padding: 20px;">
            
           
            <!--SESSION IS USED TO GET DATA FROM buyer.php-->
            <h3>Thank you, <?php echo $_SESSION['name'] ?>.</h3>
              <hr>
                <!--display and inform seller abt the info overview-->
                <h3>Submission Overview</h3>
				Name:
				<input type="text" name="name" value="<?php echo $_SESSION['name']?>" readonly><br><br>
				Email:
				<input type="text" name="email" value="<?php echo $_SESSION['email']?>" readonly><br><br>
                Serial Number: 
                <input type="text" name="serialno" value="<?php echo $_SESSION['serialno']?>" readonly><br><br>
				Bid price:
				<input type="text" name="bidprice" value="<?php echo $_SESSION['bidprice']?>" readonly><br><br>
                
                <h4>Information has been saved, thanks for choosing us.</h4>
                <button onclick="window.location.href='index.php'" >Back to home</button>
                <button onclick="window.location.href='buyer.php'" >Buy another item</button>
                <button onclick="window.location.href='listing.php'" >View product listing</button>
                
        </div>

</body>
</html>