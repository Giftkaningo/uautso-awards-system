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





$query = "SELECT * FROM `wagombea` WHERE `position`='President' ORDER BY `Totalvote` DESC";
$result = $conn->query($query);
if ($result->rowCount() < 1) {
echo "No records are found.";
 }
$query1 = "SELECT * FROM `wagombea` WHERE `position`='VicePresident' ORDER BY `Totalvote` DESC";
$result1 = $conn->query($query1);
if ($result1->rowCount() < 1) {
echo "No records are found.";
    }
$query3 = "SELECT * FROM `wagombea` WHERE `position`='memberOFparliament' ORDER BY `Totalvote` DESC";
$result3 = $conn->query($query3);
if ($result3->rowCount() < 1) {
//echo "No records are found.";
    }	
$query2 = "SELECT * FROM `wagombea` WHERE `position`='ClassRepresentive' and `Class`='$Class' and `Gender`='Male' ORDER BY `Totalvote` DESC";
$result2 = $conn->query($query2);
if ($result2->rowCount() < 1) {

//echo "No records are found.";
          }	
$query4 = "SELECT * FROM `wagombea` WHERE `position`='ClassRepresentive' and `Class`='$Class' and `Gender`='Female' ORDER BY `Totalvote` DESC";
$result4 = $conn->query($query4);
if ($result4->rowCount() < 1) {
//echo "No records are found.";
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
                         <li >
                            <a href="Vote.php" id="ggg1">VIEW RESULT</a>
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
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                       
						<div class="panel-heading">
                            President Result
                        </div>
                        <div class="panel-body" >
						   <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Get Votes</th>
                                            <!--<th>Percentage</th>-->
                                        </tr>
                                    </thead>
                                   <tbody>
                                  <?php 
	                                    if($result) {
											
                                                foreach ($result as $row) {
										         echo '<tr class'.'="odd gradeX">';
                                                echo '<td>'.$row['Fname'].' '.$row['Lname'].'</td>';
	                                            echo '<td>'.$row['Totalvote'].'</td>';
	                                            //echo '<td>'.$row['Gender'].'</td>';
												echo '</tr>';
												}
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
				       <div class="col-lg-6">
                    <div class="panel panel-red">
                       
						<div class="panel-heading">
                           Vice President Result
                        </div>
                        <div class="panel-body" >
						   <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Total Vote</th>
                                            
                                        </tr>
                                    </thead>
                                   <tbody>
                                  <?php 
	                                    if($result1) {
											
                                                foreach ($result1 as $row1) {
										         echo '<tr class'.'="odd gradeX">';
                                                echo '<td>'.$row1['Fname'].' '.$row1['Lname'].'</td>';
	                                            echo '<td>'.$row1['Totalvote'].'</td>';
	                                            //echo '<td>'.$row1['Gender'].'</td>';
												echo '</tr>';
												}
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
		                <div class="col-lg-6">
                    <div class="panel panel-yellow">
                       
						<div class="panel-heading">
                           Member of parliament
                        </div>
                        <div class="panel-body" >
						   <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Total Vote</th>
                                            
                                        </tr>
                                    </thead>
                                   <tbody>
                                  <?php 
	                                    if($result3) {
											
                                                foreach ($result3 as $row3) {
										         echo '<tr class'.'="odd gradeX">';
                                                echo '<td>'.$row3['Fname'].' '.$row3['Lname'].'</td>';
	                                            echo '<td>'.$row3['Totalvote'].'</td>';
	                                            //echo '<td>'.$row1['Gender'].'</td>';
												echo '</tr>';
												}
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
		                <div class="col-lg-6">
                    <div class="panel panel-info">
                       
						<div class="panel-heading">
                           Male Class Representive Result
                        </div>
                        <div class="panel-body" >
						   <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Total Vote</th>
                                            
                                        </tr>
                                    </thead>
                                   <tbody>
                                  <?php 
	                                    if($result2) {
											
                                                foreach ($result2 as $row2) {
										         echo '<tr class'.'="odd gradeX">';
                                                echo '<td>'.$row2['Fname'].' '.$row2['Lname'].'</td>';
	                                            echo '<td>'.$row2['Totalvote'].'</td>';
	                                            //echo '<td>'.$row2['Gender'].'</td>';
												echo '</tr>';
												}
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
				    <div class="col-lg-6">
                    <div class="panel panel-success">
                       
						<div class="panel-heading">
                            Female Class Representive Result
                        </div>
                        <div class="panel-body" >
						   <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Total Vote</th>
                                            
                                        </tr>
                                    </thead>
                                   <tbody>
                                  <?php 
	                                    if($result4) {
											
                                                foreach ($result4 as $row4) {
										         echo '<tr class'.'="odd gradeX">';
                                                echo '<td>'.$row4['Fname'].' '.$row4['Lname'].'</td>';
	                                            echo '<td>'.$row4['Totalvote'].'</td>';
	                                            //echo '<td>'.$row2['Gender'].'</td>';
												echo '</tr>';
												}
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
				<div style="float:right;" class="nav navbar-top-links navbar-right">Created by MNMA student 2023<br>rukia@live.de</div>
               
     </footer>					
</body>

</html>