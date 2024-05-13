<?php 	
require_once 'configuration.php';
session_start();
    //$_SESSION['StudentID']=15011016;      
	if(isset($_SESSION['StudentID'])){
		  $id = $_SESSION['StudentID'];
		   $view = "SELECT * FROM `regperson` WHERE StudentID = $id ";
		   $view1 = $conn->query($view);
		   if(isset($view1)) {
                    foreach ($view1 as $row) {
                        $regID =$row['regID'];
                        $StudentID= $row['StudentID'];
                        $Fname = $row['Fname'];
                        $Lname= $row['Lname'];
                        $Gender =$row['Gender'];
                        $Class= $row['Class'];
                        $Privileg= $row['Privileg'];
                        $vote= $row['vote'];
						$result= $row['result'];
						$passwordDB= $row['password'];
					}
		   }

$password = $password2 =$Oldpassword='';	   
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePass'])){
    $uploadOk = 1;   
	
	if (empty($_POST["password"])) { $LoginStatus = "Empty field!! Password is required"; $uploadOk = 0;
    }else {$password = $_POST['password'];}
     if (empty($_POST["password2"])) { $LoginStatus = "Empty field!! Password is required"; $uploadOk = 0;
      }else {$password2 = $_POST['password2'];}
	if (empty($_POST["Oldpassword"])) { $LoginStatus = "Empty field!! Password is required"; $uploadOk = 0;
    }else{$Oldpassword = $_POST['Oldpassword'];}
    
	if ($Oldpassword!=$passwordDB) {
	 $LoginStatus ="Old Password is not correct match with Your system password "; $uploadOk = 0;
	}
    if($password !== $password2){
        $LoginStatus = "Your new Password should match.. Try Again"; $uploadOk = 0;
    } 
	if (strlen($password) <= 5) {
	 $LoginStatus ="Your password must contain at least 6 or more characters"; $uploadOk = 0;
	}
		   
		

	if ($uploadOk == 1) {
	
 
	 $user = "UPDATE `regperson` SET password = :password  WHERE regID = :regID";
	 $stmtuser = $conn->prepare($user);
    $stmtuser->bindParam(':regID', $regID, PDO::PARAM_INT);
	$stmtuser->bindParam(':password', $password2 , PDO::PARAM_INT);
	    		if($stmtuser->execute()){
					$LoginStatus2 = "Your password changed succesful";
		    } else {
		    	//$LoginStatus = "Error in your form Try Again.!";
		    	
		    } 	
	}
}	   
		   
		   
	}else{header("location:login.php");
				}		
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="Voting MNMA" content="">
    <meta name="Rukia Omary" content="">

    <title>MNMA Voting System</title>
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
       <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               <img class="img-circle img-responsive img-center" id="picha"src="index.png"/>
			   <a class="navbar-brand" href="">MNMA Voting System</a>
            </div>
                <?php echo '<ul class="nav navbar-top-links navbar-right"><li style="float:right; color:#fff; font-weight:bold;">'.$Fname.' '.$Lname.'</li></ul>' ?> 


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                         <li>
                            <a href="Vote.php" id="ggg">VOTE</a>
                        </li>
						<li>
                            <a href="passChange.php" id="ggg1">CHANGE PASSWORD</a>
                        </li>
                       
						 <li><form role="form" method="post" enctype="">
                           <input type="submit" class="btn btn-lg btn-info btn-block"  id="ggg" value="LOG OUT" name="logout">
						   </form>
                        </li>
                       
 
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

    <div id="page-wrapper">
            <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Change your password</h3>
                    </div>
                    <div class="panel-body">
					<?php if(isset($LoginStatus)) { 
                                echo '<div class="alert alert-danger">';
                                echo  $LoginStatus;           
                                echo '</div>';
					       }else if(isset($LoginStatus2)) { 
                                echo '<div class="alert alert-success">';
                                echo  $LoginStatus2;           
                                echo '</div>';
                            }else{
								echo '<div class="alert alert-info">';
								echo "1.Enter your old password<br>2.Enter new password and Re-type it<br>3.Your new password must contain at least 6 or more characters";
								echo '</div>';}
                    ?>
                               
                                   <form role="form" method="post">
                            <fieldset>
                
				             <div class="form-group">
                                    <input class="form-control" placeholder="Enter Old password" name="Oldpassword" type="text" value="">
                                  </div>
								  <div class="form-group">
                                    <input class="form-control" placeholder="Enter new password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Re-type new password" name="password2" type="password" value="">
                                  </div>
								 
                                 
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-info btn-block"  value="Change Password" name="changePass">
                            </fieldset>
                        </form>
                     </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			</div>
            <!-- /.row -->	
</div>
<hr>
<!-- Footer -->
    <footer>
              
				Copyright &copy; MNMA student Organisation
				<div style="float:right;" class="nav navbar-top-links navbar-right">Created by MNMA student 2023<br>rukia@live.de</div>
               
     </footer>			
</body>

</html>