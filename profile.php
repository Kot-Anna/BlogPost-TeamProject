 <?php  include('config.php'); ?>   

 <?php require_once( ROOT_PATH . '/include/public_functions.php')?>
 
    <!-- Header section -->
<?php include('include/header_section.php')?>

<!-- Redirecting to the index page if someone not logged in is trying to access personal profile -->


<?php 

// Check if user is logged or not, display appropriate own profile or other users profile
if(!isset($_SESSION['user'])){
  if(isset($_GET['guest'])){
    $guestId = $_GET['guest'];
      header("location: others.php?id=".$guestId);
  }else{
    header("location: index.php?accessdenied");
  }
}else{
  if($_SESSION['user']['id'] !== $guestId){
      if(isset($_GET['guest'])){
        $guestId = $_GET['guest'];
        if($_SESSION['user']['id'] !== $guestId){
          header("location: others.php?id=".$guestId);
        }
    }
  } 
  
}?>

<?php if(isset($_GET['delete'])){
  delete($_GET['delete']);
}
?>

<?php if(isset($_GET['publish'])){
  publish($_GET['publish']);
}
?>

<title>Profile</title>
    
  </head>
  <body>
    
<!-- Navbar -->
<?php include('include/navbar.php')?>

<?php $posts = getPostListByLoggedUser() ?>

    <main>
      <div class="container">
        <div class="profile-card">
          <div class="profilecard-bg"></div>
          <div class="profilecard-bottom">
            <div class="profilecard-bottom-left">
              <img src="<?php echo BASE_URL . '/static/profile_img/' . $_SESSION['user']['profile_pic']?>" alt="pf" />
             <h1 id="mobile-username" class="main-profile-name"><?php echo $_SESSION['user']['fname'] ?></h1>
              <table>
                <tbody>
                  <tr>
                    <td>Email:</td>
                    <td class="per-info"><?php echo $_SESSION['user']['email'] ?></td>
                  </tr>
                  <tr>
                    <td>Phone:</td>
                    <td class="per-info"><?php echo $_SESSION['user']['phone'] ?></td>
                  </tr>
                  <tr>
                    <td>Gender:</td>
                    <td class="per-info"><?php 
                    if(isset($_SESSION['user']["gender"])){
                     echo $_SESSION['user']['gender'];
                    }else{
                      echo '<a class="add-info" href="editProfile.php">Add gender</a>';
                    }
                    ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="left-btn">
                <a href="editProfile.php" class="btn edit">Edit Profile</a>
                <a href="createPost.php" class="btn new-post">New Post</a>
              </div>
            </div>
            <div class="profilecard-bottom-right">
              <h1 class="main-profile-name"><?php echo $_SESSION['user']['fname'] ?></h1>
              <span class="location"
                ><i class="fas fa-map-marker-alt"></i><?php 
                    if(isset($_SESSION['user']["city"])){
                     echo $_SESSION['user']['city'];
                    }else{
                      echo '<a class="add-info" href="editProfile.php">Add city</a>';
                    }
                    ?></span
              >
              <h4 class="user-name">@<?php echo $_SESSION['user']['uname'] ?></h4>
              <hr />
              <h2 class="about-me-title">About me</h2>
              <p class="about-me">
                <?php 
                    if(isset($_SESSION['user']["about"])){
                     echo $_SESSION['user']['about'];
                    }else{
                      echo '<a class="add-info" href="editProfile.php">Add about me</a>';
                    }
                    ?>
              </p>
            </div>
          </div>
        </div>


          <div class="my-posts">
          <h2>My Posts</h2>
          
            <ul class="buttons-list">
              <?php foreach($posts as $post) :?>
                    <li>
                      <div class="prof-article-name">
                        <a href='article.php?post-slug=<?php echo $post['slug']?>'><?php echo $post['title'] ?></a>
                     </div>
                      <div class="li-second">
                        <div class="buttons" >
                        <a href='<?php echo "createPost.php?slug=" . $post['slug'];?>' class='btn edit-btn'>Edit</a>
                      </div>
                      <div class="buttons" >
                        <a href="<?php echo "profile.php?delete=" . $post['id'] ?>"  class='btn delete-btn'>Delete</a>
                      </div>
                      <div class="buttons" >
                        <a href="<?php echo "profile.php?publish=" . $post['id'] ?>" class='btn publish-btn'>
                      <?php if($post['published']==='1'){
                          echo "Unpublish";
                        }elseif($post['published']==='0'){
                          echo "Publish";
                          };?>
                        </a>
                      </div>
                      </div>
                  </li>
                
              <?php endforeach ?> 
          </ul>
        </div>

      </div>
    </main>

    <?php include('include/footer.php') ?>