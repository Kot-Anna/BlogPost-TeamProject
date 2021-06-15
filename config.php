<?php 
	session_start();


	// connect to database
    $conn = mysqli_connect("localhost:3307", "root", "root", "blog_php");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
    //    coming soon...

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/Team_Project/blog_rgh/');
?>