<?php  include('config.php'); ?>
    <!-- Header section -->
<?php include('include/header_section.php')?>

<!-- Redirecting to the index page if someone not logged in is trying to access edit profile -->
<?php if(!isset($_SESSION['user'])){
  header("location: index.php");
} ?>

<?php
$loggeduser = $_SESSION['user']['id'];
$user_change = "SELECT * FROM users WHERE id=$loggeduser LIMIT 1";
$result = mysqli_query($conn, $user_change);
$user = mysqli_fetch_assoc($result);
?>
<?php $errorlist = $_SESSION['errorlist']?>

<title>Edit Profile</title>
  </head>
  <body>
    
<!-- Navbar -->
<?php include('include/navbar.php')?>

    <main>
      <div class="container">
        <div class="sign-up">
          <h1>Edit Profile  </h1> 
      <div class = "errorlistprofile"><?php include("include/errors.php");?> </div>
      <?php unset($_SESSION['errorlist']); $errorlist =[];?> 
		  <div class="preview-img">
			<img src="<?php echo BASE_URL . '/static/profile_img/' . $user['profile_pic']?>" class="output-img" alt="pf-img">
		  </div>
     <form action="include/profileupload.php" method="POST" enctype="multipart/form-data" class="signup-form">
        <label for="fileToUpload" class="costumUpload"><i class="fas fa-upload"></i>Upload Profile Image</label>
        <input type="file" name="file" id="fileToUpload"> <br>	
        <label for="name">Name</label>
        <input type="text" name="edit-name" id="name" value="<?php echo $user['fname']?>"/>
        <label for="email">Email</label>
        <input type="email" name="edit-email" id="email" value="<?php echo $user['email']?>"/>
        <label for="phone">Phone</label>
        <input type="number" name="edit-phone" id="phone"value="<?php echo $user['phone']?>"/>
        <label for="city">City</label>
        <input type="text" name="edit-city" id="city"value="<?php echo $user['city']?>"/>
        <div class="gender">
          <input type="radio" name="edit-gender" id="female" value="Female" <?php if($user["gender"]=== "Female" ){echo checked;} ?>/>
          <label class="gender-text" for="female">Female</label>

          <input type="radio" name="edit-gender" id="male" value="Male" <?php if($user["gender"]=== "Male" ){echo checked;} ?> />
          <label class="gender-text" for="male">Male</label>

          <input type="radio" name="edit-gender" id="other" value="Other" <?php if($user["gender"]=== "Other" ){echo checked;} ?> />
          <label class="gender-text" for="other">Other</label>
        </div>
        <textarea name="edit-aboutme" id="" placeholder="About me"><?php echo $user['about']?></textarea>
        <button name = "submitedit" type="submit" class="btn">Save</button>
      </form>
        </div>
      </div>
    </main>
    <script src="editProfile.js"></script>
    <?php include('include/footer.php') ?>
