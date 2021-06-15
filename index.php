<?php require_once('config.php')?>
<?php  include('include/registration_login.php'); ?>

<?php require_once( ROOT_PATH . '/include/public_functions.php'); 
$featuredpost = getFeaturedPosts();
$timepost = getPublishedPosts();
$newestusers = getNewestUsers(); ?>


<!-- Header section -->
<?php include( ROOT_PATH . '/include/header_section.php')?>

<title>Small | Home</title>
  </head>
  <body>
    
<!-- Navbar -->
<?php include( ROOT_PATH . '/include/navbar.php')?>
    <div class="container trend trend-date">
      <div class="trending">Trending Now</div>
      <div class="trend-date"><?php echo "Today's date: " . date("d.m.Y") ?></div>
    </div>
    <main>

    <!-- Featured articles -->
    
      <section class="featured">
        <div class="container">
          <div class="row">
            <a href="article.php?post-slug=<?php echo $featuredpost[0]['slug'];?>">
              <div class="featured-box">
                <img src="<?php echo BASE_URL . '/static/img/' . $featuredpost[0]['image'];?>" alt="2" />
                <div class="middle">
                  <div class="mid-container">
                    <h2><?php echo $featuredpost[0]['title'];?></h2>
                    <div class="featured-category">
                    <?php echo $featuredpost[0]['name']?>
                    </div>
                    <p class="pub-date">
                      <span class="pub-aut"><?php echo $featuredpost[0]['fname'];?></span>  <?php $featuredtime = date("d.m.Y",strtotime($featuredpost[0]['created_at'])); echo $featuredtime;?>
                    </p>
                  </div>
                </div>
              </div>
            </a>
            <a href="article.php?post-slug=<?php echo $featuredpost[1]['slug'];?>">
              <div class="featured-box">
                <img src="<?php echo BASE_URL . '/static/img/' . $featuredpost[1]['image'];?>" alt="2" />
                <div class="middle">
                  <div class="mid-container">
                    <h2><?php echo $featuredpost[1]['title'];?></h2>
                    <div class="featured-category">
                    <?php echo $featuredpost[1]['name']?>
                    </div>
                    <p class="pub-date">
                      <span class="pub-aut"><?php echo $featuredpost[1]['fname'];?></span> <?php $featuredtime = date("d.m.Y",strtotime($featuredpost[1]['created_at'])); echo $featuredtime;?>
                    </p>
                  </div>
                </div>
              </div>
            </a>
            <a href="article.php?post-slug=<?php echo $featuredpost[2]['slug'];?>">
              <div class="featured-box">
                <img src="<?php echo BASE_URL . '/static/img/' . $featuredpost[2]['image'];?>" alt="2" />
                <div class="middle">
                  <div class="mid-container">
                    <h2><?php echo $featuredpost[2]['title'];?></h2>
                    <div class="featured-category">
                    <?php echo $featuredpost[2]['name']?>
                    </div>
                    <p class="pub-date">
                      <span class="pub-aut"><?php echo $featuredpost[2]['fname'];?></span>  <?php $featuredtime = date("d.m.Y",strtotime($featuredpost[2]['created_at'])); echo $featuredtime;?>
                    </p>
                  </div>
                </div>
              </div>
            </a>
        </div>
      </section>
      <div class="container trend">
      <div class="trending">Published Articles</div>
    </div>
    <main>
      <section class="articles">
          <div class="container">

            <div class="main-area" style="display:flex; flex-direction:column-reverse;">

                <?php foreach ($timepost as $post): ?>
                    <div class="big-article">
                    <div class="img-container">
                        <div class="big-article-category">

                        <?php if (isset($post['topic']['name'])): ?>
                          <a 
                            href="<?php echo BASE_URL . 'category.php?topic=' . $post['topic']['id'] ?>">
                            <?php echo $post['topic']['name'] ?>
                          </a>
                       <?php endif ?>
                        </div>
                        <img src= "<?php echo BASE_URL . '/static/img/' . $post['image'];?>" alt="4">
                    </div>
                    <div class="big-article-content">
                      <div class="article-info">
                        <div class="createdby">
                          <img src="<?php echo BASE_URL . '/static/profile_img/' . $post['author']['profile_pic']?>" alt="author">
                          <a class="creater" href="<?php echo "profile.php?guest=" . $post['author']['id'] ?>"><?php echo $post['author']['fname']?></a></a>
                        </div>
                        <div class="createdat">
                          <i class="fas fa-calendar-alt"></i><?php $timestamp = date("d.m.Y",strtotime($post['created_at'])); echo $timestamp;?>
                        </div>
                      </div>

                        <a href="article.php?post-slug=<?php echo $post['slug'];?>">
                        <h2><?php echo $post['title'];?></h2></a>

                        <p><?php echo substr( $post['body'], 0, 400);?> 
                        <a class="primary" href="article.php?post-slug=<?php echo $post['slug'];?>">Read more...</a></p>
                        <div class="feedbacks">
                          <div class="likes">
                            <i class="fas fa-eye"></i>
                            <span class="likedby"><?php echo $post['views'];?></span>
                          </div>
                          <div class="comments">
                            <i class="fas fa-comments"></i>
                            <span class="commentedby"><?php echo getAmountOfComments($post['id'])?></span>
                          </div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
                
            </div>

                <div class="sidebar">
                    <div class="side-users sticky">
                        <h2 class="side-label">RECENT USERS</h2>
                        <?php foreach ($newestusers as $user):?>
                        <div class="small-profile">
                            <div class="s-img">
                                <img src="<?php echo BASE_URL . '/static/profile_img/' . $user['profile_pic']?>" alt="profile_pict">
                                
                            </div>
                            <div class="s-content">
                                    <a href=" <?php echo "profile.php?guest=" . $user['id'] ?>"  ><h4><?php echo $user['fname'];?></h4></a>
                                    <h5>@<?php echo $user['uname'];?></h5>
                            </div>
                        </div>
                        <?php endforeach ?>
                      
                    </div>

                  </div>
                </div>
          
            </section>
            
    </main>

                  
    <?php include( ROOT_PATH . '/include/footer.php') ?>

           <!--  BIG ARTICLE
             <div class="big-article">
                    <div class="img-container">
                        <div class="big-article-category">
                        <a href="category.php">Life Style</a>
                        </div>
                        <img src="static/img/4.jpg" alt="4">
                    </div>
                    <div class="big-article-content">
                      <div class="article-info">
                        <div class="createdby">
                          <img src="static/img/profile-photo.jpg" alt="user">
                          <a class="creater" href="#">Cihan Erenler</a></a>
                        </div>
                        <div class="createdat">
                          <i class="fas fa-calendar-alt"></i>19 January 2021
                        </div>
                      </div>
                        <a href="article.php"><h2>It is a long established fact that will! </h2></a>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has  a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. <a class="primary" href="#">Read more...</a></p>
                        <div class="feedbacks">
                          <div class="likes">
                            <i class="fas fa-heart"></i>
                            <span class="likedby">1320</span>
                          </div>
                          <div class="comments">
                            <i class="fas fa-comments"></i>
                            <span class="commentedby">96</span>
                          </div>
                        </div>
                    </div>
                </div>
                </div> -->