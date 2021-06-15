<?php require_once('config.php')?>

<?php  include('include/registration_login.php'); ?>
    <!-- Header section -->
   
<?php include('include/header_section.php')?>
 
<title>Sign up</title>
  </head>
  <body>
    
<!-- Navbar -->
<?php include('include/navbar.php')?>

    <main>
      <div class="container">
        <div class="sign-up">
          <h1>Sign up</h1>
          <form method="POST" action="signup.php" class="signup-form">
          <?php include(ROOT_PATH . '/include/errors.php') ?>

            <div class="form-group">
              <i class="fas fa-exclamation not-ok"></i>
              <i class="far fa-check-circle ok"></i>
              <input type="text" name="name" id="name" placeholder="Name" class="form-control is-valid" value="<?php echo $fname; ?>"/>
              <div class="invalid-feedback">
                Name should not contain any special character or number
              </div>
            </div>

            <div class="form-group">
              <i class="fas fa-exclamation not-ok"></i>
              <i class="far fa-check-circle ok"></i>
              <input type="text" name="username" id="username" placeholder="Userame" class="form-control is-valid" value="<?php echo $uname ?>"/>
              <div class="invalid-feedback">
                Username can be 3 to 20 characters and can contain letters, numbers, underscore, dash or dot
              </div>
            </div>

            <div class="form-group">
              <i class="fas fa-exclamation not-ok"></i>
              <i class="far fa-check-circle ok"></i>
              <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?php echo $email ?>"/>
              <div class="invalid-feedback">
                Invalid email declaration
              </div>
            </div>

            <div class="form-group">
              <i class="fas fa-exclamation not-ok"></i>
              <i class="far fa-check-circle ok"></i>
              <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control" value="<?php echo $phone ?>"/>
               <div class="invalid-feedback">
                Invalid phone number declaration
              </div>
            </div>
            
            <div class="form-group">
              <i class="fas fa-exclamation not-ok"></i>
              <i class="far fa-check-circle ok"></i>
                <input
              type="password"
              name="password_1"
              id="password"
              placeholder="Password"
              class="form-control"
              
            />
             <div class="invalid-feedback">
                <ul>
                  <li class="lowerCase tick">The password must contain at least 1 lowercase alphabetical character</li>
                  <li class="upperCase">The password must contain at least 1 uppercase alphabetical character</li>
                  <li class="numeric">The password must contain at least 1 numeric character</li>
                  <li class="eightchar">The password must be eight characters or longer</li>
                </ul>
              </div>
            </div>
            
            <div class="form-group">
              <i class="fas fa-exclamation not-ok"></i>
              <i class="far fa-check-circle ok"></i>
              <input
              type="password"
              name="password_2"
              id="password2"
              placeholder="Password"
              class="form-control"
            />
             <div class="invalid-feedback">
               Passwords does not match
              </div>
            </div>

            <!-- <div class="gender">
              <input type="radio" name="gender" id="female" checked />
              <label class="gender-text" for="female">Female</label>

              <input type="radio" name="gender" id="male" />
              <label class="gender-text" for="male">Male</label>

              <input type="radio" name="gender" id="other" />
              <label class="gender-text" for="other">Other</label>
            </div> -->
            <!-- <textarea name="aboutme" id="" placeholder="About me"></textarea> -->
            <button name="reg_user" type="submit" class="btn">Sing up</button>
          </form>
        </div>
      </div>
    </main>

    <script src="signup.js"></script>
    <?php include('include/footer.php') ?>
