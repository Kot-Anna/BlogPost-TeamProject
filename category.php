<?php require_once('config.php')?>
<?php include('include/public_functions.php'); ?>

   <!-- Header section -->
<?php include( ROOT_PATH . '/include/header_section.php')?>

<?php 
	// Get posts under a particular topic
	if (isset($_GET['topic'])) {
		$topic_id = $_GET['topic'];
		$posts = getPublishedPostsByTopic($topic_id);
	}
?>

<title>Small | Categories</title>
</head>
<body>

<!-- Navbar -->
<?php include( ROOT_PATH . '/include/navbar.php')?>
 
<main class="main-category">
    <div class="container">
    <h1 class="topic"><?php echo getTopicNameById($topic_id);?></h1>

    <div class="category-slots">
    <?php foreach ($posts as $post): ?>
    
        <a href="article.php?post-slug=<?php echo $post['slug']; ?>">
        <div class="category-page">
            <div class="category-pic">
            <img src="<?php echo BASE_URL . '/static/img/' . $post['image']; ?>" alt="4">
            </div>
            <div class="text-container">
                <div class="border">
                    <h4 class="category"><?php echo getTopicNameById($topic_id) . "/" . date("F j, Y ", strtotime($post["created_at"]));?></h4>
                    <h3 class="category-article-title"><?php echo $post['title'] ?></h3>
                </div>
                <p class="category-text"><?php echo substr($post['body'], 0, 200) . " ...";?> </p>
            </div>
        </div> </a>
    <?php endforeach ?>
</div> 

</main>
<?php include( ROOT_PATH . '/include/footer.php') ?>