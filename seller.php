<?php
session_start();
//define variable to empty values
$sname = $semail = $sphone = $serialnumber = $des = $manu = $character = $condition = "";
//define error to empty values
$snameErr = $semailErr = $sphoneErr = $serialnumberErr = 
$desErr = $manuErr = $characterErr = $conditionErr = "";

//if form posted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //name validation
    if(empty($_POST["sname"]))
    {
        $snameErr = "Name is required";
    }
    else
    {
        $sname = input_data($_POST["sname"]);
        
    }

    //email validation
    if(empty($_POST["semail"]))
    {
        $semailErr = "Email is required";
    }
    else
    {
        $semail = input_data($_POST["semail"]);
        if(!filter_var($semail, FILTER_VALIDATE_EMAIL))//user@mail.com
        {
            $semailErr = "Invalid email format";
        }
    }

    //phone no validation
    if(empty($_POST["sphone"]))
    {
        $sphoneErr = "Phone no. is required";
    }
    else
    {
        $sphone = input_data($_POST["sphone"]);

        if(!preg_match("/^[0-9]*$/", $sphone))//numeric number
        {
            $sphoneErr = "Only numbers are allowed";
        }

    }

    //serial number validation
    if(empty($_POST["serialnumber"]))
    {
        $serialnumberErr = "Field cannot be empty";
    }
    else
    {
        $serialnumber = input_data($_POST["serialnumber"]);

        if(!preg_match("/^([0-9]{2})(-[0-9]{3})(-[a-z]{3})$/", $serialnumber))//yy-nnn-ccc
        {
            $serialnumberErr = "Follow format yy-nnn-ccc";
        }
    }

    //manufacture validation
    if(empty($_POST["manu"]))
    {
        $manuErr= "Field cannot be empty";
    }
    else
    {
        $manu = input_data($_POST["manu"]);

        if(!preg_match("/^[0-9]*$/", $manu)) //numeric number
        {
            $manuErr = "Only numbers are allowed";
        }
    }

     //characteristics validation
    if(empty($_POST["character"]))
    {
        $characterErr= "Field cannot be empty";
    }
    else
    {
        $character = input_data($_POST["character"]);
    }

    //condition
    if(empty($_POST["condition"]))
    {
        $conditionErr = "Select at least one";
    }
    else
    {
        $condition= input_data($_POST["condition"]);
    }  
}//end of form validation

function input_data($data)
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
     
        <title>BP - SELLER</title>
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
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
        <!--container for top navigation-->
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
  
        <!--container2 for seller form-->
        <div class="container2" style="padding: 20px;">
        <h2>SELL YOUR BIKE </h2>

        <?php
        //declare txt file
        $infoFile = "BikesforSale.txt";

        //if submit 
        if(isset($_POST['submit']))
        {
            //if no error
            if($snameErr==""&&$semailErr==""&&$sphoneErr==""&&$serialnumberErr==""&&
                $manuErr==""&&$characterErr==""&&$conditionErr=="")
            {
                //outputting data
                $sname = stripslashes($_POST["sname"]);
                $semail = stripslashes($_POST["semail"]);
                $sphone= stripslashes($_POST["sphone"]);
                $serialnumber = stripslashes($_POST["serialnumber"]);
                $type = stripslashes($_POST["type"]);
                $des = stripslashes($_POST["des"]);
                $manu = stripslashes($_POST["manu"]);
                $character = stripslashes($_POST["character"]);
                $condition = stripslashes($_POST["condition"]); 
                
                $arr = []; //declare empty array
                $Array = file_get_contents('BikesforSale.txt');//get txt file 
                $pattern = "/^.*$serialnumber.*\$/m";

                if(preg_match_all($pattern, $Array, $matches))
                {
                    //join array
                    $a= implode(" ", $matches[0]);
                    //delete ~ between infos
                    $arr = explode("~", $a);
                }
               

                if(in_array($serialnumber, $arr))
                {
                    echo "<p>The serial number you entered already exists!<br />\n";
                    echo "Your data was not saved.</p>"; 
                    $serialnumber = "";
                }

               else
               {
                //inseting data into txt file with this format
                $info = "$sname~$semail~$sphone~$serialnumber~$type~$des~$manu~$character~$condition\n";
                $infomationFile = fopen($infoFile, "ab");//Append, open or create file for writing
                    if($infomationFile===FALSE)
                        echo "Information cannot be saved. Please try again.\n";
                    else
                    {
                        //file write 
                        fwrite($infomationFile, $info);
                        //file close
                        fclose($infomationFile);
                        
                        //send all data of this session to sellervalidation.php
                        $_SESSION['sname'] = $_POST['sname'];
                        $_SESSION['serialnumber'] = $_POST['serialnumber'];
                        $_SESSION['type'] = $_POST['type'];
                        $_SESSION['des'] = $_POST['des'];
                        $_SESSION['manu'] = $_POST['manu'];
                        $_SESSION['character'] = $_POST['character'];
                        $_SESSION['condition'] = $_POST['condition'];
                        header('location:sellervalidation.php');
                    }
                }
            }
        }

        ?>
            <span class="error" style="float:right;">* Required Field</span><br>

            <!--form start-->
            <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >     

                <h3>Personal Details</h3>
                Name:&nbsp;
                <input  type="text" name="sname" value="<?php echo $sname?>"> 
                <span class="error">* <?php echo $snameErr; ?>  </span>
                <br><br>
                E-mail:&nbsp; <input type="text" name="semail" value="<?php echo $semail?>">
                <span class="error">* <?php echo $semailErr; ?> </span>
                <br><br>
                Phone No:&nbsp; <input type="text" name="sphone" value="<?php echo $sphone?>">
                <span class="error">* <?php echo $sphoneErr; ?> </span> 
                <br><br>

                <h3>Product Basic Information</h3>
                Bike Type:&nbsp; 
                    <select name="type" id="type">
                        <option value="Road Bike">Road Bike</option>
                        <option value="Mountain Bike">Mountain Bike</option>
                        <option value="Touring Bike">Touring Bike</option>
                        <option value="Folding Bike">Folding Bike</option>
                        <option value="Electric Bike">Electric Bike</option>
                        <option value="Others">Others</option>
                    </select><br><br>
                Serial Number:&nbsp; <input type="text" name="serialnumber" value="<?php echo $serialnumber?>">
                <span class="error">* <?php echo $serialnumberErr; ?> </span> 
                <br><br>
                Description:&nbsp;
                 <textarea style="height: 40px;width:200px;"type="text" placeholder="Size,material,etc" name="des" id="des" rows="3" cols="20" 
                 ></textarea>
                <br><br>

                <h3>Product Details</h3>
                Year of Manufacture:&nbsp; <input type="text" name="manu" value="<?php echo $manu?>">
                <span class="error">* <?php echo $manuErr; ?> </span> 
                <br><br>
                Characteristics:&nbsp; <input type="text" name="character" value="<?php echo $character?>">
                <span class="error">* <?php echo $characterErr; ?> </span> 
                <br><br>
                Condition: 
                <input style="width: 30px;"type="radio" name="condition" value="New">New
                <input style="width: 30px;"type="radio" name="condition" value="Used">Used
                <span class="error">* <?php echo $conditionErr; ?> </span> 
                <br><br>
                <input style="float: right;width: 130px;height:50px;border-radius: 25px;"type="submit" name="submit" value="Submit">
            </form>

       

        </div>
 
</body>
</html>