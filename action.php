<?php 
$usererr="";
require('db_connect.php');
if(isset($_POST["submit"])){

if(!empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['c_no']) && !empty($_POST['email'])) {  
    $user=$_POST['user'];
    $email=$_POST['email'];
    $c_no=$_POST['c_no'];
    $Game=$_POST['Game'];

        if ($Game=='radio1') {
            # code...
            $Game='MM';
        } elseif ($Game=='radio2') {
            # code...
            $Game='NFS';
        }
        elseif($Game=='radio3') {
            $Game='CS';
        }
    $con=mysqli_connect($servername,$username,$password) or die(mysql_error($con));  
    mysqli_select_db($con,$db_name) or die("cannot select DB");  
    $query=mysqli_query($con,"SELECT * FROM dev_data WHERE (email='$email' or mobile='$c_no')" );
    $numrows=mysqli_num_rows($query);  
    if($numrows==0)  
    {
    $sql="INSERT INTO dev_data(username,email,mobile,Game) VALUES('$user','$email','$c_no','$Game')";  
    $result=mysqli_query($con,$sql);  
        if($result){ 
            require('send_email.php'); 
             ?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome!</title>
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/less">
     <link rel="stylesheet" type="text/css" href="CSS/registered_user.css">
     <link href="CSS/bootstrap.css" rel="stylesheet" />
     <link href="CSS/bootstrap-theme.css" rel="stylesheet" />
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
   
     <script src="js/popper.min.js"></script>
     <script src="js/jquery-slim.min.js"></script> 
</head>
<body>
<div class="container-fluid">
 <header>
  <h1 id="header-text">Developers Community</h1>
 </header>
<center><div id="container_1" class="container" style="background-color: #f8f9fa;">
  <h1 id="heading_1">Welcome Gamers!</h1>
  <center><figure id="figure_2">
    <img id="img_4" src="IMAGES/tick.png">
  </figure>
</center>
<center><h1 id="heading_1-1">Thank You For Registering Us</h1></center>
  <figure id="figure_1">
    <img id="img_1" src="IMAGES/mm.jpg">
    <img id="img_2" src="IMAGES/nfs.jpg">
    <img id="img_3" src="IMAGES/CS.jpg">
  </figure>  
  <center><h3 id="heading_3"><strong>A confirmation has already been sent.Check your inbox.</strong></h3></center>
  <center><button id="button_1" class="btn btn-primary"><a href="form.php" id="anchor_1">Back to homepage</a></button></center>
</div>
</center>
</div>
</body>
</html>
<?php
         
    } else {  
    echo "Failure!";  
    }  
  
    }
    elseif ($numrows!=0){
        $row=mysqli_fetch_assoc($query);
        if($row['email']==$email)
        {
            header('location:email_registered.php');
        }
        else
        {
            header('location:num_registered.php');
        }

     } 

} 
}
else {  
    header('location:form.php') ;
}  
?>