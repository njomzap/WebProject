<?php 
    include 'includes/config.php';
    include 'includes/helpers.php';
    require_once('classes/furnitures.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
	<title>Shop</title>
</head>
<body>

	<?php 
        require('header.php');
    ?>

    <main>
        <section class="featured-products">
            <div class="content">
                <h2>Best Modern Furniture</h2>
                <p>Transform Your Space, Embrace Your Style - Where Comfort Meets Elegance</p>
            </div>
            <?php 
            $postsObject = new Furnitures();
            $postsArray = $postsObject->getAllPosts();
            ?>
            <div class="products-wrapper">
                <?php foreach ($postsArray as $post): ?>
                    <div class="product">
                        <img src="<?php echo $post['image']; ?>" alt="Elegant Leather Chair">
                        <h3><a href="post.php?name=<?php echo urlencode(createSlug($post['title'])); ?>"><?php echo $post['title']; ?></a></h3>
                        <p><?php echo trimText($post['description'], 150); ?></p>
                        <button>Add to Cart</button>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
    </main>


    <?php 
        require('footer.php');
    ?>
</body>
</html>