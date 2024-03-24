<?php 
    include 'includes/config.php';
    include 'includes/helpers.php';
    require_once('classes/users.php');
    require_once('classes/furnitures.php');
    require_once('classes/contact-form.php');

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
        <section class="dashboard">
            <?php if ( isset( $_SESSION['loggedin'] ) ) : ?>
                <h2>Hello <?php echo $_SESSION['firstname'] ?></h2>
                <div class="dashboard-section">
                    <h3>Your posts</h3>
                    <?php 
                    $postsObject = new Furnitures();
                    if ($_SESSION['is_admin']) {
                        $userPosts = $postsObject->getAllPosts();
                    } else {
                        $userPosts = $postsObject->getUserPosts($_SESSION['user_id']);
                    }
                    ?>
                    <div class="my-posts">
                        <?php if ( ! empty($userPosts) ): ?>
                            <?php foreach ($userPosts as $post): ?>
                                <div class="post-wrapper">
                                    <div class="post-details">
                                        <img src="<?php echo $post['image']; ?>" alt="Elegant Leather Chair">
                                        <div class="post-meta">
                                            <h3><a href="post.php?name=<?php echo urlencode(createSlug($post['title'])); ?>"><?php echo $post['title']; ?></a></h3>
                                            <span class="posted-by">Posted by: <?php echo $post['author']; ?></span>
                                        </div>
                                    </div>
                                    <div class="post-actions">
                                        <form action="actions/delete-post.php" method="POST">
                                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                            <button class="delete" type="submit" name="delete_post">Delete</button>
                                        </form>
                                        <form action="edit-post.php" method="POST">
                                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                            <button class="edit" type="submit" name="edit_post">Edit</button>
                                        </form>
                                        <?php if ($_SESSION['is_admin']): ?>
                                            <form action="actions/toggle-featured.php" method="POST">
                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                <input type="hidden" name="featured" value="<?php echo $post['is_featured']; ?>">
                                                <button class="featured <?php echo $post['is_featured'] ? 'favorite' : ''; ?>" type="submit" name="set_featured"><?php echo $post['is_featured'] ? 'Featured' : 'Feature post'; ?></button>
                                            </form>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <p>You don't have any posts</p>
                        <?php endif ?>
                    </div>
                </div>
                <?php if ($_SESSION['is_admin']): ?>
                    <div class="dashboard-section">
                        <h3>Your messages</h3>
                        <?php 
                        $messagesObject = new ContactForm();
                        $messagesArray = $messagesObject->getEmails();
                        ?>
                        <div class="my-posts">
                            <?php if ( !empty($messagesArray) ): ?>
                                <?php foreach ($messagesArray as $message): ?>
                                    <div class="message-wrapper">
                                        <div class="message-head">
                                            <p><span class="icon email-icon"></span>Sent by: <?php echo $message['email']; ?></p>
                                            <p><span class="icon date-icon"></span>Date: <?php echo $message['created_at']; ?></p>
                                        </div>
                                        <div class="message-body">
                                            <p><span class="icon title-icon"></span>Message title: <?php echo $message['name']; ?></p>
                                            <p><span class="icon subject-icon"></span>Message subject: <?php echo $message['message']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php else: ?>
                                <p>You don't have any messages</p>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="dashboard-section">
                        <h3>Manage site</h3>
                        <form action="./actions/manage-site.php" method="POST" class="site-settings-form" enctype="multipart/form-data">
                            <p>Header menu</p>
                            <div class="form-group">
                                <label for="home" class="checkbox-label">Home</label>
                                <input type="checkbox" name="home" class="checkbox-input" <?php echo ($settings['show_home'] == 1) ? 'checked' : ''; ?>>
                            </div>

                            <div class="form-group">
                                <label for="shop" class="checkbox-label">Shop</label>
                                <input type="checkbox" name="shop" class="checkbox-input" <?php echo ($settings['show_shop'] == 1) ? 'checked' : ''; ?>>
                            </div>

                            <div class="form-group">
                                <label for="about" class="checkbox-label">About</label>
                                <input type="checkbox" name="about" class="checkbox-input" <?php echo ($settings['show_about'] == 1) ? 'checked' : ''; ?>>
                            </div>

                            <div class="form-group">
                                <label for="add-post" class="checkbox-label">Add post</label>
                                <input type="checkbox" name="add-post" class="checkbox-input" <?php echo ($settings['show_add_post'] == 1) ? 'checked' : ''; ?>>
                            </div>

                            <div class="form-group">
                                <label for="contact" class="checkbox-label">Contact</label>
                                <input type="checkbox" name="contact" class="checkbox-input" <?php echo ($settings['show_contact'] == 1) ? 'checked' : ''; ?>>
                            </div>

                            <div class="form-group">
                                <p class="input-label">Footer text</p>
                                <input type="text" name="footer_text" class="text-input" value="<?php echo htmlspecialchars($settings['footer_text']); ?>">
                            </div>

                            <div class="form-group">
                                <p>Slide 1 Header Text</p>
                                <input type="text" name="slide_1_header" class="text-input" value="<?php echo htmlspecialchars($settings['slide_1_header']); ?>">
                            </div>
                            <div class="form-group">
                                <p>Slide 1 Image</p>
                                <?php if (!empty($settings['slide_1_image'])): ?>
                                    <img src="<?php echo $settings['slide_1_image']; ?>" alt="Slide 1" style="max-width:100px; max-height:100px; display:block;">
                                <?php endif; ?>
                                <input type="file" name="slide_1_image" class="file-input">
                            </div>

                            <div class="form-group">
                                <p>Slide 2 Header Text</p>
                                <input type="text" name="slide_2_header" class="text-input" value="<?php echo htmlspecialchars($settings['slide_2_header']); ?>">
                            </div>
                            <div class="form-group">
                                <p>Slide 2 Image</p>
                                <?php if (!empty($settings['slide_2_image'])): ?>
                                    <img src="<?php echo $settings['slide_2_image']; ?>" alt="Slide 2" style="max-width:100px; max-height:100px; display:block;">
                                <?php endif; ?>
                                <input type="file" name="slide_2_image" class="file-input">
                            </div>

                            <div class="form-group">
                                <p>Slide 3 Header Text</p>
                                <input type="text" name="slide_3_header" class="text-input" value="<?php echo htmlspecialchars($settings['slide_3_header']); ?>">
                            </div>
                            <div class="form-group">
                                <p>Slide 3 Image</p>
                                <?php if (!empty($settings['slide_3_image'])): ?>
                                    <img src="<?php echo $settings['slide_3_image']; ?>" alt="Slide 3" style="max-width:100px; max-height:100px; display:block;">
                                <?php endif; ?>
                                <input type="file" name="slide_3_image" class="file-input">
                            </div>
                            <button name="save_changes" type="submit" class="submit-btn">Save</button>
                        </form>

                    </div>
                <?php endif ?>
            <?php else: ?>
                <div class="content"><p>You need to login to see this page</p></div>
            <?php endif ?>
        </section>
    </main>

    <?php 
        require('footer.php');
    ?>
</body>
</html>