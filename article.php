<?php require_once('config.php')?>
<?php  include('include/public_functions.php'); ?>
<?php date_default_timezone_set('Europe/Helsinki') ?>
<?php 
    if (isset($_GET['post-slug'])) {
      $post = getPost($_GET['post-slug']);
      $view = $post['views'] + 1;
      $i = $post["id"];
      $sql = "UPDATE posts SET views = $view WHERE id = $i";

      mysqli_query($conn, $sql);
    }
    $topics = getAllTopics();
?>

    <!-- Header section -->

<?php include('include/header_section.php')?>

<title>Small</title>
    <script>
          if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
          }
    </script>
  </head>
  <body>
    
<!-- Navbar -->
<?php include('include/navbar.php')?>
    <div class="container trend">
      <div class="trending">article</div>
    </div>
    <main>
      <section class="articles">
        <div class="container">
          <div class="main-area">
            <div class="full-article">
              <div style="position:relative" class="full-article-img">
                <div class="big-article-category">

                <?php if ($post['published'] == false): ?>
                <h1 class="full-label">Sorry... This post has not been published</h1>
                <?php else: ?>

                  <a href="<?php echo BASE_URL . 'category.php?topic=' . $post['topic']['id'] ?>"><?php echo $post['topic']['name'];?></a>
                </div>
                <img src="<?php echo BASE_URL . '/static/img/' . $post['image'];?>" alt="4" />
              </div>
              <div class="full-article-content">
                <div class="full-info">

                 

                <h1 class="full-label"><?php echo $post['title']; ?></h1>

                  <div class="article-info-prof">
                    <div class="small-profile">
                      <div class="s-img">
                        <img src="<?php echo BASE_URL . '/static/profile_img/' . $post['author']['profile_pic']?>" alt="author_pic" />
                      </div>
                      <div class="s-content">
                        <a href="<?php echo 'profile.php?guest=' . $post['author']['id'] ?>"><h4><?php echo $post['author']['fname'];?></h4></a>
                        <h5>@<?php echo $post['author']['uname'];?></h5>
                      </div>
                    </div>
                  <p class="date"><?php $timestamp = date("F j, Y ",strtotime($post['created_at'])); echo $timestamp;?></p>
                  </div>
                </div>

                <p class="full-text">
                <?php echo html_entity_decode($post['body']); ?>
                </p>
              </div>
              <div class="view-div">
                    <div id="post-like" class="likes ">
                            <i class="fas fa-eye"></i>
                            <span class="likedby"><?php echo $post['views'];?></span>
                  </div>
                 </div>
              <?php endif ?>
            </div>
            <div class="container trend">
              <div style="margin: 10px auto 0" class="trending">Comments</div>
            </div>
            <section class="comment">
            <?php getComments($post['id'])?>
              
              <!--  Write a comment -->
              <?php
                    if(!isset($_SESSION['user'])){
                    echo "<form method='POST' action='".setComments($post['slug'])."'>
                      <input name='uname' placeholder='Name'/>
                      <input type='hidden' name='postid' value='".$post['id']."'/>
                      <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'/>
                      <textarea name='message' placeholder='Comment'></textarea>
                      <button type='submit' class='btn' name='commentSubmit'>Send</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='".setComments($post['slug'])."'>
                      <input type='hidden' name='uname' value=".$_SESSION['user']['uname'].">
                      <input type='hidden' name='postid' value='".$post['id']."'/>
                      <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'/>
                      <textarea name='message' placeholder='Comment'></textarea>
                      <button type='submit' class='btn' name='commentSubmit'>Send</button>
                    </form>";}
                      ?>

           
            </section>
          </div>
          <div class="sidebar">
            <div class="side-users sticky">
              <div class="full-article-profile">
                <h2 class="article-profile-label">USER</h2>
                <div class="profile-cover"></div>
                <div class="article-profile-content">
                  <div class="article-profile-img">
                    <img src="<?php echo BASE_URL . '/static/profile_img/' . $post['author']['profile_pic']?>" alt="author_pic" />
                  </div>
                  <p><a href="<?php echo 'profile.php?guest=' . $post['author']['id'] ?>" class="name"><?php echo $post['author']['fname'];?></a></p>
                  <p class="user-name">@<?php echo $post['author']['uname'];?></p>
                  <p class="article-profile-info">
                    <?php echo substr($post['author']['about'],0,250) . "..." ?>
                  </p>
                  <div class="social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <?php include('include/footer.php') ?>
