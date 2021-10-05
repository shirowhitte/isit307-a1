<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <title>Product Overview</title>
 
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
            <h2>SELL YOUR BIKE </h2>
            <hr>
            <!--SESSION IS USED TO GET DATA FROM seller.php-->
            <h3>Your bike has succesfully been listed, <?php echo $_SESSION['sname'] ?>.</h3>
              <hr>
                <!--display and inform seller abt the info overview-->
                <h3>Product Overview</h3>
                Serial Number: 
                <input type="text" name="serialnumber" value="<?php echo $_SESSION['serialnumber']?>" readonly><br><br>
                Bike Type: 
                <input type="text" name="type" value="<?php echo $_SESSION['type']?>" readonly><br><br>
                Description:
                <input style="width: 350px;"type="text" name="des" value="<?php echo $_SESSION['des']?>" readonly><br><br>
                Year of Manufacture: 
                <input type="text" name="manu" value="<?php echo $_SESSION['manu']?>" readonly><br><br>
                Characteristics:
                <input type="text" name="character" value="<?php echo $_SESSION['character']?>" readonly><br><br>
                Condition:
                <input type="text" name="condition" value="<?php echo $_SESSION['condition']?>" readonly><br><br>
                <h4>Information has been saved, thanks for choosing us.</h4>
                <button onclick="window.location.href='index.php'" >Back to home</button>
                <button onclick="window.location.href='seller.php'" >Sell another item</button>
                <button onclick="window.location.href='listing.php'" >View product listing</button>
                
        </div>

</body>
</html>