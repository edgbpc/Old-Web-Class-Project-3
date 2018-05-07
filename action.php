<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="CS 3010 Project 1" />
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

//assign form field values to a variable
$username=$_POST['username'];
$email=$_POST['email'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$zipcode=$_POST['zipcode'];
$date=$_POST['date'];
$password=$_POST['pwd'];
$verifypassword=$_POST['verifypwd'];
$phonenumber=$_POST['phonenumber'];
$Address1=$_POST['Address1'];
$Address2=$_POST['Address2'];
$City=$_POST['City'];
$state=$_POST['state'];

//echo validateUsername();

 //var_dump (validatePassword());
 //var_dump (matchPassword());
 //var_dump(validateEmail());
//var_dump(validateZipLength());
//testing variables



echo $email;
echo $firstname;
echo $lastname;
echo $zipcode;
echo $date;
echo $password;
echo $verifypassword;
echo $phonenumber;
echo $Address1;
echo $Address2;
echo $City;
echo $state;




?>

</html>
</body>