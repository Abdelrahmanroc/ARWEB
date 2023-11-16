<?php
include_once '../components/connection.php';

session_start();

if (isset($_POST['submit'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $select_user->execute([$email]);

    if ($select_user->rowCount() > 0) {
        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $fetch_user['password'])) {
            $_SESSION['user_id'] = $fetch_user['id'];
            $_SESSION['user_name'] = $fetch_user['name'];
            $_SESSION['user_email'] = $fetch_user['email'];
            header('location: home.php');
        } else {
            $message = 'Incorrect username or password';
        }
    } else {
        $message = 'Incorrect username or password';
    }
}

?>

<style>
    <?php include 'admin_style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>User Login Page</title>
</head>
<body style="padding-left: 0 !important;">
<?php
if (isset($message)) {
    echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
        </div>
    ';
}
?>
<div class="main-container">
    <section class="form-container" id="user_login">
        <form action="" method="post">
            <h3>Login Now</h3>
            <p style="text-align: center; color: #000;">Default email: user@example.com and password: MySuperPassword123</p>
            <div class="input-field">
                <label for="email">Email <sup>*</sup></label><br>
                <input type="email" id="email" name="email" maxlength="50" required placeholder="Enter your email" oninput="this.value = this.value.replace(/\s/g,'')"
                       value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="input-field">
                <label for="pass">Password<sup>*</sup></label><br>
                <input type="password" id="pass" name="pass" maxlength="255" required placeholder="Enter your password" oninput="this.value = this.value.replace(/\s/g,'')">
            </div>
            <input type="submit" name="submit" value="Login Now" class="btn">
        </form>
    </section>
</div>
</body>
</html>