 <?php  include('config.php'); ?>   

 <?php require_once( ROOT_PATH . '/include/public_functions.php')?>
 
    <!-- Header section -->
<?php include('include/header_section.php')?>

<!-- Redirecting to the index page if someone not logged in is trying to access personal profile -->

<?php
if(isset($_GET['id'])){
    $guestId = $_GET['id'];
    $profile = userById($guestId);
  }
?>


<title>Profile</title>
  </head>
  <body>
    
<!-- Navbar -->
<?php include('include/navbar.php')?>

<?php $posts = getPostListByUser($guestId) ?>

    <main>
      <div class="container">
        <div class="profile-card">
          <div class="profilecard-bg"></div>
          <div class="profilecard-bottom">
            <div class="profilecard-bottom-left">
              <img src="<?php echo BASE_URL . '/static/profile_img/' . $profile['profile_pic']?>" alt="pf" />
              <table>
                <tbody>
                  <tr>
                    <td>Email:</td>
                    <td class="per-info"><?php echo $profile['email'] ?></td>
                  </tr>
                  <tr>
                    <td>Gender:</td>
                    <td class="per-info"><?php echo $profile["gender"] ?></td>
                  </tr>
                </tbody>
              </table>
           
            </div>
            <div class="profilecard-bottom-right">
              <h1 class="main-profile-name"><?php echo $profile['fname'] ?></h1>
              <span class="location"
                ><i class="fas fa-map-marker-alt"></i><?php echo $profile["city"] ?></span
              >
              <h4 class="user-name">@<?php echo $profile['uname'] ?></h4>
              <hr />
              <h2 class="about-me-title">About me</h2>
              <p class="about-me">
                <?php echo $profile["about"] ?>
              </p>
            </div>
          </div>
        </div>
                    

        <div class="my-posts">
          <h2><?php echo $profile['fname'] ."'s"?> Posts</h2>
          <table class="posts">
            <tbody>
              <?php foreach($posts as $post) :?>
                    <tr>
                      <td class='post-title'>
                        <a href='article.php?post-slug=<?php echo $post['slug']?>'><?php echo $post['title'] ?></a>
                      </td>
                      
                     </tr>
                
              <?php endforeach ?> 
            </tbody>
          </table>
        </div>

      </div>
    </main>

    <?php include('include/footer.php') ?>