<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Product Listing</title>
        <!--font awesome-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link href="material.css" rel="stylesheet">
        <style>
            button
            {
                float: right;
                border:none; 
                border-radius: 10px; 
                padding: 10px;
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
  

        <div class="container2" style="padding: 20px; height: 1000px;">
            <h2 style="text-align: center;">Product Listing</h2>
            <!--send entered serial number to seaching.php for searching purpose-->
            <form action="searching.php" method="post">
                <!--nbsp is used for better alignment-->
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" placeholder="Search" name="search"/>
                <button style="float: none;"name="submit"><i class="fa fa-search" aria-hidden="true"></i></button><br><br>
            </form>

            <?php
                //if no seller no product
                if ((!file_exists("BikesforSale.txt")) )
                    echo "<p>There are no product posted.</p>\n";
                else 
                {
                    //declare file
                    $Array = file("BikesforSale.txt");
                    
                    //count element inside txt file
                    $count = count($Array);
                    for ($i = 0; $i < $count; ++$i) 
                    {
                        $cur = explode("~", $Array[$i]);//delete "~" between data
                        $key[] = $cur[3]; //let serial number become key
                        $infoArray[] = $cur[4] . "~" . $cur[5]; //let type&description become values
                        
                    }
                    //combine key and values
                    $keyArray = array_combine($key, $infoArray);
                    $no = 1;
                    //for every array
                    foreach($keyArray as $Message) 
                    {
                        //delete "~" between data
                        $cur = explode("~", $Message);
                        echo "<table style='background-color:lightgray;padding:15px;' border='0' width='100%'>\n";
                        echo "<tr>\n";
                        echo "<td width='5%' style='text-align:center;padding:2px;'><span style='font-weight:bold'>" . $no . "</span></td>\n";
                        //display key
                        echo "<td width='70%'><span style='font-weight:bold'> Serial Number:</span> " . htmlentities(key($keyArray)) ."<br />";
                        //display value
                        echo "<span style='font-weight:bold'>Bike Type:</span> " . htmlentities($cur[0]) . "<br />";
                        echo "<span style='font-weight:bold'>Description:</span> " . htmlentities($cur[1]) ."</td>\n";
                        echo "<td width='20%'>";
                        ?>
                        <!--send key to productdetails.php when user clicks on more details-->
                        <form action="productdetails.php" method="post">
                        <input type="hidden" id="detail" name="detail" value="<?php echo htmlentities(key($keyArray)) ?>"/>
                        <button  style="background-color: aliceblue;"onclick="window.location.href='productdetails.php'">More Details</button></td>
                        </form>
                        <?php
                        echo "</tr>\n"; 
                        echo "<tr> </tr>\n";
                        echo "</table>\n\n"; 
                        ++$no;
                        next($keyArray);//next array
                        
                    }
                }    
            ?>
            <br>
            <button onclick="window.location.href='index.php'" >Back to Home <i class="fa fa-home" aria-hidden="true"></i></button>        
        </div>
</body>
</html>