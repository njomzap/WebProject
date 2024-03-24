<?php

include 'includes/config.php';
require_once('classes/furnitures.php');

if( isset($_POST['save']) ) {
    $title = $_POST['post-title'];
    $description = $_POST['post-description'];
    $filename = null;

    if (empty($title) || empty($description)) {
        $error = 'Title and description are required.';
    } else {
        $posts = new Furnitures();
        $posts->setTitle($title);
        $posts->setDescription($description);
        $posts->setAuthor($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['user_email']);
        $posts->setAuthorId($_SESSION['user_id']);
        
        if (isset($_FILES['post-image']) && $_FILES['post-image']['error'] == 0) {
            $allowed = array(
                "png" => "image/png",
                "jpeg" => "image/jpeg",
                "jpg" => "image/jpeg",
                "gif" => "image/gif",
                "bmp" => "image/bmp",
                "webp" => "image/webp"
            );
            $filename = $_FILES['post-image']['name'];
            $filetype = $_FILES['post-image']['type'];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            if (in_array($filetype, $allowed)) {
                if (file_exists("images/" . $filename)) {
                    echo $filename . " is already exists.";
                } else {
                    move_uploaded_file($_FILES["post-image"]["tmp_name"], "images/" . $filename);
                } 
            }
        }

        if ($filename) {
            $posts->setImage('images/' . $filename);
        } else {
            $posts->setImage(null);
        }
        $posts->setPost();

        header("Location: dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Create new post</title>
</head>
<body>

    <?php
    require('header.php');
    if (!empty($error)) {?>
        <div class="error-message">
            <p class="error"><?php echo $error ?></p>
        </div>
    <?php }
    ?>

    <div class="content"><h2>Add new furniture</h2></div>
    <section class="form-section add-post-form">
        <div class="form-container">
            <form enctype="multipart/form-data" action="add-post.php" method="post" id="add-post" name="add-post">
                <input type="text" name="post-title" placeholder="Furniture name">
                <textarea name="post-description" id="post-description" placeholder="Add furniture description here" cols="30" rows="10"></textarea>
                <label for="post-image">Add furniture image:</label>
                <input type="file" id="post-image" name="post-image" accept="image/png, image/jpeg, image/gif, image/bmp, image/webp" />

                <button name="save" type="submit">Create post</button>
            </form>
        </div>
    </section>
    <?php 
        require('footer.php');
    ?>
</body>
</html>
