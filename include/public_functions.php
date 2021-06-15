<?php 

/*  Returns all published posts */

function getPublishedPosts() {
	// use global $conn object in function
	global $conn;
	$sql = "SELECT * FROM posts WHERE published=true";
	$result = mysqli_query($conn, $sql);

	// fetch all posts as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['topic'] = getPostTopic($post['id']); 
		$post['author'] = getAuthorName($post['id']);
		array_push($final_posts, $post);
	}
	
	return $final_posts;
}

/* Fetching posts by views */
function getFeaturedPosts() {
	// use global $conn object in function
	global $conn;


	$sql = "SELECT p.*, postt.topic_id, tp.name, u.id, u.fname FROM posts p 
	LEFT JOIN users u on u.id = p.user_id
	LEFT JOIN post_topic postt
		LEFT JOIN topics tp on tp.id = postt.topic_id
	on p.id = postt.post_id 
	ORDER BY p.views DESC;";
	$result = mysqli_query($conn, $sql);

	// fetch all posts as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$mostviews=array_slice($posts,0,3);
	return $mostviews;
}

/* Receives a post id and returns topic of the post */

function getPostTopic($post_id){
	global $conn;
	$sql = "SELECT * FROM topics WHERE id=
			(SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$topic = mysqli_fetch_assoc($result);
	return $topic;
}

/* Returns all posts under a topic */
function getPublishedPostsByTopic($topic_id) {
	global $conn;
	$sql = "SELECT * FROM posts ps 
			WHERE ps.id IN 
			(SELECT pt.post_id FROM post_topic pt 
				WHERE pt.topic_id=$topic_id GROUP BY pt.post_id 
				HAVING COUNT(1) = 1)";
	$result = mysqli_query($conn, $sql);
	// fetch all posts as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['topic'] = getPostTopic($post['id']); 
		array_push($final_posts, $post);
	}
	return $final_posts;
}

/* Returns topic name by topic id */
function getTopicNameById($id)
{
	global $conn;
	$sql = "SELECT name FROM topics WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$topic = mysqli_fetch_assoc($result);
	return $topic['name'];
}

/* Returns a single post */
function getPost($slug){
	global $conn;
	// Get single post slug
	$post_slug = $_GET['post-slug'];
	$sql = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result);
	if ($post) {
		// get the topic to which this post belongs
		$post['topic'] = getPostTopic($post['id']);
		$post['author'] = getAuthorName($post['id']);
	}
	return $post;
}

/*  Returns all topics */
function getAllTopics()
{
	global $conn;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($conn, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}

/* Get all the posts created by logged in user*/ 
function getPostListByLoggedUser(){
	global $conn;
	$id = $_SESSION['user']['id'];
	$sql = "SELECT * FROM posts WHERE user_id = $id";
	$posts = mysqli_query($conn, $sql);

	return $posts;
}

/* Get all the posts created by user*/ 
function getPostListByUser($userid){
	global $conn;
	$id = $userid;
	$sql = "SELECT * FROM posts WHERE user_id = $id";
	$posts = mysqli_query($conn, $sql);
	return $posts;
}

/* Get 3 newest registered users */
function getNewestUsers(){
	global $conn;
	$sql = "SELECT * FROM users ORDER BY id DESC";
	$result = mysqli_query($conn, $sql);
    $allusers = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$newestuser=array_slice($allusers,0,3);
	return $newestuser;
}

/* Get user data by the post id */
function getAuthorName ($postid){
	global $conn;
	$sql = "SELECT po.user_id, po.id, u.id, u.fname, u.uname, u.profile_pic, u.about FROM posts po LEFT JOIN users u on u.id = po.user_id WHERE po.id = $postid";
	$result = mysqli_query($conn, $sql);
	$authorname = mysqli_fetch_assoc($result);
	return $authorname;
}


function publish ($postid){
	global $conn;
	$post = getPostById($postid);
	$published = $post['published'];
	if($published==='1'){
			$published='0';}
		elseif($published==='0'){
			$published='1';};
	$sql = "UPDATE posts SET published=$published WHERE id=$postid LIMIT 1";
	mysqli_query($conn, $sql);
	header('location: profile.php');
}

function delete ($postid){
	global $conn;
	$sql = "DELETE FROM posts WHERE id=$postid";
	mysqli_query($conn, $sql);
}


function getPostById($postid){
	global $conn;
	$sql = "SELECT * FROM posts WHERE id=$postid";
	$data = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($data);
	return $result;
}

function selectAllSlugs(){
	global $conn;
	$sql = "SELECT slug from posts";
	$result = mysqli_query($conn, $sql);
	$postslug = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $postslug;

}


function getIdBySlug($slug){
	global $conn;
	$sql = "SELECT id FROM posts WHERE slug = '$slug' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$postid = mysqli_fetch_assoc($result);
	return $postid['id'];
}

function makeSlug($string) {
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	$string = strtolower($string); //lower case
	return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
 }

 // Targetting post by slug
 function getPostBySlug($slug){
	global $conn;
	// Get single post slug
	$post_slug = $_GET['slug'];
	$sql = "SELECT * FROM posts WHERE slug='$post_slug'";
	$result = mysqli_query($conn, $sql);
	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result);
	if ($post) {
		// get the topic to which this post belongs
		$post['topic'] = getPostTopic($post['id']);
	}
	return $post;
}

function userById($userid){
	global $conn;
	$sql = "SELECT * FROM users WHERE id = '$userid' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
	return $user;
}

function setComments($slug){
	if(isset($_POST['commentSubmit'])){
		global $conn;
		$postid = $_POST['postid'];
		$uname = $_POST['uname'];
		$date = $_POST['date'];
		$message = $_POST['message'];


		$sql = "INSERT INTO comments (postid, uname, date, message) VALUES ('$postid','$uname', '$date', '$message')";
		$result=$conn->query($sql);
		header("location: article.php?post-slug=$slug");
	}
}


function getComments($postid){
	global $conn;
	$sql = "SELECT * FROM comments WHERE postid='$postid' ORDER BY `date` DESC";
	$result=$conn->query($sql);
	while($comments = $result->fetch_assoc()){
		echo "<div class='container'>";
               echo "<div class='comment-body'>";
                 echo "<div class='comment-info'>";
                   echo "<div class='comment-name'>".$comments['uname']."</div>";
                    echo "<div class='comment-date'>".$comments['date']."</div>";
                  echo "</div>";
                 echo "<div class='comment-content'>".$comments['message']."";
                  echo "</div>";
               echo "</div>";
	}
	
}

function getAmountOfComments($postid){
	global $conn;
	$sql = "SELECT * from comments WHERE postid=$postid";
	$result = mysqli_query($conn, $sql);
	$amount = mysqli_num_rows($result);
	return $amount;
}

?>



