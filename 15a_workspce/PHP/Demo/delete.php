<?php

require "db.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("Students ID is required");
}

$sql = "DELETE FROM students WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

header("Location: index.php");
exit;