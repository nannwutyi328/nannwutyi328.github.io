<?php

require "db.php";

$sql = "SELECT * FROM students ORDER BY id DESC";
$stmt = $pdo->query($sql);

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --ink: #182230;
            --accent: #0f766e;
            --accent-dark: #115e59;
        }

        body {
            min-height: 100vh;
            color: var(--ink);
            background: linear-gradient(135deg, #f7fbfa 0%, #e6f3f0 100%);
        }

        .page-shell {
            max-width: 1120px;
        }

        .dashboard-card {
            overflow: hidden;
            border: 0;
            border-radius: 24px;
            box-shadow: 0 18px 55px rgba(15, 118, 110, 0.14);
        }

        .page-header {
            background: linear-gradient(145deg, var(--accent-dark), var(--accent));
        }

        .page-header p {
            color: rgba(255, 255, 255, 0.78);
        }

        .btn-add {
            color: var(--accent-dark);
            background: #fff;
            border: 0;
            border-radius: 10px;
        }

        .btn-add:hover {
            color: var(--accent-dark);
            background: #e9fffa;
        }

        .table thead th {
            color: #667085;
            background: #f8fafc;
            font-size: 0.78rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table > :not(caption) > * > * {
            padding: 1rem 1.25rem;
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: 0;
        }

        .student-id {
            color: var(--accent-dark);
            font-weight: 700;
        }

        .action-link {
            color: var(--accent-dark);
            font-weight: 600;
            text-decoration: none;
        }

        .action-link:hover {
            color: #0b4f4a;
            text-decoration: underline;
        }

        .delete-link {
            color: #b42318;
        }

        .delete-modal-backdrop {
            position: fixed;
            z-index: 1050;
            inset: 0;
            display: grid;
            place-items: center;
            padding: 1rem;
            background: linear-gradient(135deg, rgba(24, 34, 48, 0.7), rgba(180, 35, 24, 0.3));
            backdrop-filter: blur(4px);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }

        .delete-modal-backdrop.is-visible {
            opacity: 1;
            visibility: visible;
        }

        .delete-modal {
            width: min(100%, 430px);
            padding: 2rem;
            border: 1px solid rgba(180, 35, 24, 0.2);
            border-radius: 20px;
            background: linear-gradient(145deg, #fff 0%, #fffafa 100%);
            box-shadow:
                0 30px 80px rgba(24, 34, 48, 0.3),
                0 0 0 6px rgba(180, 35, 24, 0.06);
            transform: translateY(24px) scale(0.94) rotateX(4deg);
            transition: transform 0.25s ease;
        }

        .delete-modal-backdrop.is-visible .delete-modal {
            transform: translateY(0) scale(1) rotateX(0);
        }

        .delete-modal-icon {
            display: grid;
            width: 52px;
            height: 52px;
            margin-bottom: 1.25rem;
            place-items: center;
            border-radius: 50%;
            color: #b42318;
            background: linear-gradient(145deg, #fff0ee, #ffe0dc);
            font-size: 1.5rem;
            box-shadow: 0 8px 18px rgba(180, 35, 24, 0.16);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .delete-modal-icon:hover {
            box-shadow: 0 12px 24px rgba(180, 35, 24, 0.24);
            transform: rotate(-8deg) scale(1.08);
        }

        .delete-modal-title {
            color: var(--ink);
            font-size: 1.35rem;
            font-weight: 700;
        }

        .delete-modal-message {
            color: #667085;
            line-height: 1.6;
        }

        .delete-modal-name {
            color: var(--ink);
            font-weight: 700;
        }

        .delete-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.75rem;
        }

        .delete-modal-actions .btn {
            min-height: 44px;
            border-radius: 10px;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .delete-modal-actions .btn:hover,
        .delete-modal-actions .btn:focus {
            transform: translateY(-2px);
        }

        .btn-confirm-delete {
            color: #fff;
            border-color: #b42318;
            background: linear-gradient(135deg, #b42318, #e04b3f);
            box-shadow: 0 8px 18px rgba(180, 35, 24, 0.2);
        }

        .btn-confirm-delete:hover,
        .btn-confirm-delete:focus {
            color: #fff;
            border-color: #8f1d14;
            background: linear-gradient(135deg, #8f1d14, #b42318);
            box-shadow: 0 12px 24px rgba(180, 35, 24, 0.3);
        }

        .delete-modal-actions .btn:active {
            transform: translateY(0);
        }

        @media (max-width: 575.98px) {
            .dashboard-card {
                border-radius: 18px;
            }

            .page-header {
                padding: 1.5rem !important;
            }

            .table > :not(caption) > * > * {
                padding: 0.85rem 1rem;
            }
        }
    </style>
</head>
<body>

<main class="container page-shell py-4 py-md-5">
    <div class="card dashboard-card">
        <header class="page-header p-4 p-md-5 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
            <div>
                <p class="text-uppercase small fw-semibold mb-2">Student manager</p>
                <h1 class="text-white fw-bold mb-2">Students list</h1>
                <p class="mb-0">Manage student records in one simple view.</p>
            </div>
            <a class="btn btn-add px-3 py-2 fw-semibold" href="create.php">+ Add student</a>
        </header>

        <div class="table-responsive bg-white">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Age</th>
                        <th scope="col" class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($students as $students): ?>
                    <tr>
                        <td class="student-id"><?= $students['id'] ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($students['name']) ?></td>
                        <td><?= htmlspecialchars($students['email']) ?></td>
                        <td><?= htmlspecialchars($students['age']) ?></td>
                        <td class="text-end text-nowrap">
                            <a class="action-link me-3" href="edit.php?id=<?= $students['id'] ?>">Edit</a>
                            <a
                                class="action-link delete-link"
                                href="delete.php?id=<?= $students['id'] ?>"
                                data-delete-name="<?= htmlspecialchars($students['name'], ENT_QUOTES, 'UTF-8') ?>"
                            >
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<div class="delete-modal-backdrop" id="deleteModal" role="presentation">
    <section class="delete-modal" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle" aria-describedby="deleteModalMessage">
        <div class="delete-modal-icon" aria-hidden="true">!</div>
        <h2 class="delete-modal-title mb-2" id="deleteModalTitle">Delete student?</h2>
        <p class="delete-modal-message mb-0" id="deleteModalMessage">
            Are you sure you want to delete <span class="delete-modal-name" id="deleteStudentName"></span>? This action cannot be undone.
        </p>
        <div class="delete-modal-actions">
            <button class="btn btn-light px-3" type="button" id="cancelDelete">Cancel</button>
            <a class="btn btn-confirm-delete px-3" id="confirmDelete" href="#">Delete student</a>
        </div>
    </section>
</div>

<script>
    const deleteModal = document.getElementById("deleteModal");
    const deleteStudentName = document.getElementById("deleteStudentName");
    const confirmDelete = document.getElementById("confirmDelete");
    const cancelDelete = document.getElementById("cancelDelete");
    let lastDeleteTrigger;

    function closeDeleteModal() {
        deleteModal.classList.remove("is-visible");
        document.body.style.overflow = "";

        if (lastDeleteTrigger) {
            lastDeleteTrigger.focus();
        }
    }

    document.querySelectorAll(".delete-link").forEach((deleteLink) => {
        deleteLink.addEventListener("click", (event) => {
            event.preventDefault();
            lastDeleteTrigger = deleteLink;
            deleteStudentName.textContent = deleteLink.dataset.deleteName;
            confirmDelete.href = deleteLink.href;
            deleteModal.classList.add("is-visible");
            document.body.style.overflow = "hidden";
            cancelDelete.focus();
        });
    });

    cancelDelete.addEventListener("click", closeDeleteModal);

    deleteModal.addEventListener("click", (event) => {
        if (event.target === deleteModal) {
            closeDeleteModal();
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && deleteModal.classList.contains("is-visible")) {
            closeDeleteModal();
        }
    });
</script>

</body>
</html>