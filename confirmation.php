<?php
// Start the session
session_start();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="CS 3010 Project 2" />
    <meta name="author" content="Eric Goodwin" />
    
	<link rel="shortcut icon" href="img/pen.ico">

    <title>Crowd Sourcing a Novel - an Experiment</title>
	

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />

	<!--datepicker css -->
	<link href="css/jquery-bootstrap-datepicker.css" rel="stylesheet" />
	
  </head>

  <body>

	
<?php
	include 'php/scripts.php'

?>

<?php

	//displays access denied page if directly typed
	
if (!isset($_SERVER['HTTP_REFERER'])){ 

	header("Location: accessdenied.php"); 

} 

  

	$link = mysqli_connect("localhost", "root", "", "project");
			
	if ($link ==  false){
		die("ERROR: Could not Connect." . mysqli_connect_error());
	}

//	$last_id = $_SESSION['last_id'];

	$query = "SELECT * FROM registration ORDER by ID DESC LIMIT 1";
			
	if ($result = mysqli_query($link, $query)) {
		
		/* fetch associative array */
		$row = mysqli_fetch_row($result);
	
	
	}
			
	//Assign data from sql queries to variables to be displayed on page
	$username = $row[1];
	$email = $row[11];
	$firstname = $row[3];
	$lastname = $row[4];
	$zipCode = $row[9];
	$birthDate = $row[14];
	$phonenumber = $row[10];
	$Address1 = $row[5];
	$Address2 = $row[6];
	$city = $row[7];
	$state = $row[8];
	$genderradio = $row[12]; 
	$marriedradio = $row[13];


	
	//convert to MM/DD/YYYY format
	$birthdateArray = explode('-', $birthDate);
	$displayDate = "{$birthdateArray[2]}/{$birthdateArray[1]}/{$birthdateArray[0]}";

	
	
?>
	<header class="navbar-fixed-top">
		<div class="container text-center">
			<div class="navbar col-md-12 col-sm-12 col-xs-12">
			Crowd source novel project
			</div>
		</div>
    </header>

		
	<div  id="maincontent" class="container-fluid">
		<div class="row clearfix">
			<div id="leftnavmenu" class="col-xs-12 col-sm-3 col-md-3 col-lg-2 clearfix">
				<ul class="nav nav-sidebar">
					<li><a href="index.php">Home</a></li>
					<li><a href="registration.php">Registration</a></li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-6 col-lg-10">
				
				<h1>Thank you for registering.</h1>
			</div>
		</div>
		
		<div class="row">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 col-lg-2 col-lg-offset-2 ">
					<input type="text" class="form-control" name="username" id="username" maxlength="50" placeholder="Username" value="<?php echo $username; ?>" onblur="changeToBlack(this)" disabled />
                                        <br />
					<input type="email" class="form-control" name="email" id="email" maxlength="255" placeholder="Email Address" value="<?php echo $email; ?>"  onblur="changeToBlack(this)"  disabled />
					<br />
					<input type="text" class="form-control" name="firstname" id="firstname" maxlength="50" placeholder="First Name" value="<?php echo $firstname; ?>" disabled />
					<br />
					<input type="text" class="form-control" name="lastname" id="lastname" maxlength="50" placeholder="Last Name" value="<?php echo $lastname; ?>" disabled  />
					<br />
					<input type="text" class="form-control" name="zipcode" id="zipCode" maxlength="10" placeholder="Zip Code" value="<?php echo $zipCode; ?>"  onkeyup="formatZipCode(this)" onblur="validateZipLength(this)" disabled />
					<br />
					<input type="text" class="form-control" name="date" id="datepicker" placeholder="Date of Birth" value="<?php echo $displayDate ; ?>" disabled />
					
				</div>
				<div class="col-md-6 col-md-offset-3 col-lg-2 col-lg-offset-0 ">
					<input type="password" title="Must contain 1 Upper, 1 Lower, 1 Digit and 1 Special Character" class="form-control" name="pwd" id="pwd" maxlength="50" placeholder="Password"  onblur="changeToBlack(this)" disabled  />
					<br />
					<input type="password" class="form-control" name="verifypwd" id="verifypwd" maxlength="50" placeholder="Verify Password" onblur="changeToBlack(this)" disabled  />
					<br />
					<!-- max length should be 13, not 12, to accomodate characters "(", ")", and "-" -->
					<input type="text" class="form-control" name="phonenumber" id="phonenumber" maxlength="13" placeholder="(XXX)XXX-XXXX" value="<?php echo $phonenumber ; ?>"  onkeyup="formatPhone(this)" disabled />
					<br />
					<input type="text" class="form-control" name="Address1" id="Address1" maxlength="100" placeholder="Address Line 1" value="<?php echo $Address1; ?>" disabled  />
					<br />
					<input type="text" class="form-control" name="Address2" id="Address2" maxlength="100" placeholder="Address Line 2-Optional" value="<?php echo $Address2; ?>" disabled /> <br />
					<input type="text" class="form-control" name="city" id="City" maxlength="50" placeholder="City" value="<?php echo $city; ?>" disabled  />
					<br />
                    <input type="text" class="form-control" name="state" id="state" maxlength="52 placeholder="state" value="<?php echo $state; ?>" disabled  />
		                        <br />
					

				</div>
		</div>

				<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 col-lg-3 col-lg-offset-2">
					<div class="radio form-group">
						<label for="male"><input type="radio" id="male" name="genderradio" <?php if ($genderradio=="male") echo "checked";?> value="male" maxlength="50" disabled>Male</label>
						<label for="female"><input type="radio" id="female" name="genderradio" <?php if ($genderradio=="female") echo "checked";?> value="female" maxlength="50" disabled>Female</label><br /> 
					</div>

					<div class="radio form-group">
							
                        <label for="married"><input type="radio" id="married" name="marriedradio" <?php if ($marriedradio=="married") echo "checked";?> value="married" maxlength="50" disabled>Married</label>
						<label for="notmarried"><input type="radio" id="notmarried" name="marriedradio" <?php if ($marriedradio=="notmarried") echo "checked";?> value="notmarried" maxlength="50" disabled>Not Married</label><br />
				</div>
					
					<button type="submit" id="submitbutton" class="btn btn-primary" disabled>Submit</button> 
					<button type="reset" id="resetbutton" class="btn btn-default" disabled>Reset</button><br />
				</div>
			</form>
		

			
	</div>

<nav class="navbar-fixed-bottom">
	<div class="container text-center">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<a href="https://en.wikipedia.org/wiki/Crowdsourcing" target="_blank"> Crowd Sourcing</a>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<a href="http://nanowrimo.org/" target="_blank">National Novel Writing Month</a>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<a href="https://owl.english.purdue.edu/owl/section/1/" target="_blank">Purdue Online Writing Lab</a>
			</div>
		</div>
	</div>
</nav>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="javascript/scripts.js"></script>
	
 </body>
</html>				