<?php 	
require_once 'configuration.php';

if (isset($_POST['login'])) {

if (empty($_POST['StudentID']) || empty($_POST['password'])) {
$Status = "ID number or Password is invalid";
}else{
// Define $username and $password
$StudentID=$_POST['StudentID'];
$password=$_POST['password'];
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT StudentID, password, Privileg FROM regperson WHERE StudentID='$StudentID' and password='$password'";
$result = $conn->query($query);

if ($result->rowCount() > 0) {

//If the posted values are equal to the database values, then session will be created for the user.

if($result) {
	//echo "yessssssssssss";
foreach ($result as $row){
session_start();// Starting Session
$_SESSION['StudentID'] = $row['StudentID'] ;
if( $row['Privileg']=="Adimn"){
header("location:AdminHome.php");
}else{header("location:Vote.php");}
}



}else{
$Status = "ID number or Password is invalid";}
}
$Status = "ID number or Password is Incorrect";
}

}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="Uchaguzu MNMA" content="">
    <meta name="Rukia Omary" content="">

    <title>UAUT Voting System</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">

 <link href="css/ben.css" rel="stylesheet">
</head>

<body>


	
	
    <div class="container">
	<div class="row" style=" background-color: #fff;">
	<img src="p.jpg" style="margin-left:223px;">
	</div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
				 
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
											 <?php if(isset($Status)) { 
                                echo '<div class="alert alert-danger">';
                                echo  $Status;           
											 echo '</div>';
                            }else{
								echo '<div class="alert alert-info">';
								echo "Enter Your ID number and password to Log in";
							echo '</div>';}
                    ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Student-ID" name="StudentID"  type="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                               <input type="submit" class="btn btn-lg btn-info btn-block" value="login" name="login" >
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br>



<!-- Footer -->
    <footer> 
	
            <hr>  
				Copyright &copy; MNMA student Organisation
				<div style="float:right;" class="nav navbar-top-links navbar-right">Created by MNMA student 2023<br>rukia@live.de</div>
           
     </footer>	
</body>

</html>
