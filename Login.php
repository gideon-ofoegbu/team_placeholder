<?php
	require_once ("include/db.php");
	session_start();
?>

<?php
$loginerror = "";
$emailerror = "";
$passworderror_login = "";
	if(isset($_POST['submit_login'])){
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		
		if(empty($email)){
			$emailerror = "<div class='email_error'>Email cannot be empty!</div>";
		}else if(empty($password)){
			$passworderror = "<div class='email_error'>Password cannot be empty!</div>";
		}else{
			$request = "SELECT * FROM register WHERE email = '$email'";
			$query = mysqli_query($connect, $request);
			if(mysqli_num_rows($query) > 0){
			while($data = mysqli_fetch_assoc($query)){
				$pass = $data['password'];
				}
				if(PASSWORD_VERIFY($password, $pass)){
					$_SESSION['email'] = "blah";
					header("location: index.php");
				}else{
					$loginerror = "<div class='failure'>incorrect password</div>";
				}
			}else{
				$loginerror = "<div class='failure'>email does not exist</div>";
			}
		}
		
	}
?>

<?php
$signup_status = "";
$nameerror = "";
$lnameerror = "";
$unameerror = "";
$emeerror = "";
$passworderror = "";
$cpassworderror = "";
$passerror = "";
	if(isset($_POST['submit_register'])){
		$firstname = mysqli_real_escape_string($connect, $_POST['fname']);
		$lastname = mysqli_real_escape_string($connect, $_POST['lname']);
		$username = mysqli_real_escape_string($connect, $_POST['uname']);
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		$confirmpassword = mysqli_real_escape_string($connect, $_POST['cPassword']);
		
		$hashpassword = password_hash($password, PASSWORD_DEFAULT);
		
		if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirmpassword)){
			$signup_status = "<div class='failure'>fields cannot be empty!</div>";
		}else if($password !== $confirmpassword){
			$passerror = "<div class='email_error'>Passwords do not match!</div>";
		}else{
			$insert = "INSERT INTO register(firstname, lastname,  username, email, password)VALUES('$firstname', '$lastname', '$username', '$email', '$hashpassword')";
			$query = mysqli_query($connect, $insert);
			/*$result = mysqli_num_rows($query);
			if($result > 0){
				$loginerror = "SIgn up successful";
			}else{
				$loginerror = "error";
				}
			}*/
			if($query){
				$signup_status = "<div class='success'>Sign up successful</div>";
				
			}else{
				$signup_status = "<div class='failure'>Sign up failed</div>";
				}
			}
	}
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property="og:locale:alternate" content="en_US" />
</head>
<body>
	<header>
		
	</header>
		<div class="modal">
			<div class="modal-content">
				<div class="left">
					<h2>Welcome <br>To<br> PlaceHolder</h2>
				</div>
		    
				<div class="right">
					<div class="login">
					  <h2>Sign In</h2>
						<?php echo $loginerror; ?>
						<form id="loginform" action="Login.php" method="post">
							<input type="email" name="email" placeholder="Email Address" required>
							<?php echo $emailerror; ?>
							<br><br>
							<input type="password" name="password" placeholder="Password" required>
							<?php echo $passworderror_login; ?>
							<br><br>
							<input type="checkbox" name="remember-me" checked> Remember me
							<a class="rpsw" href="forgetpassword.html">forget password?</a>
							<br><br>
							<input type="submit" name="submit_login" value="Continue">
							<br><br>
						</form>

						<p> New User? Please<button class="reg">create account</button></p>
					</div>
					<div class="signUp">
					  <h2>Register</h2>
						<?php echo $signup_status;?>
						<form name="regform" action="Login.php" onsubmit="return validateForm()" method="post">
							<input type="text" name="fname" placeholder="First Name" minlength="4" maxlength="9" required>
							<?php //echo $nameerror; ?>
							<br><br>
							<input type="text" name="lname" placeholder="Last Name" minlength="4" maxlength="9" required>
							<?php //echo $lnameerror; ?>
							<br><br>
							<input type="text" name="uname" placeholder="Username" minlength="2" maxlength="9" required>
							<?php //echo $unameerror; ?>
							<br><br>
							<input type="email" name="email" placeholder="Email Address" required>
							<?php //echo $emeerror; ?>
							<br><br>
							<input type="password" name="password" placeholder="Password" minlength="6" required>
							<?php //echo $passworderror;?>
							<br><br>
							<input type="password" name="cPassword" placeholder="Confirm Password" minlength="6" required>
							<?php //echo $cpassworderror;?>
							<?php echo $passerror; ?>
							<br><br>			
							<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
							<br><br>
							<input type="submit" name="submit_register" value="Continue">
						</form>
						<p> Existing User? Please<button class="log">Login</button></p>
					</div>    
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="JS/login.js"></script>

</body>
</html>