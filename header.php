<?php 
    require_once('classes/manage-site.php');
    $site = new ManageSite();
    $settings = $site->getSiteSettings();
?>
<header>
    <a href="index.html" class="logo">Furniture Store</a>
    <nav>
        <ul>
        <li><a href="index.html">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.html">Login / Register</a></li>
        </ul>
    </nav>
    <button id="mobileMenuIcon">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>