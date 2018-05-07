<!DOCTYPE html>
<html>
<body>

<?php
//helper functions.
//following functions are used with the function validateFields in order to ensure each form field is entered according 
//requirements set.  helper function returns either true or false which validateFields will use to pass true to false allowing
//for the form to be submitted if true is passed or interrupting the submission if false is passed.

//validates username is minimum number of characters.  max characters is governed by the HTML 5 code.

//function used for debugging purposes.  Creates a javascript like alert for PHP.  
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

function validateUsername(){
	global $username;	

	$elementLength = strlen($username);
	
	$compareToLength = 6;
	
	if ($elementLength){
		if ($elementLength >= $compareToLength){
			return true;
		}else{
			//phpAlert('Insufficient length.  Must be at least ' . $compareToLength . ' characters.');
			return false;
		}
	}
}
?>


<?php

//validates password meets minimum complexity requirements
function validatePassword() {
	
	global $password;

	//initalize all variables to false to ensure that a correct character type is revealed. 
	//validaiton only positive when all variables switch to true
	$passwordOK = false;
	//var_dump($passwordOK);
	$upperOK = false;
	$lowerOK = false;
	$numberOK = false;
	$specialOK = false;
	$minMaxLengthOK = false;
	
	//regular expressions for to check for required character.  
	$minMaxLength = "/^[\s\S]{8,32}$/";
    $upper = "/[A-Z]/";
    $lower = "/[a-z]/";
    $number = "/[0-9]/";
    //this regex had to be changed from the javascript version.
	$special = "#[\~\`\!\@\#\$\%\^\&\*\(\)\_\-\+\=\{\}\[\\]\|\:\;\<\>\.\?\/\\\\]+#"; 
		
	//tests the string passed into the function for each required character
	if (preg_match($upper, $password))
		$upperOK = true;

	if (preg_match($minMaxLength, $password))
		$minMaxLengthOK = true;

	if (preg_match($lower, $password))
		$lowerOK = true;

	if (preg_match($number, $password))
		$numberOK = true;

	if (preg_match($special, $password))
		$specialOK = true;
		//var_dump($specialOK);
	
	//if all required characters are true, validation is positive
	if ($upperOK && $lowerOK && $numberOK && $specialOK && $minMaxLengthOK){
		$passwordOK = true;
	//	var_dump($passwordOK);
		return true;
	} else {
		$passwordOK = false;
	//	var_dump($passwordOK);
		
	}
	
	//passes false to be used to validateFields function
	if ($passwordOK == false){	
		//phpAlert('Complexity requirments: 1 Uppercase, 1 Lowercase, 1 Special Character, minimum length 8 not met');
		return false;
	} else {
		return true;
	}
 		
}
?>


<?php
//validates password and matchpassword are the same
function matchPassword(){
	global $password;
	global $verifypassword;
	
	$matchOK = false;
	
	
	if ($verifypassword == $password){
		$matchOK = true;
		//return true;
	}
	if ($matchOK == false){
		//phpAlert('Passwords do not match.');
		return false;
	} else {
		return true;
	}

}
?>

<?php

//validates email entered is the form something@something.something.  this is simple validation but covers majority of cases.  some corner cases may be allowed to pass this.
function validateEmail(){
        global $email;
	
	//regular expression to check for pattern
	
   	$pattern = "/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/";
	
	//tests string passed to function if it meets pattern 
	if (preg_match($pattern, $email)){
		return true;
	} else {
               // phpAlert('Email not validate');
		return false;
	}
}
?>



<?php

//ensures zipcode entered is either 5 or 9 digits.
function validateZipLength(){
        global $zipCode; 

	$zipCodeLength = strlen($zipCode); 


        if ($zipCodeLength > 5){

             $zipCodeLength -=1; // -1 to account for the - added by the force format function
        }


	if ($zipCodeLength < 5){
            return false;
        }
	if ($zipCodeLength > 5){
        if ($zipCodeLength != 9){
            return false;
		}
	}
return true;
}
?>

<?php
function validatePhoneLength(){
           global $phonenumber;
           $phoneNumberLength = strlen($phonenumber);
//var_dump($phoneNumberLength );
           if (!($phoneNumberLength == 13)){
//echo "!= 13 " . var_dump($phoneNumberLength );
               return false;
           }

           if ($phoneNumberLength == 13){
//echo "= 13 " . var_dump($phoneNumberLength );
				return true;
			}
}
?>



<?php

//function calls each of the validation functions and receives either true or false.  if false is received on any one field, the submission does not occur and the field box
//is highlighted red and an alert appears prompting the user as to the error.
function validateFields(){
	if (validateUsername()){
		
	}
	else {
		
	
		return false;
	}
	
	if (validateEmail()){
	}
	else {
		

		return false;
	}
	
	if (validatePassword()){
	}
	else {
		

		return false;
	}
	
	if (matchPassword()){
	} 
	else {
		
		return false;
	}

	if (validatePhoneLength()){
	}
	else {
		return false;
	}
	
	if (validateZipLength()){
	}
	else {
		return false;
	}

return true;
	
}

?>

<?php

?>


</body>
</html>	