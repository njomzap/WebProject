<?php 

require_once '../classes/furnitures.php';

if(isset($_POST['update_post'])) {
    $postId = $_POST['post_id'];
    $postsObject = new Furnitures();
    $title = $_POST['post-title'];
    $description = $_POST['post-description'];
    $isFeatured = isset($_POST['featured']) ? true : false;

    // Fetch the existing image path from the database first
    $currentPost = $postsObject->getPostById($postId);
    $imagePath = $currentPost['image']; // Assume 'image' is the column name in your database for the image path

    if (isset($_FILES['post-image']) && $_FILES['post-image']['error'] == 0) {
        // Your existing file upload handling logic here
        // Only update $imagePath if a new file is successfully uploaded
        $allowed = [
            "png" => "image/png",
            "jpeg" => "image/jpeg",
            "jpg" => "image/jpeg",
            "gif" => "image/gif",
            "bmp" => "image/bmp",
            "webp" => "image/webp"
        ];
        $filename = $_FILES['post-image']['name'];
        $filetype = $_FILES['post-image']['type'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        if (in_array($filetype, $allowed)) {
            // Generate a unique filename to prevent overwriting existing files
            $newFilename = uniqid('', true) . '.' . $ext;
            $uploadPath = "../images/" . $newFilename;
            if (move_uploaded_file($_FILES["post-image"]["tmp_name"], $uploadPath)) {
                $imagePath = "images/" . $newFilename; // Update $imagePath to the new image
            }
        }
    }

    // Update the post with the existing or new $imagePath
    $success = $postsObject->updatePostById($postId, $title, $description, $imagePath, $isFeatured);

    if($success) {
        header("Location: ../edit-post.php?id=" . $postId);
        exit;
    } else {
        // Handle error
    }
}
