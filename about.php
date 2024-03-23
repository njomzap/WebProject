<?php 
    include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
	<title>About us</title>
</head>
<body>

    <?php 
        require('header.php');
    ?>
	
    <div class="about-us-wrapper">
        <div class="content">
            <h2>About our store</h2>
            <p>Out store was established in 1990, consectetur eleifend commodo at, consectetur eu justo. Sed viverra consectetur risus nec ultricies.</p>
        </div>
        <div class="about-banner">
            <img src="./images/04.jpg" alt="Our store">
        </div>
        <div class="content">
        <h2>Our team</h2>
        </div>
        <main class="our-team">
            <div class="team-member">
                <img src="./images/05.jpg" alt="">
                <p>Sales</p>
                <h3>James Ford</h3>
            </div>
            <div class="team-member">
                <img src="./images/06.jpg" alt="">
                <p>Marketing</p>
                <h3>Elen Howard</h3>
            </div>
            <div class="team-member">
                <img src="./images/07.jpg" alt="">
                <p>Finances</p>
                <h3>Tim Money</h3>
            </div>
        </main>
    </div>

    <?php 
        require('footer.php');
    ?>
    
</body>
</html>