<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bike Passion | Home</title>
        <!--Font Awesome-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <!--load .css-->
        <link href="material.css" rel="stylesheet">
        <style>
            button
            {
                /*another design for button in this page*/
                margin: 0 auto;
                border:none; 
                border-radius: 10px; 
                padding: 30px;
                font-family: Times New Roman, Times, serif;
            }
        </style>
    </head>
    <body>   
        <!--top navigation-->
        <div class="topnav">
            <!--Bike Passion logo-->
            <a href="index.php" class="navbar-brand" href="/">
                <div class="logo-image">
                    <img src="image/logo.png" class="img-fluid" height="50px"/>
                </div>
            </a>
            <!--hyperlink of home-->
            <a style="width:120px;padding-top: 22px;" href="index.php">HOME</a>
            <!--hyperlink of contact us -->
            <a style="width:120px;padding-top: 22px;"href="contact.php">CONTACT</a>
            <!--Bike Passion logo-->
            <div class="logo-image1">
                <img src="image/ww.png" class="img-fluid" height="45px" style="float:right;padding-top: 10px;" >
            </div>
        </div>

        <!--1st container for UI design-->
        <div class="container">
            <img class="mySlides" src="image/1.png" style="width:105%">
            <img class="mySlides" src="image/2.png" style="width:105%">
            <img class="mySlides" src="image/3.png" style="width:105%">
            <img class="mySlides" src="image/4.png" style="width:105%">
        </div>
        <!--2nd container for user identity-->
        <div class="container1"><br>
              <h2 style="padding-top: 45px; text-align: center;color:white;font-family: Times New Roman, Times, serif;">WHO ARE YOU?</h2><BR><BR><BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button  onclick="window.location.href='seller.php'" ><b style="font-size: 18px;"> SELLER  </b><i style="font-size: 24px"class="fa fa-money" aria-hidden="true"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <button onclick="window.location.href='listing.php'" ><b style="font-size: 18px;">BUYER </b><i style="font-size: 24px;"class="fa fa-shopping-cart" aria-hidden="true"></i></button><br><br><br><br><br><br>
               <button style="border-radius: 15px;background-color: ghostwhite;display:block;margin-right: 80px;padding:15px;"onclick="window.location.href='buyer.php'" ><b>Express Interest Here &nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></i></b></button>

        </div>


<script>
//slideshow for container 1 
var myIndex = 0;
carousel();

function carousel() 
{
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) 
    {
        x[i].style.display = "none";  
    }
    myIndex++;

    if (myIndex > x.length) 
    {
        myIndex = 1
    }    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 4000); // Change image every 4 seconds
}
   
</script>

    
   
</body>
</html>