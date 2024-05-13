<?php 	
require_once 'configuration.php';
// Updating user
function  editVoter ($studentID, $firstname, $lastname,$gender, $CourseLevel,$id2, $conn){
	try {
	$sql = "UPDATE `regperson` SET
	 `StudentID`=:StudentID, 
	 `Fname`=:Fname, 
	 `Lname`=:Lname, 
	 `Gender`=:Gender, 
	 `Class`=:Class
	  WHERE 
	 regID = :regID";

	 $stmt7 = $conn->prepare($sql);

		$registerVoter = array(
		'StudentID' => $studentID,
		'Fname' => $firstname,
		'Lname' => $lastname,
		'Gender' =>$gender,
		'Class' => $CourseLevel,
		'regID' =>$id2
	); 

		$stmt7->execute($registerVoter);

	    if($stmt7->rowCount()) {
    		//echo $brokername.' Data has been updated';
    		return true;
	    } else {
	    	//echo $brokername.' Data Fail to Update';
	    	return false;
	    }
	
} catch (PDOException $e) {
	echo 'Error: ' .$e->getMessage();
}
}
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
	
	if(isset($_SESSION['sID2'])){
		$id2 = $_SESSION['sID2'];

 $query1 = "SELECT * FROM `regperson` WHERE regID = $id2";
     $result1 = $conn->query($query1);
		
        if ($result1->rowCount() < 0) {
           $result = "No records are found.";
          }
		  if(isset($result1)) {
                    foreach ($result1 as $row1) {
                        $UserID1 =$row1['StudentID'];
                        $firstname1= $row1['Fname'];
                        $lastname1 = $row1['Lname'];
                        $gender1 = $row1['Gender'];
                         $Class1 = $row1['Class'];
                    }
               }
		  
	}
//clean inputs
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

		
		
		
		
		
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
    $uploadOk = 1;
	if (empty($_POST["studentID"])) { $Status = "ERROR please Student ID is required"; $uploadOk = 0;
        }else {$studentID = clean_input($_POST['studentID']);}

		
    if (empty($_POST["firstname"])) { $Status = "ERROR please first Name is required"; $uploadOk = 0;
        }else {$firstname = clean_input($_POST['firstname']);}
    if (empty($_POST["lastname"])) { $Status = "ERROR please Last Name is required"; $uploadOk = 0;
        }else {$lastname = clean_input($_POST['lastname']);}
    if (empty($_POST["gender"])) { $Status = "ERROR please Gender is required"; $uploadOk = 0;
        }else {$gender = clean_input($_POST['gender']);}
    if (empty($_POST["CourseLevel"])) { $Status = "ERROR please Gender is required"; $uploadOk = 0;
        }else {$CourseLevel = clean_input($_POST['CourseLevel']);}


		if ($uploadOk == 1) {
    
    if (isset($_POST['register'])) {
        
                $send = editVoter ($studentID, $firstname, $lastname, $gender, $CourseLevel,$id2,   $conn);
                    if($send == true) {
                       header("location:ViewUser.php");
                    } else {
                        $Status = 'There is the error in your form, Application did not sent..';
						   //echo 'Noooooooooooooooooooooooooooo';
                    }
                }   
} else {$Status; }
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

    <meta name="Uchaguzu MNMA" content="">
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
                            <a href="registerVoter.php" id="ggg1"> EDIT VOTER</a>
                        </li>
                        <li>
                            <a href="registerCandidates.php" id="ggg"> REGISTER CANDIDATE</a>
                        </li>
						 <li>
                            <a href="ViewUser.php" id="ggg">VOTER TABLE LIST</a>
                        </li>
                        <li>
                            <a href="ViewCandidates.php" id="ggg">CANDIDATE TABLE LIST</a>
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
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Voter Regisration</h3>
                    </div>
                    <div class="panel-body">
					<?php if(isset($Status)) { 
                                echo '<div class="alert alert-danger">';
                                echo  $Status;           
                                echo '</div>';
                            }
                    ?>
                        <form role="form" method="post">
                            <fieldset> 
                
				 <div class="form-group">
                                    <input class="form-control" placeholder="Student ID" name="studentID" type="text" value="<?php echo $UserID1; ?>">
                                  </div>
								  <div class="form-group">
                                    <input class="form-control" placeholder="First Name" name="firstname" type="text" value="<?php echo $firstname1; ?>">
                                </div>
                                
								<div class="form-group">
                                    <input class="form-control" placeholder="Last Name" name="lastname" type="text" value="<?php echo $lastname1; ?>">
                                  </div>
								 
                                  <div class="form-group">
                                    <label>Gender</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="optionsRadiosInline2" <?php if($gender1 == 'Male') {echo 'checked';} ?> value="Male">Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"  id="optionsRadiosInline3" value="Female" <?php if($gender1 == 'Female') {echo 'checked';} ?>>Female
                                    </label>
                                  </div>
								    <div class="form-group">
                                    <select class="form-control" name="CourseLevel">
                                    <?php echo '<option value="'.$Class1.'">'.$Class1.'</option>';
									foreach ($course as $key => $value) {
                                        echo '<option value="'.$value.'">'.$key.'</option>';
                                    }
                                        
                                        ?>
                                    </select>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-info btn-block"  value="Edit User" name="register">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<hr>
<!-- Footer -->
    <footer>
              
				Copyright &copy; MNMA student Organisation
				<div style="float:right;" class="nav navbar-top-links navbar-right">Created by MNMA student 2023<br>rukia@live.de</div>
               
     </footer>	
</body>

</html>