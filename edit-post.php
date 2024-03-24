<?php

include 'includes/config.php';
require_once('classes/furnitures.php');


    $postId = isset( $_POST['post_id'] ) ? $_POST['post_id'] : $_GET['id'];
    $postsObject = new Furnitures();
    $post = $postsObject->getPostById($postId);

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
    ?>

    <div class="content"><h2>Edit post</h2></div>
    <section class="form-section add-post-form">
        <div class="form-container">
            <form action="actions/edit-post.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="post-title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                <textarea name="post-description" required cols="30" rows="10"><?php echo htmlspecialchars($post['description']); ?></textarea>
                <label>Current Image:</label>
                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" style="max-width: 200px; display: block;">
                <label for="post-image">Choose a new image (optional):</label>
                <input type="file" id="post-image" name="post-image" accept="image/png, image/jpeg, image/gif, image/bmp, image/webp" />

                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <button type="submit" name="update_post">Update Post</button>
            </form>
        </div>
    </section>
    <?php 
        require('footer.php');
    ?>
</body>
</html>
