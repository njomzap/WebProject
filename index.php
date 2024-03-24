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
    <title>Home - Furniture Shopping</title>
</head>
<body>

    <?php 
        require('header.php');
    ?>

    <main>
        <section class="home-banner">
            <?php if (!empty($settings['slide_1_header']) && !empty($settings['slide_1_image'])): ?>
                <div class="slide">
                    <div class="banner-text">
                        <h3><?php echo htmlspecialchars($settings['slide_1_header']); ?></h3>
                    </div>
                    <div class="banner-image">
                        <img src="<?php echo htmlspecialchars($settings['slide_1_image']); ?>" alt="">
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($settings['slide_2_header']) && !empty($settings['slide_2_image'])): ?>
                <div class="slide">
                    <div class="banner-text">
                        <h3><?php echo htmlspecialchars($settings['slide_2_header']); ?></h3>
                    </div>
                    <div class="banner-image">
                        <img src="<?php echo htmlspecialchars($settings['slide_2_image']); ?>" alt="">
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($settings['slide_3_header']) && !empty($settings['slide_3_image'])): ?>
                <div class="slide">
                    <div class="banner-text">
                        <h3><?php echo htmlspecialchars($settings['slide_3_header']); ?></h3>
                    </div>
                    <div class="banner-image">
                        <img src="<?php echo htmlspecialchars($settings['slide_3_image']); ?>" alt="">
                    </div>
                </div>
            <?php endif; ?>
            <a class="prev">&#10094;</a>
            <a class="next">&#10095;</a>
        </section>


        <?php 
        $postsObject = new Furnitures();
        $postsArray = $postsObject->getFeaturedPosts();
        ?>

        <?php if (! empty($postsArray) ): ?>
            <section class="featured-products">
                <h2>Featured Products</h2>
                <div class="products-wrapper">
                    <?php foreach ($postsArray as $post): ?>
                        <?php if ($post['is_featured'] === '1'): ?>
                            <div class="product">
                                <img src="<?php echo $post['image']; ?>" alt="Elegant Leather Chair">
                                <h3><a href="post.php?name=<?php echo urlencode(createSlug($post['title'])); ?>"><?php echo $post['title']; ?></a></h3>
                                <p><?php echo trimText($post['description'], 150); ?></p>
                                <span class="posted-by">Posted by: <?php echo $post['author']; ?></span>
                                <button>Add to Cart</button>
                            </div>
                        <?php endif; ?>
                    <?php endforeach ?>
                </div>
            </section>
        <?php endif ?>

    </main>

    <?php 
        require('footer.php');
    ?>
</body>
</html>