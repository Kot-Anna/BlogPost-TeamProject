<?php  include('../config.php'); ?> 
<?php include('public_functions.php'); ?>

<?php 

$userid = $_SESSION["user"]["id"];
$thispostid = getIdBySlug($_GET['slug']);

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

     // IF THE FILE WAS NOT CHANGED
    if ($file['size'] == 0) 
    { 
        //******* FORM VALIDATION*******
        if (empty($title)) { array_push($errorlist, "Title must be specified");}
        if (empty($content)) { array_push($errorlist, "Post must contain a body text"); }
        if (empty($category)) { array_push($errorlist, "Category must be chosen"); }
        // Checking if post with the same slug exists already
        $post_exist = "SELECT * FROM posts WHERE slug='$slug' and id != $thispostid LIMIT 1";
        $result = mysqli_query($conn, $post_exist);
        if (!empty(mysqli_num_rows($result))) { // if it is a duplicated post
        array_push($errorlist, "Post with this title already exists");	
        } 

        if(empty($errorlist)){
            $query = "UPDATE posts set user_id = '$userid', title = '$title', slug = '$slug', body = '$content' WHERE id = '$thispostid' LIMIT 1";
            if(mysqli_query($conn, $query)){ // if post created successfully
                // create relationship between post and topic
                $sql = "UPDATE post_topic set topic_id = '$category' WHERE post_id = '$thispostid' LIMIT 1";
                mysqli_query($conn, $sql);

                //display success in post creation
                header("Location: ../createPost.php?postupdate");
            } 

        }
        else if (!empty($errorlist)){
            $_SESSION['errorlist'] = $errorlist;
            header("Location: ../createPost.php?slug=" . $_GET['slug']);
            }
  
    }

    // IF THE FILE WAS CHANGED
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

        //******* FORM VALIDATION*******
        if (empty($title)) { array_push($errorlist, "Title must be specified");}
        if (empty($content)) { array_push($errorlist, "Post must contain a body text"); }
        if (empty($category)) { array_push($errorlist, "Category must be chosen"); }
        // Checking if post with the same slug exists already
        $post_exist = "SELECT * FROM posts WHERE slug='$slug' and id != $thispostid LIMIT 1";
        $result = mysqli_query($conn, $post_exist);
        if (!empty(mysqli_num_rows($result))) { // if it is a duplicated post
        array_push($errorlist, "Post with this title already exists");	
        } 
        // Printing errors
        if (!empty($errorlist)){
            $_SESSION['errorlist'] = $errorlist;
            header("Location: ../createPost.php?slug=" . $_GET['slug']);
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
            $query = "UPDATE posts set user_id = '$userid', title = '$title', slug = '$slug', image = '$fileNameNew', body = '$content' WHERE id = '$thispostid' LIMIT 1";

                if(mysqli_query($conn, $query)){ // if post created successfully
                    // create relationship between post and topic
                    $sql = "UPDATE post_topic set topic_id = '$category' WHERE post_id = '$thispostid' LIMIT 1";
                    mysqli_query($conn, $sql);

                    //display success in post creation
                    header("Location: ../createPost.php?postupdate=true");
                    } 
    
        }
    }
    
}

?>
