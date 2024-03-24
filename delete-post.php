<?php

require_once '../classes/furnitures.php';

if (isset($_POST['delete_post'])) {
    $postId = $_POST['post_id'];
    $postsObject = new Furnitures();
    $deleteSuccess = $postsObject->deletePostById($postId);


    header("Location: ../dashboard.php");
    exit();
}
