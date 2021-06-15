<?php date_default_timezone_set('Europe/Helsinki') ?>
<?php 
	// variable declaration
	$fname = "";
	$uname = "";
	$email    = "";
	$phone = "";
	// $pass1 = "";
	// $pass2 = "";
	$errorlist = array(); 
	$timestamp = date("Y-m-d H:i:s");

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$fname = esc($_POST['name']);
		$uname = esc($_POST['username']);
		$email = esc($_POST['email']);
		$phone = esc($_POST['phone']);
		$pass1 = esc($_POST['password_1']);
		$pass2 = esc($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($fname)) {  array_push($errorlist, "Name is empty"); }
		if (empty($uname)) {  array_push($errorlist, "Username is required"); }
		if (empty($email)) { array_push($errorlist, "Email is empty"); }
		if (empty($phone)) { array_push($errorlist, "Phone is empty"); }
		if (empty($pass1)) { array_push($errorlist, "Missing password"); }
		if ($pass1 != $pass2) { array_push($errorlist, "Passwords do not match");}

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE uname='$uname' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $uname) {
			  array_push($errorlist, "Username already exists");
			}
			if ($user['email'] === $email) {
			  array_push($errorlist, "Email already exists");
			}
		}
		// register user if there are no errorlist in the form
		if (count($errorlist) == 0) {
			$password = md5($pass1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (fname, uname, email,password, phone, created_at) 
					  VALUES('$fname','$uname', '$email','$password','$phone', '$timestamp')";
			mysqli_query($conn, $query);

			// get id of created user
			$reg_user_id = mysqli_insert_id($conn); 

			// put logged in user into session array
			//$_SESSION['user'] = getUserById($reg_user_id);

			// if user is admin, redirect to admin area
			// if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
			// 	$_SESSION['message'] = "You are now logged in";
			// 	// redirect to admin area
			// 	header('location: ' . BASE_URL . 'admin/dashboard.php');
			// 	exit(0);
			// } else {
           // $_SESSION['message'] = "You are now logged in"; 
            // redirect to public area
            header('location: index.php?register=true');				
            exit(0);
			
		}
	}

	// LOG USER IN
	if (isset($_POST['login'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errorlist, "Username required"); }
		if (empty($password)) { array_push($errorlist, "Password required"); }
		if (empty($errorlist)) {
			$password = md5($password); // encrypt password
			$sql = "SELECT * FROM users WHERE uname='$username' and password='$password' LIMIT 1";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				// get id of created user
				$reg_user_id = mysqli_fetch_assoc($result)['id']; 

				// put logged in user into session array
				$_SESSION['user'] = getUserById($reg_user_id); 

				// if user is admin, redirect to admin area
				// if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
				// 	$_SESSION['message'] = "You are now logged in";
				// 	// redirect to admin area
				// 	header('location: ' . BASE_URL . '/admin/dashboard.php');
				// 	exit(0);
				// } else {
					$_SESSION['message'] = "You are now logged in";
					// redirect to public area
					header('location: index.php');				
					// exit(0);
				
			} else {
				array_push($errorlist, 'Wrong credentials');
			}
		}
	}
	// escape value from form
	function esc(String $value)
	{	
		// bring the global db connect object into function
		global $conn;

		$val = trim($value); // remove empty space sorrounding string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Get user info from user id
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		// returns user in an array format: 
		// ['id'=>1 'username' => 'Awa', 'email'=>'a@a.com', 'password'=> 'mypass']
		return $user; 
	}
?>