<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <title>More Info</title>
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
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
                border:  1px solid grey;
                border-radius: 20px;
                padding: 10px;
                width: 190px;
                height: 20px;
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
            <h2 style = "text-align: center;">Seller information</h2>
        <?php
            
            //empty array       
            $arr=[];
            //get serial number of that clicked product
            $detail = $_POST['detail'];
            //get content of txtfile
            $Array = file_get_contents('BikesforSale.txt');
            //get infos by serial number
            $pattern = "/^.*$detail.*\$/m";
           
            if(preg_match_all($pattern, $Array, $matches))
            {
                $a= implode(" ", $matches[0]);
                $arr = explode("~", $a);
            }
           
                //if serial number is in array
                if(in_array($_POST['detail'], $arr))
                {       
                        //display data AS arr[index]
                        echo "<table style='background-color:lightgray;padding:15px;' border='0' width='100%'>\n";
                        echo "<tr>\n";
                        echo "<td width='70%'><span style='font-weight:bold'>Name: </span> " . htmlentities($arr[0]) ."<br />"."<br />";
                        echo "<span style='font-weight:bold'>Email: </span> " . htmlentities($arr[1]) . "<br />"."<br />";
                        echo "<span style='font-weight:bold'>Phone number:</span> " . htmlentities($arr[2]) ."</td>\n";
                        echo "<td width='20%'>";
                        echo "</tr>\n"; 
                        echo "<tr></tr>\n";
                        echo "</table>\n\n"; 

                        echo "<h2 style='text-align:center;'>Additional Information</h2>";
                        echo "<table style='background-color:lightgray;padding:15px;' border='0' width='100%'>\n";
                        echo "<tr>\n";
                        echo "<td width='100%'>";
                        
                        $ab = [];
                        $count = 0;
                        $hi= file_get_contents('ExpInterest.txt');
                         if(preg_match_all($pattern, $hi, $matches))
                            {
                                $count += substr_count($hi, $detail);
                            }
                         
                    ?>

                       <button onclick="window.location.href='buyer.php'" style="float:right;">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>&nbsp;&nbsp; Favourite (<?php echo $count?>)</button><br> 
                    <?php
                        echo "<span style='font-weight:bold'>Serial Number: </span> " . htmlentities($arr[3]) ."<br />"."<br />";
                        echo "<span style='font-weight:bold'>Bike Type:</span> " . htmlentities($arr[4]) . "<br />"."<br />";
                        echo "<span style='font-weight:bold'>Description: </span> " . htmlentities($arr[5]) . "<br />"."<br />";
                        echo "<span style='font-weight:bold'>Year of manufacture :</span> " . htmlentities($arr[6]) . "<br />"."<br />";
                        echo "<span style='font-weight:bold'>Characteristics:</span> " . htmlentities($arr[7]) . "<br />"."<br />";
                        echo "<span style='font-weight:bold'>Product Condition:</span> " . htmlentities($arr[8]) ."</td>\n";
                        echo "<td width='20%'>";
                        echo "</tr>\n"; 
                        echo "<tr></tr>\n";
                        echo "</table>\n\n";                           
                }    
        ?>    
              
       <br><br>
                <button style="float:left;"onclick="window.location.href='listing.php'" ><i class="fa fa-reply" aria-hidden="true"></i>  Previous Page</button>
                <button onclick="window.location.href='index.php'" >Back to Home <i class="fa fa-home" aria-hidden="true"></i></button>
                
        </div>

</body>
</html>