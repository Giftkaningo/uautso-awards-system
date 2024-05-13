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


$que = "SELECT * FROM `regperson` ";
$res = $conn->query($que);
$tot=$res->rowCount();







$query = "SELECT * FROM `regperson` WHERE `vote`=1 and `Class`='coet1'";
$result = $conn->query($query);
$vtdc1=$result->rowCount();

$query1 = "SELECT * FROM `regperson` WHERE `vote`=1 and `Class`='coet2'";
$result1 = $conn->query($query1);
$vtdc2=$result1->rowCount();
    		  
$query2 = "SELECT * FROM `regperson` WHERE `vote`=1 and `Class`='coet3'";
$result2 = $conn->query($query2);
$vtdc3=$result2->rowCount();

$query3 = "SELECT * FROM `regperson` WHERE `vote`=1 and `Class`='coet4'";
$result3 = $conn->query($query3);
$vtdc4=$result3->rowCount();

$query4 = "SELECT * FROM `regperson` WHERE `vote`=1 and `Class`='bs1'";
$result4 = $conn->query($query4);
$vtdba1=$result4->rowCount();
    		  
$query5 = "SELECT * FROM `regperson` WHERE `vote`=1 and `Class`='bs2'";
$result5 = $conn->query($query5);
$vtdba2=$result5->rowCount();

$query6 = "SELECT * FROM `regperson` WHERE `vote`=1 and `Class`='bs3'";
$result6 = $conn->query($query6);
$vtdba3=$result6->rowCount();

$query7 = "SELECT * FROM `regperson` WHERE `vote`=1 ";
$result7 = $conn->query($query7);
$total=$result7->rowCount();




$query0 = "SELECT * FROM `regperson` WHERE `vote`=0 and `Class`='coet1'";
$result0 = $conn->query($query0);
$vtdc01=$result0->rowCount();

$query01 = "SELECT * FROM `regperson` WHERE `vote`=0 and `Class`='coet2'";
$result01 = $conn->query($query01);
$vtdc02=$result01->rowCount();
    		  
$query02 = "SELECT * FROM `regperson` WHERE `vote`=0 and `Class`='coet3'";
$result02 = $conn->query($query02);
$vtdc03=$result02->rowCount();

$query03 = "SELECT * FROM `regperson` WHERE `vote`=0 and `Class`='coet4'";
$result03 = $conn->query($query03);
$vtdc04=$result03->rowCount();

$query04 = "SELECT * FROM `regperson` WHERE `vote`=0 and `Class`='bs1'";
$result04 = $conn->query($query04);
$vtdba01=$result04->rowCount();
    		  
$query05 = "SELECT * FROM `regperson` WHERE `vote`=0 and `Class`='bs2'";
$result05 = $conn->query($query05);
$vtdba02=$result05->rowCount();

$query06 = "SELECT * FROM `regperson` WHERE `vote`=0 and `Class`='bs3'";
$result06 = $conn->query($query06);
$vtdba03=$result06->rowCount();

$query07 = "SELECT * FROM `regperson` WHERE `vote`=0 ";
$result07 = $conn->query($query07);
$total0=$result07->rowCount();


$pa=($total/$tot)*100;

	$pa0=($total0/$tot)*100;
	
	
	
	
	if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pub'])){
               $resul = $_POST['pubresult'];
 
$pubresult = "UPDATE `regperson` SET result =:result";
	$stmtpubresult = $conn->prepare($pubresult);
    $stmtpubresult->bindParam(':result', $resul, PDO::PARAM_INT);

	if($stmtpubresult->execute()){
	    		//$test=1;
		    } else {
		    	//$test=0;
		    	
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

    <meta name="Voting UAUT" content="">
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
                            <a href="AdminHome.php" id="ggg1">HOME</a>
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
                <div class="col-lg-11">
                    
                            <div class="well" style=" margin-top: 15px;">
                                <h4>Information about those who vote</h4>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>CoET 1</th>
                                        <th>CoET 2</th>
                                        <th>CoET 3</th>
                                        <th>CoET 4</th>
										<th>CoBA 1</th>
                                        <th>CoBA 2</th>
                                        <th>CoBA 3</th>
										<th>Total</th>
                                        <th>Percentage</th>
                                        </tr>
                                    </thead>
                                
                            
							
							 <?php 
										    	
										    echo '<tr class'.'="info">';
	                                            echo '<td>'.$vtdc1.'</td>';
	                                            echo '<td>'.$vtdc2.'</td>';
	                                            echo '<td>'.$vtdc3.'</td>';
	                                            echo '<td>'.$vtdc4.'</td>';
												echo '<td>'.$vtdba1.'</td>';
	                                            echo '<td>'.$vtdba2.'</td>';
	                                            echo '<td>'.$vtdba3.'</td>';
												echo '<td>'.$total.'</td>';
	                                            echo '<td>'.$pa.'</td>';
	                                       echo '</tr>';
										
                                    ?>
									</table>

             </div>
			  </div>
			 </div>
			 <div class="row">
			  <div class="col-lg-11">
			 <div class="well" >
                                <h4>Infomation about those who dont vote</h4>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>CoET 1</th>
                                        <th>CoET 2</th>
                                        <th>CoET 3</th>
                                        <th>CoET 4</th>
										<th>CoBA 1</th>
                                        <th>CoBA 2</th>
                                        <th>CoBA 3</th>
										<th>Total</th>
                                        <th>Percentage</th>
                                        </tr>
                                    </thead>
                                
                            
							
							 <?php 
										    	
										     echo '<tr class'.'="danger">';
	                                            echo '<td>'.$vtdc01.'</td>';
	                                            echo '<td>'.$vtdc02.'</td>';
	                                            echo '<td>'.$vtdc03.'</td>';
	                                            echo '<td>'.$vtdc04.'</td>';
												echo '<td>'.$vtdba01.'</td>';
	                                            echo '<td>'.$vtdba02.'</td>';
	                                            echo '<td>'.$vtdba03.'</td>';
												echo '<td>'.$total0.'</td>';
	                                            echo '<td>'.$pa0.'</td>';
	                                         echo '</tr>';
										
                                    ?>
									</table>

             </div>
                <!-- /.col-lg-12 -->
            </div>
         </div>   
      <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Publish Result
                        </div>
                        <div class="panel-body">
						<table><form role="form" method="post" enctype="">
					<tr>
						<td style="padding:0px 28px;">
						<label class="radio-inline">
                               <input type="radio" name="pubresult" id="optionsRadiosInline3" value="1"><strong>publish  Result</strong>
                               </label>
									</td>
									<td>
									<label class="radio-inline">
                                        <input align="right" type="radio" name="pubresult" id="optionsRadiosInline3" value="0" checked><strong>Vote Time</strong>
                                    </label></td>
								<td>
									<label class="radio-inline">
                                        <input align="right" type="radio" name="pubresult" id="optionsRadiosInline3" value="2"><strong>Before Voting</strong>
                                    </label>
								</td>
					</tr>
					
						</table>
						<input type="submit" class="btn btn-lg btn-info btn-block"  value="Activate Action" name="pub">
					</from>
                        </div>
                        
                    </div>
                </div>		 <!-- /.row -->	
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