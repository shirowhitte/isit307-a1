<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <title>Product Listing</title>
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
            <a style="width:120px;padding-top: 22px;" href="index.php">HOME</a>
            <a style="width:120px;padding-top: 22px;"href="contact.php">CONTACT</a>

            <div class="logo-image1">
                <img src="image/ww.png" class="img-fluid" height="45px" style="float:right;padding-top: 10px;" >
            </div>
        </div> 
  

        <div class="container2" style="padding: 20px;">
            <h2 style="text-align: center;">Product Listing</h2>
            <form action="searching.php" method="post">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" placeholder="Search"  name="search"/>
                 <button style="float: none;"name="submit"><i class="fa fa-search" aria-hidden="true"></i></button><br><br>
            </form>

        <?php
            $arr=[]; //empty array
            $search = $_POST['search']; //get entered serial number
            $Array = file_get_contents('BikesforSale.txt');//get txt file 
           
            //get all infos about the entered serial number
            $pattern = "/^.*$search.*\$/m";
            
            //if pattern found matches in txt file
            if(preg_match_all($pattern, $Array, $matches))
            {
                //join array
                $a= implode(" ", $matches[0]);
                //delete ~ between infos
                $arr = explode("~", $a);
            }
           
                //if entered serial number is found in array
                if(in_array($_POST['search'], $arr))
                {       
                        //display
                        echo "<table style='background-color:lightgray;padding:15px;' border='0' width='100%'>\n";
                        echo "<tr>\n";
                        //arr[3],[4],[5] are the position of displayed data in an array
                        echo "<td width='70%'><span style='font-weight:bold'> Serial Number:</span> " . htmlentities($arr[3]) ."<br />";
                        echo "<span style='font-weight:bold'>Bike Type:</span> " . htmlentities($arr[4]) . "<br />";
                        echo "<span style='font-weight:bold'>Description:</span> " . htmlentities($arr[5]) ."</td>\n";
                        echo "<td width='20%'>";
                        ?>
                        <!--if user click on more details, send arr[3] to productdetails.php-->
                        <form action="productdetails.php" method="post">
                        <input type="hidden" id="detail" name="detail" value="<?php echo htmlentities($arr[3]) ?>"/>
                        <button  style="background-color: aliceblue;"onclick="window.location.href='productdetails.php'">More Details</button></td>
                        </form>
                        <?php
                        echo "</tr>\n"; 
                        echo "<tr></tr>\n";
                        echo "</table>\n\n"; 
 
                }
                else
                {
                    echo "<p class='listing'>No results found</p>";//if entered serial number not exist
                }
            ?>      

                <br><br>
                <button style="float:left;"onclick="window.location.href='listing.php'" ><i class="fa fa-reply" aria-hidden="true"></i>  Previous Page</button>
                <button onclick="window.location.href='index.php'" >Back to Home <i class="fa fa-home" aria-hidden="true"></i></button>
                
        </div>

</body>
</html>