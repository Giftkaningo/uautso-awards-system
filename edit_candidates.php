<?php 	
require_once 'configuration.php';
// Updating user
function  EditCandidate ($studentID, $firstname, $lastname, $gender, $position, $CourseLevel, $image,$id2, $conn){
	try {
	$sql = "UPDATE `wagombea` SET
	 `StudentID`=:StudentID, 
	 `Fname`=:Fname, 
	 `Lname`=:Lname, 
	 `Gender`=:Gender,
     `Photo`=:Photo, 
	 `position`=:position,	 
	 `Class`=:Class
	  WHERE 
	 sysID = :sysID";

	 $stmt7 = $conn->prepare($sql);

		$registerVoter = array(
		'StudentID' => $studentID,
		'Fname' => $firstname,
		'Lname' => $lastname,
		'Gender' =>$gender,
		'Photo' =>$image,
		'position' => $position,
		'Class' => $CourseLevel,
		'sysID' =>$id2
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
		if(isset($_SESSION['sysID'])){
		$id2 = $_SESSION['sysID'];

 $query1 = "SELECT * FROM `wagombea` WHERE sysID = $id2";
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
						$Photo1 = $row1['Photo'];
                        $position1 = $row1['position'];
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
        
                $send = EditCandidate ($studentID, $firstname, $lastname, $gender, $position, $CourseLevel, $image,$id2, $conn);
                    if($send == true) {
                       header("location:ViewCandidates.php");
                    } else {
                        $Status = 'There is the error in your form, Application did not sent..';
						  // echo 'Noooooooooooooooooooooooooooo';
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
                            <a href="registerCandidates.php" id="ggg1">EDIT CANDIDATE</a>
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
            <div class="col-md-6 col-md-offset-2" style="margin-top:-95px">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Candidate</h3>
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
                                    <input class="form-control" placeholder="Student ID" name="studentID" type="text" value="<?php echo $UserID1; ?>">
                                  </div>
								  <div class="form-group">
                                    <input class="form-control" placeholder="First Name" name="firstname" type="text" value="<?php echo $firstname1; ?>">
                                </div>
                                
								<div class="form-group">
                                    <input class="form-control" placeholder="Last Name" name="lastname" type="text" value="<?php echo $lastname1; ?>">
                                  </div>
								   <div class="form-group">
                                    <label>Position Candidate</label></br>
                                    <label class="radio-inline">
                                        <input type="radio" name="position" id="optionsRadiosInline2" <?php if($position1 == 'President') {echo 'checked';} ?> value="President">President
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="position" id="optionsRadiosInline3" <?php if($position1 == 'VicePresident') {echo 'checked';} ?> value="VicePresident">Vice President
                                    </label>
									<label class="radio-inline">
                                        <input type="radio" name="position" id="optionsRadiosInline3"<?php if($position1 == 'ClassRepresentive') {echo 'checked';} ?> value="ClassRepresentive">Class Representive
                                    </label>
                                  </div>
								   <div class="form-group">
                                    <select class="form-control" name="CourseLevel">
                                    <?php echo '<option value="'.$Class1.'">'.$Class1.'</option>';
									foreach ($course as $key => $value) {
                                        echo '<option value="'.$value.'">'.$key.'</option>';
                                    } ?>
                                    </select>
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
								  <div class="alert alert-info">
                               <h5> Below You have to Replace Image. The image
								File allowed are .jpg  .png and .gif
                            </div>
							<label>Remove this Image </label>
							<img class="img-circle img-responsive img-center" id="picha"src="<?php echo $Photo1; ?>"/><br>
								  <br><br><div class="form-group">
                                            <label>In put new one Image here</label>
                                            <input type="file" name="image">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-info btn-block"  value="Edit Candidate" name="registerCand">
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