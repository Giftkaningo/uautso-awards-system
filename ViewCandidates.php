<?php
require_once 'configuration.php';
session_start();
          
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
	}
	}
if( $row['Privileg']=="Adimn"){
 $query = "SELECT * FROM `wagombea` ";
     $result = $conn->query($query);
		$nn=$result->rowCount();
        if ($result->rowCount() < 1) {
           $result = "No records are found.";
          }
//echo $nn;
			if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Edit_cand'])){	
$_SESSION['sysID'] = $_POST['sysID'];
header("location:edit_candidates.php");
  
}
// delete mgombea
		if(isset($_GET['delete'])) {
		    $StudentID = $_GET['delete'];
			if(deleteMember($StudentID)==true){
		        $Status = 'Deleted Successfull mgombea: '. $StudentID;
		    } else {
		        $Status = 'Failed to Delete mgombea: '. $StudentID; 
			}
			}
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Delete'])){	
$sysID = $_POST['sysID'];
 $sql = "DELETE FROM wagombea WHERE sysID = :sysID";
			$stmt = $conn->prepare($sql);
    	    $stmt->bindParam(':sysID', $sysID, PDO::PARAM_INT); 
if($stmt->execute()){
	    		
				echo "yeeeeesss";
		    } else {
		    	
				echo "Nooooooo";
		    	
		    }  
			
			
}	

}
	else{session_destroy();
          header("location:login.php");
	}
	}else{header("location:login.php");
				}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="Uchaguzu UAUT" content="">
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
       
                         <li >
                            <a href="AdminHome.php" id="ggg">HOME</a>
                        </li>
     
                        <li>
                            <a href="registerVoter.php" id="ggg"> REGISTER VOTER</a>
                        </li>
                        <li>
                            <a href="registerCandidates.php" id="ggg"> REGISTER CANDIDATE</a>
                        </li>
						 <li>
                            <a href="ViewUser.php" id="ggg">VOTER TABLE LIST</a>
                        </li>
                        <li>
                            <a href="ViewCandidates.php" id="ggg1">CANDIDATE TABLE LIST</a>
                        </li>
						<li>
                            <a href="passChange.php" id="ggg">CHANGE PASSWORD</a>
                        </li>
						 <li>
                           <a href="Vote.php" id="ggg">VOTE</a>					  
                        </li>
						 <li><form role="form" method="post" enctype="">
                           <input type="submit" class="btn btn-lg btn-info btn-block"   id="ggg" value="LOG OUT" name="logout">
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
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         <?php if(isset($Status)) { 
                                echo '<div class="alert alert-danger">';
                                echo  $Status;           
                                echo '</div>';
                            }
                    ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" >
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th>Photo</th>
											<th>Position</th>
                                            <th>Class</th>
											 <th>Actions</th>
                                        </tr>
                                    </thead>
 <tbody>
                                    <?php 
	                                    if($result) {
                                                foreach ($result as $row) {
										    	$usdata=$row['sysID'];
										    	echo '<tr class'.'="odd gradeX">';
	                                            echo '<td>'.$row['StudentID'].'</td>';
	                                            echo '<td>'.$row['Fname'].'</td>';
	                                            echo '<td>'.$row['Lname'].'</td>';
	                                            echo '<td>'.$row['Gender'].'</td>';
	                                            echo '<td>'.'<img class=" img-responsive img-center"src="'.$row['Photo'].'"></td>';
												 echo '<td>'.$row['position'].'</td>';
	                                            echo '<td>'.$row['Class'].'</td>';
												 echo '<td style="padding-right:0px;"><form role="form"method="post"><input name="sysID" type="hidden" value="'.$usdata.'">';
												echo '<input type="submit" class="btn btn-outline btn-info"  value="Edit Candidates" name="Edit_cand">';
												echo '</form> ';
	                                            //echo '<td style="padding-right:0px;"><form role="form"method="post"><input name="sysID" type="hidden" value="'.$usdata.'">';
												//echo '<input type="submit" class="btn btn-outline btn-danger"  value="Delete Candidates" name="Delete">';
												//echo '</form> ';
	                                        echo '</tr>';
										    }
										} else {
										    	$msg = "no data to display";
										    	//echo date('H:m F jS  Y');
										    }
                                    ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
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
				<div style="float:right;" class="nav navbar-top-links navbar-right">Created by MNMA student 2023<br>rukkia@live.de</div>
               
     </footer>	
</body>

</html>			