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
					}
		   }
        
		
		
	}else{header("location:login.php");
				}		
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="Uchaguzu UAUT" content="">
    <meta name="Ebenezery Jimmy" content="">

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
                         <li >
                            <a href="Vote.php" id="ggg1">VOTE</a>
                        </li>
						<li>
                            <a href="passChange.php" id="ggg">CHANGE PASSWORD</a>
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
                  <div class="well" style="margin-top:47">
                                <h4>Vote Note</h4>
                                <p><h3>welcome: your already registed in system</h3></p>
								<p><b>
								<?php echo    'STUDENT ID : '.$row['StudentID'].'<br>';
				                        echo    'NAME    : '.$row['Fname'].' '.$row['Lname'].'<br>';
				                         echo    'Gender  :'.$row['Gender'].'<br>';
				                         echo    'Course  :'.$row['Class'].'<br>';?>
										 </b></p>
                                <p><?php echo '<i>use your id to login in : </i><b>'.$row['StudentID'].'</b><br>';
								          echo '<i>and your password : </i><b>'.'******'.'</b><br>';?>
                            </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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