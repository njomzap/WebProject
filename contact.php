<?php

include 'includes/config.php';
require_once('classes/contact-form.php');

$errorMessage = ''; // Initialize an error message variable
$successMessage = ''; // Initialize a success message variable

if( isset($_POST['send']) ) {
    $name = trim($_POST['name']);
    $message = trim($_POST['message']);
    $email = trim($_POST['email']);

    // Simple validation
    if (empty($name) || empty($email) || empty($message)) {
        $errorMessage = 'Please fill in all the required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Invalid email format.';
    } else {
        $contactForm = new ContactForm();
        $contactForm->setName($name);
        $contactForm->setMessage($message);
        $contactForm->setEmail($email);
        $contactForm->setCreatedAt(date('Y-m-d H:i:s'));
    
        $contactForm->setContactForm();

        $_SESSION['successMessage'] = "Your message has been sent successfully!";
        header("Location: contact.php");
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
    <title>Contact us</title>
</head>
<body>

    <?php
        require('header.php');
    ?>



    <div class="contact-us-banner">
        <div class="overlay"></div>
        <?php
        if (!empty($error)) {?>
            <div class="error-message">
                <p class="error"><?php echo $error ?></p>
            </div>
        <?php }
        if (!empty($_SESSION['successMessage'])) {?>
            <div class="error-message">
                <p class="success"><?php echo $_SESSION['successMessage'] ?></p>
            </div>
            <?php 
            unset($_SESSION['successMessage']);
        }
        ?>
        <div class="content"><h2>Get in touch with us. Send us a message</h2></div>
        <section class="contact-form-section">
            <div class="form-container">
                <form action="contact.php" method="post" id="contactForm" name="contactForm" onsubmit="return validateContactForm()">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" placeholder="Your Message" required cols="30" rows="10"></textarea>
                    <button name="send" type="submit">Send Message</button>
                </form>
            </div>
        </section>
    </div>

    <?php 
        require('footer.php');
    ?>
</body>
</html>
