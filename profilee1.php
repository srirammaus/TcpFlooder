    <?php
session_start();
//include '/main/loginstu.php';




 
$con = mysqli_connect("localhost", "root", "Ayush@123", "info") or  die("connection failed".mysqli_errno($con));
//$fullname= $_POST['fullname'];
$email=  $_GET['user'];
$pass=  $_GET['pass'];//USERNAME; $_POST['user'];
//$password=$_POST['pass'];
//$contact=$_POST['contact'];
//$dob=$_POST['dob'];
//$class=$_POST['class'];
//$school=$_POST['school'];

/*--------------------------
Here i've changed lot

in mysql workbench..i created single table (i.e: student)
it contains key,name,email,password,class,school. i didn't add dob and contact.bcaz i dont spend much time it.



--------------*/
//$key=1;
$profile_data= "SELECT * FROM info.student WHERE email= '$email' AND password='$pass';";
//"insert into student (fullname,email,password,class,school) values ('$fullname','$email','$password','$class','$school')";
//INSERT INTO `iinfo2`.`student` (`fullname`, `email`, `password`, `class`, `school`) VALUES ('ss', 'ss@gmail.com', 'maus', '6', '6');
$profile_data1 = mysqli_query($con, $profile_data) or die(mysqli_error($con));

$row = mysqli_num_rows($profile_data1);
if($row==1){
    $printer=mysqli_fetch_assoc($profile_data1);
 
}else{
    echo "prom=blem raised";

}
?>

<html>
  <head>
      
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Dashboard</title>
      <style>
*, *::before, *::after {
   box-sizing: border-box;
}

body {
   font-family: sans-serif;
   font-size: 1em;
   color: #333;
}

h1 {
  font-size: 1.4em;
}

em {
   font-style: normal;
}

a {
   text-decoration: none;
   color: inherit;
} 

/* Layout */
.s-layout {
   display: flex;
   width: 100%;
   min-height: 100vh;
}



/* Sidebar */
.s-sidebar__trigger {
   z-index: 2;
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 4em;
   background: #8085e1;
}

.s-sidebar__trigger > i {
   display: inline-block;
   margin: 1.5em 0 0 1.5em;
   color: #fff;
}

.s-sidebar__nav {
   position: fixed;
   top: 0;
   left: -15em;
   overflow: hidden;
   transition: all .3s ease-in;
   width: 15em;
   height: 100%;
   background: #8085e1;
   color: rgba(255, 255, 255, 1);
}

.s-sidebar__nav:hover,
.s-sidebar__nav:focus,
.s-sidebar__trigger:focus + .s-sidebar__nav,
.s-sidebar__trigger:hover + .s-sidebar__nav {
   left: 0;
}

.s-sidebar__nav ul {
   position: absolute;
   top: 4em;
   left: 0;
   margin: 0;
   padding: 0;
   width: 15em;
}

.s-sidebar__nav ul li {
   width: 100%;
}

.s-sidebar__nav-link {
   position: relative;
   display: inline-block;
   width: 100%;
   height: 4em;
}

.s-sidebar__nav-link em {
   position: absolute;
   top: 50%;
   left: 4em;
   transform: translateY(-50%);
}

.s-sidebar__nav-link:hover {
    background: white;
   color:#8085e1;
}



.s-sidebar__nav-link > i {
   position: absolute;
   top: 0;
   left: 0;
   display: inline-block;
   width: 4em;
   height: 4em;
}

.s-sidebar__nav-link > i::before {
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
}
li{
  margin: 10px 0;
}
/* Mobile First */@media (max-width: 600px) {
#oo{margin-left:15%;
}  }
@media (min-width: 601px) {
   .s-layout__content {
      margin-left: 4em;
   }
   
   /* Sidebar */
   .s-sidebar__trigger {
      width: 4em;
   }
   
   .s-sidebar__nav {
      width: 4em;
      left: 0;
   }
   
   .s-sidebar__nav:hover,
   .s-sidebar__nav:focus,
   .s-sidebar__trigger:hover + .s-sidebar__nav,
   .s-sidebar__trigger:focus + .s-sidebar__nav {
      width: 15em;
   }
}

