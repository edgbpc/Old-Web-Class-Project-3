
//jquery datepicker function
$( document ).ready(function(){
    $( "#datepicker" ).datepicker();
  } )

  
  //would only work in firefox.  not implemented	
$(function(){
  $("#headerDiv").load("header.html"); 
  $("#footer").load("footer.html"); 
});



 
//function to test onblur.
//function just to check for correct syntax during development
function checkonblur(){
	
	alert("lost focus");
	
}

//helper functions.
//following functions are used with the funciton validatefields in order to ensure each form field is entered according 
//requirements set.  helper function returns either true or false which validateFields will use to pass true to false allowing
//for the form to be submitted if true is passed or interrupting the submission if false is passed.

//validates username is minimum number of characters.  max characters is governed by the HTML 5 code.


function validateUsername(){
	var username = document.getElementById("username");
	username = username.value;
	
	var elementLength = username.length;
	
	//alert(elementLength);
	
	var compareToLength = 6;
	
	
	if (elementLength){
		if (elementLength >= compareToLength){
			document.getElementById('userNameErr').innerHTML = '';
			return true;
		}else{
			//alert("Insufficient length.  Must be at least " + compareToLength + " characters.");
			document.getElementById("userNameErr").innerHTML = 'Must be at least 6 characters.';
			document.getElementById("username").style.borderColor = "red";
			return false;
		}
	}
}

