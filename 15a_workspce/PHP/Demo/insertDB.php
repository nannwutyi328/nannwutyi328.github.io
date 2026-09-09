<?php

require "dbPDO.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "INSERT INTO students (name, email,age)
            VALUES (:name, :email,:age)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":name" => $name,
        ":email" => $email,
        ":age" => $age
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
</head>
<body>

<h1>Add User</h1>

<form method="POST">

    <label>Name</label>
    <br>

    <input type="text" name="name" required>

    <br><br>

    <label>Email</label>
    <br>

    <input type="email" name="email" required>

    <br><br>

    <label>Age</label>
    <br>

    <input type="number" name="age" required>

    <br><br>

    <button type="submit">
        Save
    </button>

</form>

<br>

<a href="index.php">Back</a>

</body>
</html>

