<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "INSERT INTO students (name, email, age)
            VALUES (:name, :email, :age)";

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #172033;
            --muted: #6e7890;
            --accent: #ef6c57;
            --accent-dark: #d95440;
            --surface: rgba(255, 255, 255, 0.94);
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            font-family: "DM Sans", sans-serif;
            background: #f6f3ee;
            background-image:
                radial-gradient(circle at 10% 10%, rgba(239, 108, 87, 0.2), transparent 28%),
                radial-gradient(circle at 90% 90%, rgba(42, 157, 143, 0.18), transparent 30%);
        }

        .page-shell {
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .form-card {
            max-width: 960px;
            overflow: hidden;
            border: 1px solid rgba(23, 32, 51, 0.08);
            border-radius: 1.5rem;
            background: var(--surface);
            box-shadow: 0 1.5rem 4rem rgba(23, 32, 51, 0.12);
        }

        .intro-panel {
            position: relative;
            min-height: 100%;
            padding: 2rem;
            color: #fff;
            background: linear-gradient(145deg, #20364b 0%, #285d65 100%);
        }

        .intro-panel::after {
            position: absolute;
            right: -4rem;
            bottom: -5rem;
            width: 13rem;
            height: 13rem;
            border: 2rem solid rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            content: "";
        }

        .eyebrow {
            color: #ffb39d;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .intro-panel h1,
        .form-heading {
            font-family: "Space Grotesk", sans-serif;
            font-weight: 700;
        }

        .intro-panel h1 {
            max-width: 16rem;
            margin-top: 1rem;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1.05;
        }

        .intro-copy {
            max-width: 22rem;
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.7;
        }

        .form-panel {
            padding: 2rem;
        }

        .form-heading {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
        }

        .form-subtitle {
            color: var(--muted);
        }

        .form-label {
            margin-bottom: 0.5rem;
            color: #39445a;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .form-control {
            min-height: 3.25rem;
            border: 1px solid #dce1e9;
            border-radius: 0.75rem;
            color: var(--ink);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(239, 108, 87, 0.15);
        }

        .btn-save {
            min-height: 3.25rem;
            border: 0;
            border-radius: 0.75rem;
            background: var(--accent);
            box-shadow: 0 0.5rem 1rem rgba(239, 108, 87, 0.22);
            font-weight: 700;
        }

        .btn-save:hover,
        .btn-save:focus-visible {
            background: var(--accent-dark);
        }

        .back-link {
            color: var(--muted);
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--accent-dark);
        }

        @media (max-width: 575.98px) {
            .page-shell {
                padding: 1rem 0.75rem;
            }

            .form-card {
                border-radius: 1rem;
            }

            .intro-panel,
            .form-panel {
                padding: 1.5rem;
            }

            .intro-panel {
                min-height: auto;
            }
        }
    </style>
</head>
<body>

<main class="page-shell d-flex align-items-center">
    <div class="container">
        <div class="form-card row g-0 mx-auto">
            <section class="intro-panel col-lg-5 d-flex flex-column justify-content-between">
                <div>
                    <div class="eyebrow">Student directory</div>
                    <h1>Make room for someone new.</h1>
                    <p class="intro-copy mb-0">Add a student to your directory with a few simple details.</p>
                </div>
                <div class="d-none d-lg-block mt-5 small text-white-50">Simple records. Clear progress.</div>
            </section>

            <section class="form-panel col-lg-7">
                <div class="mb-4">
                    <h2 class="form-heading mb-2">Add user</h2>
                    <p class="form-subtitle mb-0">Enter the details below to create a new record.</p>
                </div>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="name">Full name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="e.g. Alex Morgan" autocomplete="name" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="email">Email address</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="alex@example.com" autocomplete="email" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="age">Age</label>
                        <input class="form-control" type="number" id="age" name="age" placeholder="e.g. 25" required>
                     </div>

                    <button class="btn btn-save w-100 text-white" type="submit">Save user</button>
                </form>

                <a class="back-link d-inline-block mt-4" href="index.php">&larr; Back to directory</a>
            </section>
        </div>
    </div>
</main>

</body>
</html>