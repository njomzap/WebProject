<?php if ( ! isset( $_SESSION['loggedin'] ) ) : ?>
<div class="admin-login">
    <p><strong>Admin login</strong></p>
    <p>Email: admin@gmail.com</p>
    <p>Password: admin</p>
</div>
<?php endif ?>
<footer>
    <p><?php echo $settings['footer_text']; ?></p>
    <script src="script.js"></script>
</footer>