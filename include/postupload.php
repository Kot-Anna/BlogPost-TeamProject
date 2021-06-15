<?php  include('../config.php'); ?> 
<?php include('public_functions.php'); ?>
<?php date_default_timezone_set('Europe/Helsinki') ?>

<?php 

$userid = $_SESSION["user"]["id"];
$timestamp = date("Y-m-d H:i:s");

if (isset($_POST['submitpost'])){
   
    $errorlist = array();
    $title = trim($_POST['article-title']);
    $slug = makeSlug($title);
    $content = htmlentities($_POST['article-content']);
    $category = $_POST['category'];
    $file = $_FILES['uploadBanner']; 
    // variables for file properties
    $fileName = $_FILES['uploadBanner']['name'];
    //the temporary names displays a full path to temporary location
    $fileTmpName = $_FILES['uploadBanner']['tmp_name'];
    $fileSize = $_FILES['uploadBanner']['size'];
    $fileError = $_FILES['uploadBanner']['error'];
    $fileType = $_FILES['uploadBanner']['type'];

    //******FILE HANDLING*******

    if ($file['size'] == 0) 
    { 
        array_push($errorlist, "Banner image required"); 
    }
    else {
        
        // exploding a users file name to return an array of name and extention
        $fileExt = explode('.', $fileName);
        
        // changing the extention to lower case in case user has it saved with caps
        $fileActualExt = strtolower(end($fileExt));

        // creating an array of allowed file extentions
        $allowed = array('jpg', 'jpeg', 'png');

        // checking if the file is correct and if its not allowed pushes the error to error list
        if (!in_array($fileActualExt, $allowed)){array_push($errorlist, "Wrong file type");}

        // checking if there was no error while uploading then...
        if (!empty($fileError)){array_push($errorlist, "There was an error uploading your file");}

        // checking if the file has a correct size
        if ($fileSize > 1000000){array_push($errorlist, "Your file was too big");}  
    }

    //******* FORM VALIDATION*******
    if (empty($title)) { array_push($errorlist, "Title must be specified");}
    if (empty($content)) { array_push($errorlist, "Post must contain a body text"); }
    if (empty($category)) { array_push($errorlist, "Category must be chosen"); }
    // Checking if post with the same slug exists already
    $post_exist = "SELECT * FROM posts WHERE slug='$slug' LIMIT 1";
    $result = mysqli_query($conn, $post_exist);
    if (mysqli_num_rows($result) > 0) { // if it is a duplicated post
        array_push($errorlist, "Post with this title already exists");
    } 

    // Printing errors
    if (!empty($errorlist)){
         $_SESSION['errorlist'] = $errorlist;
         header("Location: ../createPost.php?errorCreatingPost");
        }

    // If no errors saves the post
    else {

        // Giving an uploaded file a unique name - it returns a value of the timeformat down to mikroseconds
        $fileNameNew = uniqid('',true).".".$fileActualExt;

        //destination where to upload a file
        $fileDestination ='../static/img/'.$fileNameNew;

        //creating a function that will move the file from temp location to the folder

        move_uploaded_file($fileTmpName, $fileDestination);
        // Uploading all the data into a database
        $query = "INSERT into posts (`user_id`, `title`, `slug`, `image`, `body`, `created_at`) VALUES ('$userid', '$title', '$slug', '$fileNameNew', '$content', '$timestamp')";

            if(mysqli_query($conn, $query)){ // if post created successfully
                $inserted_post_id = getIdBySlug($slug);
                // create relationship between post and topic
                $sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $category)";
                mysqli_query($conn, $sql);

                //display success in post creation
                header("Location: ../createPost.php?postcreated");
                } 
                
    
    }
}
?>