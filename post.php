<?php 
    include 'includes/config.php';
    include 'includes/helpers.php';
    require_once('classes/furnitures.php');


$nameSlug = $_GET['name'] ?? '';
$postsObject = new Furnitures();
$postsArray = $postsObject->getAllPosts();

$foundPost = null;
foreach ($postsArray as $post) {
    if (createSlug($post['title']) === $nameSlug) {
        $foundPost = $post;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo  $post['title'] ?></title>
</head>
<body>

    <?php 
        require('header.php');
    ?>

    <main class="post-page-wrapper">
        <h1><?php echo  $post['title'] ?></h1>
        <div class="post-image">
            <img src="<?php echo  $post['image'] ?>" alt="Post image">
        </div>
        <div class="content"><?php echo  $post['description'] ?></div>
        <?php if ( $post['author'] ): ?>
            <p class="post-author">Posted by: <?php echo  $post['author'] ?></p>
        <?php endif ?>
    </main>

    <?php 
        require('footer.php');
    ?>
</body>
</html>