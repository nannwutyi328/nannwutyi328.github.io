<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$schoolName = "Metro IT and Japanese Language Centre";

function getSchoolName()
{


    return $GLOBALS["schoolName"];
}

$student = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_student"])) {
    $student = [
        "name" => $_POST["name"] ?? "",
        "email" => $_POST["email"] ?? "",
        "age" => $_POST["age"] ?? "",
        "gender" => $_POST["gender"] ?? "",
        "course" => $_POST["course"] ?? ""
    ];
}

$photoName = "";

if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    $photoName = basename($_FILES["photo"]["name"]);
    $photoPath = "uploads/" . $photoName;

    move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath);
}

if (isset($_POST["theme"])) {
    setcookie("theme", $_POST["theme"], time() + 3600, "/");
    header("Location: dashboard.php");
    exit;
}

$theme = $_COOKIE["theme"] ?? "light";
$search = $_GET["search"] ?? "";
$requestSearch = $_REQUEST["search"] ?? "";
$requestMethod = $_SERVER["REQUEST_METHOD"];
$scriptName = $_SERVER["PHP_SELF"];
$browser = $_SERVER["HTTP_USER_AGENT"] ?? "Unknown";
$environment = $_ENV["USER"] ?? "Not available";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand">Student Management System </span>
            <div>
                <span class="text-white me-3">Welcome, <?= htmlspecialchars($_SESSION["username"]) ?>
                
                </span>
                <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>
<!-- padding top and bottom =py -->
    <div class="container py-5">
        <div class="row">
            <!--ADD STUDENT-->
            <div class="col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Add Student</h4>
                    </div>
                    <div class="card-body" enctype="multipart/form-data">
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Student Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3"> 
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" min="1" required>
                            </div>
                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" required>
                                    <label class="form-check-label">Male</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Female">
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Course</label>
                                <select name="course" class="form-select">
                                    <option value="PHP">PHP</option>
                                    <option value="Python">Python </option>
                                    <option value="JavaScript">JavaScript</option>
                                    <option value="Web Development">Web Development</option>
                                </select>
                            </div>

                            <div class="mb-3" >
                                <label class="form-label">Profile Photo</label>
                                <input type="file" name="photo" class="form-control">     
                            </div>

                            <button  type="submit" name="add_student" class="btn btn-primary">Add Student</button>
                        </form>
                    </div>
                </div>
            </div>
        
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Student Profile</h4>
                </div>

                <div class="card-body">
                    <?php if ($student): ?>
                        <?php if ($photoName): ?>
                            <img src="uploads/<?= htmlspecialchars($photoName) ?>" class="profile-image mb-3">
                        <?php endif; ?>

                        <h4><?= htmlspecialchars($student["name"]) ?></h4>
                        <hr>

                        <p><strong>Email:</strong> <?= htmlspecialchars($student["email"]) ?></p>
                        <p><strong>Age:</strong> <?= htmlspecialchars($student["age"]) ?></p>
                        <p><strong>Gender:</strong> <?= htmlspecialchars($student["gender"]) ?></p>
                        <p><strong>Course:</strong> <?= htmlspecialchars($student["course"]) ?></p>

                        <div class="alert alert-success">Student added successfully!</div>
                    <?php else: ?>
                        <p class="text-muted">Student information will appear here.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Search Student</h5>
                </div>

                <div class="card-body">
                    <form method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Enter student name">
                            <button class="btn btn-info">Search</button>
                        </div>
                    </form>

                    <?php if ($search): ?>
                        <div class="alert alert-info mt-3">
                            Searching for: <strong><?= htmlspecialchars($search) ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- COOKIE -->
    <div class="card shadow mb-4">
        <div class="card-header bg-warning">
            <h4>$_COOKIE — Theme Preference</h4>
        </div>

        <div class="card-body">
            <p>Current Theme:<strong><?= htmlspecialchars($theme) ?></strong></p>
 
            <form method="post">
                <button name="theme" value="light" class="btn btn-light border">Light</button>
                <button name="theme" value="dark" class="btn btn-dark">Dark</button>
            </form>
        </div>
    </div>


    <!-- Superglobal Information -->
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <h4>PHP Superglobal Information</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>$GLOBALS</th>
                </tr>
                <tr>
                    <th> $_SESSION</th>
                    <td><?= htmlspecialchars($_SESSION["username"]) ?></td>
                </tr>
                <tr>
                    <th>$_REQUEST</th>
                    <td><?= htmlspecialchars($requestSearch ?: "No data") ?></td>
                </tr>
                <tr>
                    <th>
                        $_SERVER['REQUEST_METHOD']
                    </th>
                    <td>
                        <?= htmlspecialchars($requestMethod) ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        $_SERVER['PHP_SELF']
                    </th>
                    <td>
                        <?= htmlspecialchars($scriptName) ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        $_SERVER['HTTP_USER_AGENT']
                    </th>
                    <td>
                        <?= htmlspecialchars($browser) ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        $_ENV
                    </th>
                    <td>
                        <?= htmlspecialchars($environment) ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<!-- Summary -->
    <div class="card shadow">
        <div class="card-header">
            <h4>Superglobals Used</h4>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <div class="superglobal">
                        <code>$_GET</code>
                        <br>
                        Search
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="superglobal">
                        <code>$_POST</code>
                        <br>
                        Form Data
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="superglobal">
                        <code>$_SESSION</code>
                        <br>
                        Login
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="superglobal">
                        <code>$_COOKIE</code>
                        <br>
                        Theme
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="superglobal">
                        <code>$_FILES</code>
                        <br>
                        Photo
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="superglobal">
                        <code>$_SERVER</code>
                        <br>
                        Server Info
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>