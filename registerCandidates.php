<?php 	
require_once 'configuration.php';
		
// Add a addCandidate into database..
function  addCandidate ($studentID, $firstname, $lastname,$gender, $position, $CourseLevel, $image,    $conn){
	try {
		//$dateadded = date('M d Y');
		
		$query = 'INSERT INTO `uchaguzi`.`wagombea` 
	(`sysID`, `Fname`, `Lname`,`Gender`,`Photo`,`position`,`Class`,`StudentID`) VALUES
	 (NULL, :Fname, :Lname, :Gender, :Photo, :position, :Class, :StudentID)';

	 
	$stmt = $conn->prepare($query);

	$registerVoter = array(
		
		'Fname' => $firstname,
		'Lname' => $lastname,
		'Gender' =>$gender,
		'Photo' =>$image,
		'position' => $position,
		'Class' => $CourseLevel,
		'StudentID' => $studentID,
	); 

	    if($stmt->execute($registerVoter)) {
    		return true;
	    } else {
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

//clean inputs
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
		


	if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registerCand'])){
    $uploadOk = 1;
	if (empty($_POST["studentID"])) { $Status = "ERROR please Student ID is required"; $uploadOk = 0;
        }else {$studentID = clean_input($_POST['studentID']);}

		
    if (empty($_POST["firstname"])) { $Status = "ERROR please first Name is required"; $uploadOk = 0;
        }else {$firstname = clean_input($_POST['firstname']);}
    if (empty($_POST["lastname"])) { $Status = "ERROR please Last Name is required"; $uploadOk = 0;
        }else {$lastname = clean_input($_POST['lastname']);}
    if (empty($_POST["gender"])) { $Status = "ERROR please Gender is required"; $uploadOk = 0;
        }else {$gender = clean_input($_POST['gender']);}
    if (empty($_POST["position"])) { $Status = "ERROR please position is required"; $uploadOk = 0;
        }else {$position = clean_input($_POST['position']);}
	if (empty($_POST["CourseLevel"])) { $Status = "ERROR Student Course required"; $uploadOk = 0;
        }else {$CourseLevel = clean_input($_POST['CourseLevel']);}	
    	// image upload code from w3school
        if(isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            if (!file_exists('uploads/')) {
                mkdir('uploads/', 0777, true);
            }
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
             $FileType =  pathinfo($target_file,PATHINFO_EXTENSION);
         

           // Allow certain file formats
            if($FileType != "png" && $FileType != "jpg" && $FileType != "gif"
            && $FileType != "jpeg" ) {
                $Status = "Sorry, only png, jpg, zip & gif files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $Status = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = $target_file;
                    $fileStatus = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                } else {
                    $Status = "Sorry, there was an error uploading your image file.";
                }
            } 
        }

		if ($uploadOk == 1) {
    
    if (isset($_POST['registerCand'])) {
        
                $send = addCandidate ($studentID, $firstname, $lastname, $gender, $position, $CourseLevel, $image,   $conn);
                    if($send == true) {
                        $Status = 'Application is sent successfully';
                       //echo 'oookkkkkkkkkkkkkkkkkkkkkk';
                    } else {
                        $Status = 'There is the error in your form, Application did not sent..';
						   //echo 'Noooooooooooooooooooooooooooo';
                    }
                }   
} else { $Status; }
}	
	

}
	else{
	setcookie(session_name(), '', 100);
	session_unset();
	session_destroy();
	$_SESSION = array();
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
                            <a href="registerVoter.php" id="ggg"> REGISTER VOTER</a>
                        </li>
                        <li>
                            <a href="registerCandidates.php" id="ggg1"> REGISTER CANDIDATE</a>
                        </li>
						 <li>
                            <a href="ViewUser.php" id="ggg">VOTER TABLE LIST</a>
                        </li>
                        <li>
                            <a href="ViewCandidates.php" id="ggg">CANDIDATE TABLE LIST</a>
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
            <div class="col-md-6 col-md-offset-2" style="margin-top:-95px">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register Candidate</h3>
                    </div>
                    <div class="panel-body">
					 <?php if(isset($Status)) { 
                                echo '<div class="alert alert-danger">';
                                echo  $Status;           
                                echo '</div>';
                            }
                    ?>
                        <form role="form" method="post" enctype="multipart/form-data">
                            <fieldset>
                                 <div class="form-group">
                                    <input class="form-control" placeholder="Student ID" name="studentID" type="text" value="">
                                  </div>
				 
								  <div class="form-group">
                                    <input class="form-control" placeholder="First Name" name="firstname" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Last Name" name="lastname" type="text" value="">
                                  </div>
								 <div class="form-group">
                                    <label>Position Candidate</label></br>
                                    <label class="radio-inline">
                                        <input type="radio" name="position" id="optionsRadiosInline2" value="President">President
                                    </label>
                                    
									<label class="radio-inline">
                                        <input type="radio" name="position" id="optionsRadiosInline3" value="VicePresident">Vice President
                                    </label>
									<label class="radio-inline">
                                        <input type="radio" name="position" id="optionsRadiosInline3" value="memberOFparliament">Member Of Parliament
                                    </label>
									<label class="radio-inline">
                                        <input type="radio" name="position" id="optionsRadiosInline3" value="ClassRepresentive">Class Representive
                                    </label>
                                  </div>
								   <div class="form-group">
                                    <select class="form-control" name="CourseLevel">
                                    <?php foreach ($course as $key => $value) {
                                        echo '<option value="'.$value.'">'.$key.'</option>';
                                    }?>
                                    </select>
                                </div>
                                  <div class="form-group">
                                    <label>Gender</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="optionsRadiosInline2" value="Male">Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="optionsRadiosInline3" value="Female">Female
                                    </label>
                                  </div>
								  <div class="alert alert-info">
                               <h5> Below You have to attach Image. The image
								File allowed are .jpg  .png and .gif
                            </div>
								  <div class="form-group">
                                            <label>In put candidate Image here</label>
                                            <input type="file" name="image">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-info btn-block"  value="Register" name="registerCand">
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
				<div style="float:right;" class="nav navbar-top-links navbar-right">Created by MNMA student 2023<br>rukiay@live.de</div>
               
     </footer>	
</body>

</html>