<?php
session_start();

$adminUser = 'admin';
$adminPass = 'password';

if (isset($_POST['loginSubmit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if ($username == $adminUser && $password == $adminPass) {
        $_SESSION['loggedIn'] = true;
        header('Location: index.php');
        exit();
    } else {
        $errorMsg = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h2 class="text-center">Login</h2>
                <?php if (isset($errorMsg)) { echo '<div class="alert alert-danger">'.$errorMsg.'</div>'; } ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="loginSubmit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
