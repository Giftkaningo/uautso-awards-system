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
						$result= $row['result'];
	}}
	if($vote == 0 && $result==1){
		header("location:notvote.php");
		
	}else if($vote == 0 && $result==2){
	header("location:beforevote.php");
	
	
	}else if($vote == 0 && $result==0){	   

$query = "SELECT * FROM `wagombea` WHERE `position`='President'";
$result = $conn->query($query);
if ($result->rowCount() < 1) {
//echo "No records are found.";
 }
$query1 = "SELECT * FROM `wagombea` WHERE `position`='VicePresident'";
$result1 = $conn->query($query1);
if ($result1->rowCount() < 1) {
//echo "No records are found.";
    }
$query2 = "SELECT * FROM `wagombea` WHERE `position`='ClassRepresentive' and `Class`='$Class' and `Gender`='Male'";
$result2 = $conn->query($query2);
if ($result2->rowCount() < 1) {
	$Mcr=1;
//echo "No records are found.";
          }	
$query4 = "SELECT * FROM `wagombea` WHERE `position`='ClassRepresentive' and `Class`='$Class' and `Gender`='Female'";
$result4 = $conn->query($query4);
if ($result4->rowCount() < 1) {
	$Fcr=1;
//echo "No records are found.";
          }	
$query3 = "SELECT * FROM `wagombea` WHERE `position`='memberOFparliament'";
$result3 = $conn->query($query3);
if ($result3->rowCount() < 1) {
//echo "No records are found.";
    }
		  
		  
		  
		  
		  
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vote11'])){
    $uploadOk = 1;	  
    if ( !isset( $_POST['PresidentID']) ) {$Status="ERROR please Vote for President"; $uploadOk = 0;
        }else {$PresidentID =$_POST['PresidentID'];}
    if (!isset($_POST['VicePresidentID'])) { $Status="ERROR please Vote for Vice President"; $uploadOk = 0;
        }else {$VicePresidentID = $_POST['VicePresidentID'];}
	if (!isset($_POST['memberparliamentID'])) { $Status="ERROR please Vote for member of parliament"; $uploadOk = 0;
        }else {$memberparliamentID = $_POST['memberparliamentID'];}
  
   if (!isset($_POST['MaleClassRepresentiveID']) && !isset($Mcr) ) {$Status="ERROR please Vote for Male Class Representive"; $uploadOk = 0;
        }else {$MaleClassRepresentiveID =$_POST['MaleClassRepresentiveID'];}
   if (!isset($_POST['FemaleClassRepresentiveID']) && !isset($Fcr)) {$Status="ERROR please Vote for Female Class Representive"; $uploadOk = 0;
        }else {$FemaleClassRepresentiveID =$_POST['FemaleClassRepresentiveID'];}

	   
	   
	
	if ($uploadOk == 1) {
	$votepre = "UPDATE `wagombea` SET Totalvote = Totalvote + 1 WHERE sysID =:sysID";
	$stmtpre = $conn->prepare($votepre);
    $stmtpre->bindParam(':sysID', $PresidentID, PDO::PARAM_INT);
	if($stmtpre->execute()){
	    		$test=1;
		    } else {
		    	$test=0;
		    	
		    }  
	
	 
    $votemember = "UPDATE `wagombea` SET Totalvote = Totalvote + 1 WHERE sysID =:sysID";
	$stmtmember = $conn->prepare($votemember);
    $stmtmember->bindParam(':sysID', $memberparliamentID, PDO::PARAM_INT);
    if($stmtmember->execute()){
	    		$test=1;
		    } else {
			$test=0;}
				
				
	   $voteVpre = "UPDATE `wagombea` SET Totalvote = Totalvote + 1 WHERE sysID =:sysID";
	$stmtVpre = $conn->prepare($voteVpre);
    $stmtVpre->bindParam(':sysID', $VicePresidentID, PDO::PARAM_INT);
    if($stmtVpre->execute()){
	    		$test=1;
		    } else {
			$test=0;}
 
 if(!isset($Mcr)){
    $MalevoteCr = "UPDATE `wagombea` SET Totalvote = Totalvote + 1 WHERE sysID = :sysID";
	$MalestmtCr = $conn->prepare($MalevoteCr);
    $MalestmtCr->bindParam(':sysID',$MaleClassRepresentiveID, PDO::PARAM_INT);
    if($MalestmtCr->execute()){
	    		$test=1;
		    } else {
		    	$test=0;
		    }
 }else {$test=1;}		    
			
 if(!isset($Fcr)){
    $FemalevoteCr = "UPDATE `wagombea` SET Totalvote = Totalvote + 1 WHERE sysID = :sysID";
	$FemalestmtCr = $conn->prepare($FemalevoteCr);
    $FemalestmtCr->bindParam(':sysID',$FemaleClassRepresentiveID, PDO::PARAM_INT);
    if($FemalestmtCr->execute()){
	    		$test=1;
		    } else {
		    	$test=0;
		    }
 }else {$test=1;}
			
			
	if($test == 1)  {
	$voted=1;
	 $user = "UPDATE `regperson` SET vote = :vote  WHERE regID = :regID";
	 $stmtuser = $conn->prepare($user);
    $stmtuser->bindParam(':regID', $regID, PDO::PARAM_INT);
	$stmtuser->bindParam(':vote', $voted , PDO::PARAM_INT);
	    if($stmtuser->execute()){
	    		header("location:donevote.php");
		                         }                    
	
                     }
        }
	}
	

}else{header("location:donevote.php");}
     			
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

               

            <div class="navbar-default sidebar" role="navigation"><?php if(isset($Status)) {
						
					 echo '<div class="alert alert-danger">';
                                echo  $Status;           
											 echo '</div>';
                            }?>
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
       
                        <li >
                            <a href="Vote.php" id="ggg1">VOTE</a>
                        </li>
						<li>
                            <a href="passChange.php" id="ggg">CHANGE PASSWORD</a>
                        </li>
     
                        <li>
						<form role="form" method="post" enctype="">
                           <input type="submit" class="btn btn-lg btn-info btn-block" id="ggg" value="LOG OUT" name="logout">
						</form>
                        </li>
 
                    </ul>
					
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

    <div id="page-wrapper">
	<form role="form" method="post" enctype="" id="form1">
            <!-- /.row -->
           <div class="row">
                       <?php 
	                        if($result) {
                           foreach ($result as $row1) {            
                echo '<div class="col-lg-4">';
                echo '<div class="panel panel-primary nafasi">';
                echo '<div class=" panel-heading Hkk"><b>';
                echo 'President Candidate</b>'; 
                echo '</div>';
                echo '<div class="panel-Bkk">';
                echo            '<table><tr><td><img class="img-circle img-responsive img-center" src="'.$row1['Photo'].'"></td>';
				echo    '<td style="padding:7px;"><b>STUDENT ID : '.$row1['StudentID'].'<br>';
				echo    'NAME    : '.$row1['Fname'].' '.$row1['Lname'].'<br>';
				echo    'Gender  :'.$row1['Gender'].'<br>';
				echo    'Course  :'.$row1['Class'].'<br>';
				echo     '</td></tr>';
				echo '</table>';
                echo        '</div>';
                echo        '<div class="panel-fkk"><b>';
                echo            'Vote'.' '.$row1['Fname'].' '.$row1['Lname'].' <input type="radio" name="PresidentID" id="optionsRadiosInline3" value="'.$row1['sysID'].'">';
                echo        '</div></b>';
                echo    '</div>';
                echo '</div>';  
						   }
							}
						   ?> </div>   
						   <!-- /.col-lg-4 -->
			<div class="row">
                     <?php 
	                        if($result1) {
                           foreach ($result1 as $row2) {            
                echo '<div class="col-lg-4">';
                echo '<div class="panel panel-red nafasi">';
                echo '<div class=" panel-heading Hkk"><b>';
                echo 'Vice President</b>'; 
                echo '</div>';
                echo '<div class="panel-Bkk">';
                echo            '<table><tr><td><img class="img-circle img-responsive img-center" src="'.$row2['Photo'].'"></td>';
				echo    '<td style="padding:7px;"><b>STUDENT ID : '.$row2['StudentID'].'<br>';
				echo    'NAME    : '.$row2['Fname'].' '.$row2['Lname'].'<br>';
				echo    'Gender  :'.$row2['Gender'].'<br>';
				echo    'Course  :'.$row2['Class'].'<br>';
				echo     '</b></td></tr>';
				echo '</table>';
                echo        '</div>';
                echo        '<div class="panel-fkk"><b>';
                echo            'Vote'.' '.$row2['Fname'].' '.$row2['Lname'].'  <input type="radio" name="VicePresidentID" id="optionsRadiosInline3" value="'.$row2['sysID'].'">';
                echo        '</b></div>';
                echo    '</div>';
                echo '</div>';  
						   }
							}
						   ?> 
			</div>
			
						<div class="row">
                     <?php 
	                        if($result3) {
                           foreach ($result3 as $row3) {            
                echo '<div class="col-lg-4">';
                echo '<div class="panel panel-yellow nafasi">';
                echo '<div class=" panel-heading Hkk"><b>';
                echo 'Member of Parliament</b>'; 
                echo '</div>';
                echo '<div class="panel-Bkk">';
                echo            '<table style="font-size: 12px;"><tr><td><img class="img-circle img-responsive img-center" src="'.$row3['Photo'].'"></td>';
				echo    '<td style="padding:7px;"><b>STUDENT ID : '.$row3['StudentID'].'<br>';
				echo    'NAME    : '.$row3['Fname'].' '.$row3['Lname'].'<br>';
				echo    'Gender  :'.$row3['Gender'].'<br>';
				echo    'Course  :'.$row3['Class'].'<br>';
				echo     '</b></td></tr>';
				echo '</table>';
                echo        '</div>';
                echo        '<div class="panel-fkk" ><b>';
                echo            'Vote'.' '.$row3['Fname'].' '.$row3['Lname'].' <input type="radio" name="memberparliamentID" id="optionsRadiosInline3" value="'.$row3['sysID'].'">';
                echo        '</b></div>';
                echo    '</div>';
                echo '</div>';  
						   }
							}
						   ?> 
			</div>
                <div class="row">
                     <?php 
	                        if($result2) {
                           foreach ($result2 as $row4) {            
                echo '<div class="col-lg-4">';
				
                
				echo '<div class="panel panel-info nafasi">';
                echo '<div class=" panel-heading Hkk"><b>';
				
				echo 'Male : Class Representive</b>';
                echo '</div>';
                echo '<div class="panel-Bkk">';
                echo            '<table><tr><td><img class="img-circle img-responsive img-center" src="'.$row4['Photo'].'"></td>';
				echo    '<td style="padding:7px;"><b>STUDENT ID : '.$row4['StudentID'].'<br>';
				echo    'NAME    : '.$row4['Fname'].' '.$row4['Lname'].'<br>';
				echo    'Gender  :'.$row4['Gender'].'<br>';
				echo    'Course  :'.$row4['Class'].'<br>';
				echo     '<b></td></tr>';
				echo '</table>';
                echo        '</div>';
                echo        '<div class="panel-fkk"><b>';
				echo            'Vote'.' '.$row4['Fname'].' '.$row4['Lname'].' <input type="radio" name="MaleClassRepresentiveID" id="optionsRadiosInline3" value="'.$row4['sysID'].'">';
                echo        '</div></b>';
                echo    '</div>';
                echo '</div>';  
						   }
							}
						   ?> 
			           <?php 
	                        if($result4) {
                           foreach ($result4 as $row5) {            
                echo '<div class="col-lg-4">';
				
                
				echo '<div class="panel panel-success nafasi">';
                echo '<div class=" panel-heading Hkk"><b>';
				
				echo 'Female : Class Representive</b>';
                echo '</div>';
                echo '<div class="panel-Bkk">';
                echo            '<table><tr><td><img class="img-circle img-responsive img-center" src="'.$row5['Photo'].'"></td>';
				echo    '<td style="padding:7px;"><b>STUDENT ID : '.$row5['StudentID'].'<br>';
				echo    'NAME    : '.$row5['Fname'].' '.$row5['Lname'].'<br>';
				echo    'Gender  :'.$row5['Gender'].'<br>';
				echo    'Course  :'.$row5['Class'].'<br>';
				echo     '<b></td></tr>';
				echo '</table>';
                echo        '</div>';
                echo        '<div class="panel-fkk"><b>';
				echo            'Vote'.' '.$row5['Fname'].' '.$row5['Lname'].' <input type="radio" name="FemaleClassRepresentiveID" id="optionsRadiosInline3" value="'.$row5['sysID'].'">';
                echo        '</div></b>';
                echo    '</div>';
                echo '</div>';  
						   }
							}
						   ?> 
				</div>
						   <input type="submit" class="btn btn-lg btn-info btn-block"  value="Submit your Vote" name="vote11" form="form1" >
             </from>    
    </div>
<hr>
<!-- Footer -->
    <footer>
              
				Copyright &copy; MNMA student Organisation
				<div style="float:right;" class="nav navbar-top-links navbar-right">Created by MNMA student 2023<br>rukia@live.de</div>
               
     </footer>	
</body>

</html>
