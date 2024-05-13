<?php
// Turn off all error reporting
        //error_reporting(0);


//error_reporting(E_ALL);
ini_set('display_errors', 1);

// kukonect na database
$config = array (
	'DB_USERNAME' => 'root',
	'DB_PASSWORD' => '',
	'DB_NAME' => 'uchaguzi'
	);
	
	
//function ya kukonect na database
function connect($config){
	try {
	$conn = new PDO ('mysql:host=localhost;dbname=uchaguzi', $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $conn;
	} 
	catch (Exception $e) {
		return false;
		}
	}

	
// connecting to the database
$conn = connect($config);

if($conn ) {
  //echo 'Connected..!';
} else {
	echo 'Could not connect to the database..';
    die();
}

$course = array(
        'Enter Student course' => "",
		'Computer Engineering 1year' => 'coet1',
		'Computer Engineering 2year' => 'coet2',
		'Computer Engineering 3year' => 'coet3',
		'Computer Engineering 4year' => 'coet4',
		'Business 2year' => 'bs2',
		'Business 3year' => 'bs3'
		);
		
		
	 if(isset($_POST['logout'])){
	         setcookie(session_name(), '', 100);
	session_unset();
	session_destroy();
	$_SESSION = array();
             header("location:login.php");}
	                              
		
       
										  
          	  	

	?>
	