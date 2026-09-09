<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($username == "admin" && $password == "1234") {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow login-card">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Student Management System</h2>
                        <p class="text-center text-muted">PHP Superglobals</p>
                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>
                        <!-- Form -->
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>     
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>      
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <!-- Demo -->
                        <div class="alert alert-info mt-4">
                            <strong>Demo Login</strong><br>
                            Username: admin<br>
                            Password: 1234
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>