@media (min-width: 601px) {
   .s-layout__content {
      margin-left: 37em;
      justify-content: center;
    align-content: center;
    align-content: center;
   }
   
   /* Sidebar */
   .s-sidebar__trigger {
      display: none
   }
   
   .s-sidebar__nav {
      width: 15em;
   }
   
   .s-sidebar__nav ul {
      top: 1.3em;
   }
}

s-layout__content{
    width:100%;
    
}
      </style>
  </head>
  <body>
      
    <div class="s-layout">
<!-- Sidebar -->
<div class="s-layout__sidebar">
  <a class="s-sidebar__trigger" href="#0">
     <i class="fa fa-bars"></i>
  </a>

  <nav class="s-sidebar__nav">
     <ul>
        <li>
           <a class="s-sidebar__nav-link" href="#0">
              <i class="fa fa-home"></i><em>Home</em>
           </a>
        </li>
        <li>
           <a class="s-sidebar__nav-link" href="#0">
             <i class="fa fa-book"></i><em>Notes</em>
           </a>
        </li>
        <li>
           <a class="s-sidebar__nav-link" href="#0">
              <i class="fa fa-camera"></i><em>Video lessons</em>
           </a>
        </li>
        <li>
           <a class="s-sidebar__nav-link" href="#0">
              <i class="fa fa-pencil-square-o"></i><em>Mocks</em>
           </a>
        </li>
        <li>
           <a class="s-sidebar__nav-link" href="#0">
              <i class="fa fa-cart-plus"></i><em>Cart</em>
           </a>
        </li>
        <li>
           <a class="s-sidebar__nav-link active" href="#0" style="bottom:0;">
              <i class="fa fa-user"></i><em>Profile</em>
           </a>
        </li>
     </ul>
  </nav>
</div>

<!-- Content -->

<main class="s-layout__content" id="oo">
    <div style="margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="boyhat.png" alt="Avatar" style="width:150px;">
    </div><?php echo ($printer['fullname']); ?>
            <br>
            <h1 style="margin-top:30px;color:#8085e1">Personal Details</h1>
 

    <ul style="list-style-type:none; font-size: 15px">
         <li>
           <a  href="#0" style="bottom:0;">
               <i class="fa fa-envelope" style=" color:#8085e1"></i><em>&nbsp;&nbsp;&nbsp;<?php echo ($printer['email']); ?></em>
           </a>
        </li>
        <li>
           <a  href="#0" style="bottom:0;">
              <i class="fa fa-calendar" style=" color:#8085e1"></i><em>&nbsp;&nbsp;&nbsp;<?php echo ($printer['email']); ?></em>
           </a>
        </li>
        <li>
           <a  href="#0" style="bottom:0;">
              <i class="fa fa-address-book" style=" color:#8085e1"></i><em>&nbsp;&nbsp;&nbsp;<?php echo ($printer['email']); ?></em>
           </a>
        </li>
        <li>
           <a href="#0" style="bottom:0;">
              <i class="fa fa-phone" style=" color:#8085e1"></i><em>&nbsp;&nbsp;&nbsp;<?php  echo ($printer['email']); ?></em>
           </a>
        </li>
        <li>
           <a  href="#0" style="bottom:0;">
              <i class="fa fa-graduation-cap" style=" color:#8085e1"></i><em>&nbsp;&nbsp;&nbsp;<?php echo ($printer['school']); ?></em>
           </a>
        </li>
    </ul>
           
            <h1 style="margin-top:30px;color:#8085e1">Support details</h1>
 

    <ul style="list-style-type:none;">
         <li>
           <a  href="#0" style="bottom:0;">
              <i class="fa fa-envelope" style=" color:#8085e1"></i><em>&nbsp;&nbsp;&nbsp;topperformula.edu@gmail.com</em>
           </a>
        </li>
       
        <li>
           <a href="#0" style="bottom:0;">
              <i class="fa fa-phone" style=" color:#8085e1"></i><em>&nbsp;&nbsp;&nbsp;+91 9818904918</em>
           </a>
        </li>

    </ul>


            <h1 style="margin-top:30px;color:#8085e1">Account</h1>
            <ul style="list-style-type:none;">
                <li><a  href="logout.php" style="bottom:0;">
              <i class="fa fa-sign-out" style=" color:#8085e1"></i><em>&nbsp;&nbsp;&nbsp;Log Out</em>
                    </a></li></ul>
</main>
</div>
  
  </body>
    </html>