//validates password meets minimum complexity requirements
function validatePassword() {
	var password = document.getElementById("pwd");
	password = password.value;
	
	//alert("password is " + password);
	
	//initalize all variables to false to ensure that a correct character type is revealed. 
	//validaiton only positive when all variables switch to true
	var passwordOK = false;
	var upperOK = false;
	var lowerOK = false;
	var numberOK = false;
	var specialOK = false;
	var minMaxLengthOK = false;
	
	//regular expressions for to check for required character.  
    var minMaxLength = /^[\s\S]{8,32}$/,
        upper = /[A-Z]/,
        lower = /[a-z]/,
        number = /[0-9]/,
        special = /[ !"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]/;
		
	//tests the string passed into the function for each required character
	if (upper.test(password))
		upperOK = true;
	if (minMaxLength.test(password))
		minMaxLengthOK = true;
	if (lower.test(password))
		lowerOK = true;
	if (number.test(password))
		numberOK = true;
	if (special.test(password))
		specialOK = true;
	
	//if all required characters are true, validation is positive
	if (upperOK && lowerOK && numberOK && specialOK && minMaxLengthOK){
		passwordOK = true;
		document.getElementById('passwordErr').innerHTML = '';
		return true;
	} else {
		passwordOK = false;
	}
	
	//passes false to be used to validateFields function
	if (passwordOK == false){	
		//alert("Complexity requirments: 1 Uppercase, 1 Lowercase, 1 Special Character, minimum length 8 not met");
		document.getElementById('passwordErr').innerHTML = "Complexity requirments not met";
		document.getElementById('pwd').style.borderColor = "red";

	return false;
	
	} else {
		
		return true;
	}
 		
}


//validates password and matchpassword are the same
function matchPassword(){
	var matchPassword = document.getElementById("verifypwd");
	
	var originalPassword = document.getElementById("pwd");
	var matchOK = false;
	
	//alert("matchpass funct");
	
	if (matchPassword.value == originalPassword.value){
		document.getElementById('verifyPasswordErr').innerHTML = "";
		matchOK = true;
		//return true;
	}
	if (matchOK == false){
	//	alert("Passwords do not match.");
		document.getElementById('verifyPasswordErr').innerHTML = "Passwords do not match.";
		document.getElementById('verifypwd').style.borderColor = "red";
		return false;

	} else {
		return true;
	}

	
	//alert("matchPassword is " + matchPassword + "and" + "originalPassword is" + originalPassword.value);
	
}


//validates email entered is the form something@something.something.  this is simple validation but covers majority of cases.  some corner cases may be allowed to pass this.
function validateEmail(){
	var emailToCheck = document.getElementById("email");
	emailToCheck = emailToCheck.value;
	
	//regular expression to check for pattern
   	var pattern = /^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/;
	
	//tests string passed to function if it meets pattern 
	if (pattern.test(emailToCheck)){
		document.getElementById('emailErr').innerHTML = '';
		return true;
	} else {
		//alert("Invalid email address.");
		document.getElementById('emailErr').innerHTML = "Invalid email address."
		document.getElementById('email').style.borderColor = "red";
		return false;
	}
}


//autoformates zipcode in form of XXXXX-XXXX.
function formatZipCode(zipCode){
	if (zipCode){
		switch (zipCode.value.length){
			case 1:
				zipCode.value = zipCode.value.replace(/[^0-9]/g, "");
				break;
			case 2:
				zipCode.value = zipCode.value.replace(/[^0-9]/g, "");
				break;
			case 3:
				zipCode.value = zipCode.value.replace(/[^0-9]/g, "");
				break;
			case 4:
				zipCode.value = zipCode.value.replace(/[^0-9]/g, "");
				break;
			case 5:
				zipCode.value = zipCode.value.replace(/[^0-9]/g, "");
				zipCode.value = zipCode.value + '-';
				break;
			case 6:
				zipCode.value = zipCode.value.replace(/[^0-9\-]/g, "");
				break;
			case 7:
				zipCode.value = zipCode.value.replace(/[^0-9\-]/g, "");
				break;
			case 8:
				zipCode.value = zipCode.value.replace(/[^0-9\-]/g, "");
				break;
			case 9:
				zipCode.value = zipCode.value.replace(/[^0-9\-]/g, "");
				break;
			case 10:
				zipCode.value = zipCode.value.replace(/[^0-9\-]/g, "");
				break;
			case 11:
				zipCode.value = zipCode.value.replace(/[^0-9\-]/g, "");
				break;
			default:
				break;
		}
	}
}


//ensures zipcode entered is either 5 or 9 digits.
function validateZipLength(zipLength){
	var zipLength = zipLength.value;
	//alert("Ziplength is " + zipLength.length);
	
	switch(zipLength.length){
		case 1:
		case 2:
		case 3: 
		case 4:
			//alert("Zip Code invalid.  Zip Codes must be either 5 or 9 digits");
			document.getElementById('zipCodeErr').innerHTML = "Zip code must be 5 or 9 digits";
			document.getElementById('zipCode').style.borderColor = "red";
			break;
		case 5: 
		case 6:
			document.getElementById('zipCodeErr').innerHTML = "";
			break;
		case 7:
		case 8:
		case 9:
			//alert("Zip Code invalid.  Zip Codes must be either 5 or 9 digits");
			document.getElementById('zipCodeErr').innerHTML = "Zip code must be 5 or 9 digits";
			document.getElementById('zipCode').style.borderColor = "red";

			break;
		case 10:
			document.getElementById('zipCodeErr').innerHTML = "";
		default:
			break;
	}	
}

function validatePhoneLength(){
	var phoneNumber = document.getElementById("phonenumber");
	phoneNumber = phoneNumber.value;
	
	var phoneNumberLength = phoneNumber.length;
		
		if (phoneNumberLength < 13){
			document.getElementById('phoneNumberErr').innerHTML = "Invalid phone number.";
			document.getElementById('phonenumber').style.borderColor = "red";
			return false;
        }

        if (phoneNumberLength == 13){
			document.getElementById('phoneNumberErr').innerHTML = "";
			return true;
			}
}
    
//autoformates phone number in form of (XXX)XXX-XXXX.
//developed in class
function formatPhone(phoneElement) {

	if (phoneElement) {
		
		switch(phoneElement.value.length) {
			case 1:
				if (phoneElement.value != '(') {
					phoneElement.value = '(' + phoneElement.value;
					phoneElement.value = phoneElement.value.replace(/[^0-9\(]/g, "");
				}
				break;
			case 2:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(]/g, "");
				break;
			case 3:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(]/g, "");
				break;
			case 4:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(]/g, "");
				phoneElement.value = phoneElement.value + ')';
				break;
			case 5:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(\)]/g, "");
				break;
			
			case 6:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(\)]/g, "");
				break;
			case 7:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(\)]/g, "");
				break;
			case 8:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(\)]/g, "");
				phoneElement.value = phoneElement.value + '-';
				break;
			case 9:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(\)\-]/g, "");
				break;
			case 10:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(\)\-]/g, "");
				break;
			case 11:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(\)\-]/g, "");
				break;
			case 12:
				phoneElement.value = phoneElement.value.replace(/[^0-9\(\)\-]/g, "");
				break;
			default:
				break;
		}
		
	}
	
}



//function calls each of the validation functions and receives either true or false.  if false is received on any one field, the submission does not occure and the field box
//is highlighted red and an alert appears prompting the user as to the error.
/* function not used 
function validateFields(){
	if (validateUsername()){
		
	}
	else {
		alert("Username length insufficient.");
		document.getElementById('username').style.borderColor = "red";
		return false;
	}
	
	if (validateEmail()){
	}
	else {
		alert("Email Invalid");
		document.getElementById('email').style.borderColor = "red";
		return false;
	}
	
	if (validatePassword()){
	}
	else {
		alert("Complexity requirments: 1 Uppercase, 1 Lowercase, 1 Special Character, minimum length 8 not met")
		document.getElementById('pwd').style.borderColor = "red";
		return false;
	}
	
	if (matchPassword()){
	} 
	else {
		alert("Passwords do not match.");
		document.getElementById('verifypwd').style.borderColor = "red";
		return false;
	}

	
}
*/

//function changes field back to the null value when focus is lost on a field
function changeToBlack(formelement){
	formelement.style.borderColor = null;
}
