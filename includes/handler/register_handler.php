<?php
	//sanitize passwords fields
	function sanitizePasswords($inputtext){
		$inputtext=strip_tags($inputtext);
		return $inputtext;
	}

	//sanitize Emails fields
	function sanitizeEmails($inputtext){
		$inputtext=strip_tags($inputtext);
		$inputtext=str_replace(" ", "", $inputtext);
		return $inputtext;
	}

	//sanitize username,firstname,lastname fields
	function sanitizeUserForm($inputtext){
		$inputtext=strip_tags($inputtext);
		$inputtext=str_replace(" ", "", $inputtext);
		return $inputtext;
	}

	function sanitizeFirstLastNamesForm($inputtext){
		$inputtext=strip_tags($inputtext);
		$inputtext=str_replace(" ", "", $inputtext);
		$inputtext=ucfirst(strtolower($inputtext));
		return $inputtext;
	}

	//when registerButton pressed
	if (isset($_POST['registerButton'])) {
		$password=sanitizePasswords($_POST['password']);
		$password2=sanitizePasswords($_POST['password2']);
		$username=sanitizeUserForm($_POST['username']);
		$firstName=sanitizeFirstLastNamesForm($_POST['firstName']);
		$lastName=sanitizeFirstLastNamesForm($_POST['lastName']);
		$email=sanitizeEmails($_POST['email']);
		$email2=sanitizeEmails($_POST['email2']);


		//Check if user registeration was succesful 
		$Succesful=$account->register($username,$firstName,$lastName,$email,$email2,$password,$password2);
		if ($Succesful) {
			$_SESSION['userLoggedIn']=$username;
			header("Location: index.php");
		}

	}




?>