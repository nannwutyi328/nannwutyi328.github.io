<?php

require "db.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("student ID is required");
}

// students ရှာမယ်
$sql = "SELECT * FROM students WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

$students = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$students) {
    die("students not found");
}


// Update
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $age= $_POST["age"];

    $sql = "UPDATE students
            SET name = :name,
                email = :email,
                age = :age

            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":name" => $name,
        ":email" => $email,
        ":age" => $age,
        ":id" => $id
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student | Student Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --ink: #182230;
            --accent: #0f766e;
            --accent-dark: #115e59;
            --wash: #eef8f5;
        }

        body {
            min-height: 100vh;
            color: var(--ink);
            background:
                radial-gradient(circle at 10% 10%, rgba(20, 184, 166, 0.16), transparent 28%),
                linear-gradient(135deg, #f7fbfa 0%, #dff3ef 100%);
        }

        .form-shell {
            max-width: 860px;
        }

        .form-card {
            overflow: hidden;
            border: 1px solid rgba(15, 118, 110, 0.14);
            border-radius: 24px;
            box-shadow:
                0 24px 60px rgba(15, 118, 110, 0.16),
                0 4px 12px rgba(24, 34, 48, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow:
                0 30px 70px rgba(15, 118, 110, 0.2),
                0 8px 18px rgba(24, 34, 48, 0.08);
        }

        .form-intro {
            color: #fff;
            background:
                linear-gradient(145deg, rgba(17, 94, 89, 0.98), rgba(15, 118, 110, 0.92)),
                linear-gradient(45deg, #0f766e, #14b8a6);
            position: relative;
        }

        .form-intro::after {
            position: absolute;
            right: -45px;
            bottom: -55px;
            width: 170px;
            height: 170px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            box-shadow: 0 0 0 22px rgba(255, 255, 255, 0.05);
            content: "";
            pointer-events: none;
        }

        .form-intro p {
            color: rgba(255, 255, 255, 0.78);
        }

        .form-label {
            color: var(--ink);
            font-weight: 600;
        }

        .form-control {
            min-height: 50px;
            border: 1px solid #d7e2e0;
            border-radius: 12px;
            background: #fbfefd;
            box-shadow: inset 0 1px 2px rgba(24, 34, 48, 0.03);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .form-control:hover {
            border-color: #8ccbc3;
            transform: translateY(-1px);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow:
                0 0 0 0.25rem rgba(15, 118, 110, 0.14),
                0 8px 18px rgba(15, 118, 110, 0.1);
            transform: translateY(-2px);
        }

        .btn-update {
            min-height: 50px;
            border: 1px solid var(--accent);
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), #14b8a6);
            box-shadow: 0 8px 18px rgba(15, 118, 110, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .btn-update:hover,
        .btn-update:focus {
            border-color: var(--accent-dark);
            background: linear-gradient(135deg, var(--accent-dark), var(--accent));
            box-shadow: 0 12px 24px rgba(15, 118, 110, 0.28);
            transform: translateY(-3px);
        }

        .btn-update:active {
            transform: translateY(-1px);
        }

        .student-badge {
            display: inline-flex;
            width: 48px;
            height: 48px;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            color: var(--accent-dark);
            background: var(--wash);
            font-size: 1.35rem;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(15, 118, 110, 0.2);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .student-badge:hover {
            box-shadow: 0 12px 26px rgba(15, 118, 110, 0.3);
            transform: rotate(-6deg) scale(1.08);
        }

        @media (max-width: 575.98px) {
            .form-card {
                border-radius: 18px;
            }

            .form-intro,
            .form-content {
                padding: 1.5rem !important;
            }
        }
    </style>
</head>
<body>

<main class="container form-shell py-4 py-md-5">
    <div class="card form-card">
        <div class="row g-0">
            <aside class="col-lg-5 form-intro p-4 p-md-5 d-flex flex-column justify-content-between">
                <div>
                    <div class="student-badge mb-4">S</div>
                    <p class="text-uppercase small fw-semibold mb-2">Student manager</p>
                    <h1 class="display-6 fw-bold mb-3">Edit student details</h1>
                    <p class="mb-0">Keep the student information accurate and up to date.</p>
                </div>
                <p class="small mt-5 mb-0">Complete the required fields before saving.</p>
            </aside>

            <section class="col-lg-7 bg-white form-content p-4 p-md-5">
                <div class="mb-4">
                    <h2 class="h3 fw-bold mb-2">Update profile</h2>
                    <p class="text-secondary mb-0">Make changes below and save them when ready.</p>
                </div>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="name">Full name</label>
                        <input
                            class="form-control"
                            id="name"
                            type="text"
                            name="name"
                            value="<?= htmlspecialchars($students['name']) ?>"
                            placeholder="Enter full name"
                            autocomplete="name"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email address</label>
                        <input
                            class="form-control"
                            id="email"
                            type="email"
                            name="email"
                            value="<?= htmlspecialchars($students['email']) ?>"
                            placeholder="name@example.com"
                            autocomplete="email"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="age">Age</label>
                        <input
                            class="form-control"
                            id="age"
                            type="number"
                            name="age"
                            value="<?= htmlspecialchars($students['age']) ?>"
                            min="1"
                            max="120"
                            placeholder="Enter age"
                            required
                        >
                    </div>

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-end">
                        <a class="btn btn-light border px-4 py-2" href="index.php">Back</a>
                        <button class="btn btn-update text-white px-4 py-2" type="submit">Update student</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</main>

</body>
</html>