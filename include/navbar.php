<header>
    <?php 
                $sql = "SELECT * FROM topics";
	            $alltopics = mysqli_query($conn, $sql);
                $result = mysqli_fetch_all($alltopics, MYSQLI_ASSOC);
    ?>      
    <div class="container">
    <nav>
        <a href="index.php?page=1"><h1 class="logo">small</h1></a>
        <ul>
        <li><a href="index.php?page=1"><i class="fas fa-home"></i>Home</a></li>
        <li class="li-c"><div class="dropdown">
            <button class="dropdown-button"><i class="fas fa-book-open"></i>Categories</button>
            <div class="dropdown-content">
            <?php foreach ($result as $topic): ?>
                <a href="<?php echo BASE_URL . 'category.php?topic=' . $topic['id']?>"><?php echo $topic['name'] ?></a>
            <?php endforeach ?>
            </div>
        </div></li>
        <li>
            <?php if (isset($_SESSION['user'])){
               echo "<a id='profile-link' class='logout-btn' href='profile.php'><i class=\"fas fa-user\"></i>Profile</a>";
            }else{
                echo "<a href=\"signup.php\"><i class=\"fas fa-user\"></i>Sign up</a>";
            }
            ?>
        </li>
        <li>
            <?php if (isset($_SESSION['user'])){
               echo "<a id='logout' class='btn' href='logout.php'><i class=\"fas fa-sign-out-alt\"></i>Logout</a>";
            }else{
              echo  "<a id=\"login\" class=\"btn\" href=\"login.php\"><i class=\"fas fa-sign-in-alt\"></i>Login</a>";
            }
            ?>
       </li>
        </ul>
    </nav>
    </div>
</header>

<nav class="side-menu">
    <ul>
        <?php foreach ($result as $topic): ?>
        <li>
            <a href="<?php echo BASE_URL . 'category.php?topic=' . $topic['id']?>"><?php echo $topic['name'] ?></a>
        <?php endforeach ?>
        </li>
    </ul>
</nav>

<div class="hamburger">
    <div class="line-1"></div>
    <div class="line-2"></div>
    <div class="line-3"></div>
</div>



