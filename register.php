<?php

include 'includes/config.php';
require_once('classes/users.php');
$error = '';

if (isset($_POST['save'])) {
    $name = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = $_POST['gender'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($name) || empty($lastname) || empty($username) || empty($email) || empty($password)) {
        $error = 'Please fill in all the required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (!empty($age) && !is_numeric($age)) {
        $error = 'Age must be a number.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        $users = new Users();
        if (!$users->userExists($username, $email)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $isAdmin = ($email === 'admin@gmail.com') ? 1 : 0;

            $users->setIsAdmin($isAdmin);
            $users->setFirstname($name);
            $users->setLastname($lastname);
            $users->setAge($age);
            $users->setGender($gender);
            $users->setUsername($username);
            $users->setEmail($email);
            $users->setPassword($passwordHash);
        
            $userId = $users->setUser();

            $_SESSION['user_id'] = $userId;

            $_SESSION['user_email'] = $email;
            $_SESSION['firstname'] = $name;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = $isAdmin;
            $_SESSION['loggedin'] = true;

            header("Location: dashboard.php");
            exit();
        } else {
            $error = 'Username or Email already exists.';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login / Register</title>
</head>
<body>

    <?php
    require('header.php');
    if (!empty($error)) {?>
        <div class="error-message">
            <p class="error"><?php echo $error ?></p>
        </div>
    <?php }
    ?>

    <div class="content"><h2>Register</h2></div>
    <section class="form-section">
        <div class="form-container">
            <form  action="register.php" method="post" id="registerForm" name="registerForm" onsubmit="return validateRegister()">
                
                <input type="text" name="firstname" placeholder="Name" required>
                <input type="text" name="lastname" placeholder="Surname" required>
                <input type="number" name="age" placeholder="Age">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option value="none">Prefer not to say</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
                <input type="text" name="username" placeholder="Username" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button name="save" type="submit">Register</button>
            </form>
        </div>
        <p>Already registered? <a href="login.php">Login here</a></p>
    </section>

    <?php 
        require('footer.php');
    ?>
</body>
</html>
