<?php
  /**
  * 
  */
  class Account 
  {
  	private $con;
  	private $errorArray;
  	public function __construct($con)
  	{
  		$this->con=$con;
  		$this->errorArray=array();
  	}

  	public function login($un,$pw){

  		$pw=md5($pw);

  		//call username and password from users table 
  		$query=mysqli_query($this->con,"SELECT * FROM `users` WHERE `username`='$un' AND `password`='$pw' ");

  		if (mysqli_num_rows($query)==1) {
  			return true;
  		}
  		else{
  			//Checking usernme or password if it's incorrect
  			array_push($this->errorArray, Constants::$loginFailed);
  			return false;
  		}
  	}


  	public function register($un,$fn,$ln,$em,$em2,$pw,$pw2){
  		$this->validateUsername($un);
  		$this->validateFirstLastNames($fn,$ln);
  		$this->validateEmails($em,$em2);
  		$this->validatePsswords($pw,$pw2);

  		if (empty($this->errorArray)) {
  			//checking if user has no errors then send him to main page
  			return $this->insertUserData($un,$fn,$ln,$em,$pw);
  		}else{return false;}
  	}


  	public function getError($error)
	  	{
	  		if (!in_array($error, $this->errorArray)) {
	  			//error messages
	  			$error="";
	  		} else{ 
	  			//return error from Constants.php put it in span
	  			return "<span class='errorMessage'>$error</span>";
	  			 }
	  	}


	//Inserting user details into database  	
	private function insertUserData($un,$fn,$ln,$em,$pw)
		{
			//to encrypt user password
			$encryptedPassword=md5($pw);
			//(deafult)profile picture
			$profilePic="assets/images/profilPic.png" ;
			//Signup date
			$date=date("Y-m-d");

			//result will be inserted to users table
			$result=mysqli_query($this->con,"INSERT INTO `users`(`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signupDate`, `profilePic`) VALUES ('','$un','$fn','$ln','$em','$encryptedPassword','$date','$profilePic')");
			return $result;
		}

  	private function validatePsswords($pw,$pw2)
	  	{
		  		if ($pw!=$pw2) {
		  			//passwords should be match 
		  			array_push($this->errorArray, Constants::$passwords_DontMatch);
		  			return;

		  		} elseif (preg_match('/[^A-Za-z0-9]/', $pw)) {
		  			//password should be only English (numbers and letters) characters
		  			array_push($this->errorArray, Constants::$passwordsCharacters);
		  			return;
		  		}
		  		elseif (strlen($pw)>30 || strlen($pw)<6) {
		  			//checking length entry for password
		  			array_push($this->errorArray, Constants::$passwords_LengthChar);
		  			return;
		  	}
	    }
  	private function validateUsername($un){
  		if (strlen($un)>30 || strlen($un)<5)
  		 {
	  			//checking length entry for User name
	  			array_push($this->errorArray, Constants::$usernameLength);
	  			return;
	  		}

	  		//check if username already exists 
	  		$checkUsernameQuery=mysqli_query($this->con, "SELECT username FROM users WHERE username ='$un'");
	  		if (mysqli_num_rows($checkUsernameQuery)!= 0) {
	  			array_push($this->errorArray, Constants::$usernameExisting);
	  			return;
	  		}
  	     }

  	private function validateEmails($em,$em2){
	  	if ($em!=$em2) {
	  			//emails should be match 
	  			array_push($this->errorArray, Constants::$emails_DontMatch);
	  			return;
	  		} if (!filter_var($em,FILTER_VALIDATE_EMAIL)) {
	  			//checking email to be like this ex: username@mail.com
	  			array_push($this->errorArray, Constants::$email_InvalidFormat);
	  			return;
	  		}

	  		//check if email already exists 
	  		$checkEmailQuery=mysqli_query($this->con, "SELECT email FROM users WHERE email ='$em'");
	  		if (mysqli_num_rows($checkEmailQuery)!= 0) {
	  			array_push($this->errorArray, Constants::$emailExisting);
	  			return;
	  		}
	  		
	  	}

  	private function validateFirstLastNames($fn,$ln){
  		//checking length entry for First name
  		if (strlen($fn)>30 || strlen($fn)<3) {
  			array_push($this->errorArray, Constants::$firstNameLength);
  			return;
  		}
  		//checking length entry for Last name
  		elseif (strlen($ln)>30 || strlen($ln)<3) {
  			array_push($this->errorArray, Constants::$lastNameLength);
  			return;
  		}
  	}

  }

?>