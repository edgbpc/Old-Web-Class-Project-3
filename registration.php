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
	include 'php/scripts.php';
	


	
	$username = $email = $firstname = $lastname = $zipCode = $birthDate = $password = $verifypassword = $phonenumber = $Address1 = $Address2 = $city = $state = $genderradio = $marriedradio = "";
	$usernameErr = $emailErr = $zipcodeErr = $passwordErr = $firstnameErr = $lastnameErr = $address1Err = $cityErr = $verifyPasswordErr = $phoneNumberErr = $zipCodeErr = $birthDateErr = "";
	
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["btnreset"])){
        $username = $email = $firstname = $lastname = $zipCode = $birthDate = $password = $verifypassword = $phonenumber = $Address1 = $Address2 = $city = $state = $genderradio = $marriedradio = "";
        $usernameErr = $emailErr = $zipcodeErr = $passwordErr = $firstnameErr = $lastnameErr = $address1Err = $cityErr = $verifyPasswordErr = $phoneNumberErr = $zipCodeErr = $birthDateErr = "";
        }
    }

	// code governing when a Required Field error is triggered has been made unncessary due to the HTML required attribute.  I left the code in place for future potential use 
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST["btnsubmit"])){
		$username = test_input($_POST["username"]);
		
		if (empty($username)) {
			$usernameErr = "Username is required";
		
		} else {
		// check if name only contains letters and whitespace
			if (!validateUsername()) {
				$usernameErr = "Insufficient length.  Must be at least 6 characters";
				
			}
		}

		$email = test_input($_POST["email"]);
		
		if (empty($email)) {
			$emailErr = "Email is required";
		} else {
		// check if e-mail address is well-formed
			if (!(validateEmail())){
				$emailErr = "Invalid email format";
			}
		}
		
		$password = test_input($_POST["pwd"]);
		
		if (empty($password)) {
			
			$passwordErr = "Password Required";
		} else {
		// check if e-mail address is well-formed
			if (!(validatePassword())){
				$passwordErr = "Complexity requirements not met";
			}
		}
		
		$verifypassword = test_input($_POST["verifypwd"]);
		if (empty($password)) {
			$verifyPasswordErr = "Password Required";
		} else {
		// check if e-mail address is well-formed
			if (!(matchPassword())){
				$verifyPasswordErr = "Passwords must match";
			}
		}
		
		$firstname = test_input($_POST["firstname"]);
		if (empty($firstname)){
			$firstnameErr = "First name is required";
		}
		
		$lastname = test_input($_POST["lastname"]);
		if (empty($lastname)){
			$lastnameErr = "Last name is required";
		}
		
		$Address1 = test_input($_POST["Address1"]);
		if (empty($Address1)){
			$address1Err = "Address Required";
		}

        $Address2 = test_input($_POST["Address2"]);
		
		$city = test_input($_POST["city"]);
		if (empty($city)){
			$cityErr = "City Required";
		}
		
		$phonenumber = test_input($_POST["phonenumber"]);
		if (empty($phonenumber)){
			$phoneNumberErr = "Phone number required";
            }else{
               	if (!(validatePhoneLength())){
					$phoneNumberErr = "Invalid phone number.";
				}
    		}			
		
		$zipCode = test_input($_POST["zipcode"]);

		if (empty($zipCode)){
			$zipCodeErr = "Zip Code Required";
			}else{
               	if (!(validateZipLength())){
					$zipCodeErr = "Invalid zipcode.  Must be 5 or 9 digits.";
				}
            }		
		
		$birthDate = test_input($_POST["date"]);
		$sqlBirthDate = date('Y-m-d', strtotime($birthDate));
		
		if (empty($birthDate)){
			$birthDateErr = "Date of Birth Required";
		}

        $genderradio = test_input($_POST["genderradio"]);

        $marriedradio = test_input($_POST["marriedradio"]);
		
		$state = test_input($_POST["state"]);

        if (validateFields()){
			//$_SESSION = $_POST;
            //  print_r($_POST);
			
			$link = mysqli_connect("localhost", "root", "", "project");
			
			if ($link ==  false){
				die("ERROR: Could not Connect." . mysqli_connect_error());
			}

			$sql = "INSERT INTO registration (userName, password, firstName, lastName, address1, address2, city, state, zipCode, phone, email, gender, maritalStatus, dateOfBirth) VALUES 
			('$username', '$password', '$firstname', '$lastname', '$Address1', '$Address2', '$city', '$state', '$zipCode', '$phonenumber', '$email', '$genderradio', '$marriedradio', '$sqlBirthDate')";
			
			if (mysqli_query($link, $sql)){
				echo "Records entered correctly";
			} else {
				echo "ERROR: Could not able to execuse $sql. " . mysql_error($link);
			}
			
			$last_id = mysqli_insert_id($link);
			$_SESSION['last_id'] = $last_id;
			
			mysqli_close($link);
			
			header("Location: confirmation.php");
		}
      }
	}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
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
				
				<h1>Registration</h1>
			</div>
		</div>
		
		<div class="row">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 col-lg-2 col-lg-offset-2 ">
					<input type="text" class="form-control" title="Must be between 6 and 50 characters. Required" name="username" id="username" maxlength="50" placeholder="Username" value="<?php echo $username; ?>" onblur="changeToBlack(this); validateUsername();" required  />
                    <span class="error" id="userNameErr"><?php echo $usernameErr;?></span><br />
					<input type="email" class="form-control" title="Required." name="email" id="email" maxlength="255" placeholder="Email Address" value="<?php echo $email; ?>"  onblur="changeToBlack(this); validateEmail()" required  />
					<span class="error" id="emailErr"><?php echo $emailErr;?></span><br />
					<input type="text" class="form-control" title="Required." name="firstname" id="firstname" maxlength="50" placeholder="First Name" value="<?php echo $firstname; ?>" required />
					<span class="error"><?php echo $firstnameErr;?></span><br />
					<input type="text" class="form-control" title="Required." name="lastname" id="lastname" maxlength="50" placeholder="Last Name" value="<?php echo $lastname; ?>" required />
					<span class="error"><?php echo $lastnameErr;?></span><br />
					<input type="text" class="form-control" title="Required." name="zipcode" id="zipCode" maxlength="10" placeholder="Zip Code" value="<?php echo $zipCode; ?>" onkeyup="formatZipCode(this)" onblur="changeToBlack(this); validateZipLength(this)" required />
					<span class="error" id="zipCodeErr"><?php echo $zipCodeErr;?></span><br />
					<input type="text" class="form-control" title="Required." name="date" id="datepicker" placeholder="Date of Birth" value="<?php echo $birthDate; ?>" required />
					<span class="error"><?php echo $birthDateErr;?></span><br />
				</div>
				<div class="col-md-6 col-md-offset-3 col-lg-2 col-lg-offset-0 ">
					<input type="password" title="Must contain 1 Upper, 1 Lower, 1 Digit and 1 Special Character and be at least 8 characters" class="form-control" name="pwd" id="pwd" maxlength="50" placeholder="Password"  onblur="changeToBlack(this); validatePassword()" required />
					<span class="error" id="passwordErr"><?php echo $passwordErr;?></span><br />
					<input type="password" class="form-control" title="Reenter password to confirm." name="verifypwd" id="verifypwd" maxlength="50" placeholder="Verify Password" onblur="changeToBlack(this); matchPassword()" required />
					<span class="error" id="verifyPasswordErr"><?php echo $verifyPasswordErr;?></span><br />
					<!-- max length should be 13, not 12, to accomodate characters "(", ")", and "-" -->
					<input type="text" class="form-control" title="Required." name="phonenumber" id="phonenumber" maxlength="13" placeholder="(XXX)XXX-XXXX" value="<?php echo $phonenumber; ?>"  onkeyup="formatPhone(this)" onblur="changeToBlack(this); validatePhoneLength()" required/>
					<span class="error" id="phoneNumberErr"><?php echo $phoneNumberErr;?></span><br />
					<input type="text" class="form-control" title="Required." name="Address1" id="Address1" maxlength="100" placeholder="Address Line 1" value="<?php echo $Address1; ?>" required />
					<span class="error"><?php echo $address1Err;?></span><br />
					<input type="text" class="form-control" name="Address2" id="Address2" maxlength="100" placeholder="Address Line 2-Optional" value="<?php echo $Address2; ?>" /> <br />
					<input type="text" class="form-control" title="Required." name="city" id="City" maxlength="50" placeholder="City" value="<?php echo $city; ?>"  required />
					<span class="error"><?php echo $cityErr;?></span><br />
		
					<div class="form-group dropdown-fix">
						<select class="form-control" title="Required." id="state" name="state" maxlength="52">
							<option value="Alaska">Alaska</option>
							<option value="Alabama">Alabama</option>
							<option value="Arkansas">Arkansas</option>
							<option value="Arizona">Arizona</option>
							<option value="California">California</option>
							<option value="Colorado">Colorado</option>
							<option value="Connecticut">Connecticut</option>
							<option value="District of Columbia">District of Columbia</option>
							<option value="Delaware">Delaware</option>
							<option value="Florida">Florida</option>
							<option value="Georgia">Georgia</option>
							<option value="Hawaii">Hawaii</option>
							<option value="Iowa">Iowa</option>
							<option value="Idaho">Idaho</option>
							<option value="Illinois">Illinois</option>
							<option value="Indiana">Indiana</option>
							<option value="Kansas">Kansas</option>
							<option value="Kentucky">Kentucky</option>
							<option value="Louisiana">Louisiana</option>
							<option value="Massachusetts">Massachusetts</option>
							<option value="Maryland">Maryland</option>
							<option value="Maine">Maine</option>
							<option value="Michigan">Michigan</option>
							<option value="Minnesota">Minnesota</option>
							<option value="Missouri">Missouri</option>
							<option value="Mississippi">Mississippi</option>
							<option value="Montana">Montana</option>
							<option value="North Carolina">North Carolina</option>
							<option value="North Dakota">North Dakota</option>
							<option value="Nebraska">Nebraska</option>
							<option value="New Hampshire">New Hampshire</option>
							<option value="New Jersey">New Jersey</option>
							<option value="New Mexico">New Mexico</option>
							<option value="Nevada">Nevada</option>
							<option value="New YorkNY">New York</option>
							<option value="Ohio">Ohio</option>
							<option value="Oklahoma">Oklahoma</option>
							<option value="Oregon">Oregon</option>
							<option value="Pennsylvania">Pennsylvania</option>
							<option value="Puerto Rico">Puerto Rico</option>
							<option value="Rhode Island">Rhode Island</option>
							<option value="South Carolina">South Carolina</option>
							<option value="South Dakota">South Dakota</option>
							<option value="Tennessee">Tennessee</option>
							<option value="Texas">Texas</option>
							<option value="Utah">Utah</option>
							<option value="Virginia">Virginia</option>
							<option value="Vermont">Vermont</option>
							<option value="Washington">Washington</option>
							<option value="Wisconsin">Wisconsin</option>
							<option value="West Virginia">West Virginia</option>
							<option value="Wyoming">Wyoming</option>
						</select>
					</div>

				</div>
		</div>

				<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 col-lg-3 col-lg-offset-2">
					<div class="radio form-group">
						<label for="male"><input type="radio" id="male" name="genderradio" <?php if ($genderradio=="male") echo "checked";?> value="male" maxlength="50" checked="on">Male</label>
						<label for="female"><input type="radio" id="female" name="genderradio" <?php if ($genderradio=="female") echo "checked";?> value="female" maxlength="50">Female</label><br />
					</div>

					<div class="radio form-group">
						<label for="married"><input type="radio" id="married" name="marriedradio" <?php if ($marriedradio=="married") echo "checked";?> value="married" maxlength="50" checked="on">Married</label>
						<label for="notmarried"><input type="radio" id="notmarried" name="marriedradio" <?php if ($marriedradio=="notmarried") echo "checked";?> value="notmarried" maxlength="50">Not Married</label><br />
					</div>
					
					<button type="submit" id="submitbutton" class="btn btn-primary" name="btnsubmit" value="submit">Submit</button> 
					<button type="submit" id="resetbutton" class="btn btn-default" name="btnreset" value="reset" formnovalidate>Reset</button><br />
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