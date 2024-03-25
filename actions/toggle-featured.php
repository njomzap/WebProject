<?php 

require_once '../classes/furnitures.php';

if(isset($_POST['set_featured'])) {
    var_dump($_POST['post_id']);
    $postId = $_POST['post_id'];
    $current_status = $_POST['featured'];
    $isFeatured = $current_status ? 0 : 1;
    $furnituresObject = new Furnitures();

    $furnituresObject->setFeaturedStatus($postId, $isFeatured);

    header("Location: ../dashboard.php");
}
?>
