<?php 
    require_once('classes/manage-site.php');
    $site = new ManageSite();
    $settings = $site->getSiteSettings();
?>
<header>
    <a href="index.php" class="logo">Furniture Store</a>
    <nav>
        <ul>
            <?php 
            if ($settings['show_home']) {
                echo '<li><a href="index.php">Home</a></li>';
            }
            ?>
            <?php 
            if ($settings['show_shop']) {
                echo '<li><a href="shop.php">Shop</a></li>';
            }
            ?>
            <?php 
            if ($settings['show_contact']) {
                echo '<li><a href="contact.php">Contact</a></li>';
            }
            ?>
            <?php 
            if ($settings['show_about']) {
                echo '<li><a href="about.php">About Us</a></li>';
            }
            ?>
            
            
            <?php
            if( isset($_SESSION['user_email']) ) {
                echo '<li><a href="add-post.php">Add post</a></li>';
                echo '<li><a href="dashboard.php">Dashboard</a></li>';
                echo '<li><a href="./classes/logout.php">Logout</a></li>';
            }
            ?>
            <?php
            if( ! isset($_SESSION['user_email']) ) {
                echo '<li><a href="login.php">Login / Register</a></li>';
            }
            ?>
        </ul>
    </nav>
    <button id="mobileMenuIcon">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>