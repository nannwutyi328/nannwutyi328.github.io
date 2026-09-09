<?php
    //Student Management System


    #1. Indexed Array
    //List of subjects
    $subjects =array("Java","PHP","Python","C#","JavaScript");

    //2. Multidimensional Array
    //student information
    $students = [
        ["name" => "Alice" , "age" => 20,  [78,99,55,66,88]],
        ["name" => "Bob" , "age" => 22,  [88,77,66,55,88]],
        ["name" => "Charlie" , "age" => 21,  [90,80,70,60,90]],
        ["name" => "David" , "age" => 23,  [85,75,65,55,100]],
        ["name" => "Eve" , "age" => 20,  [95,85,100,65,75]]

    ];

    //display subjects
    echo "<!doctype html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='utf-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    echo "<title>Student Management System</title>";
    echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>";
    echo "<link rel='preconnect' href='https://fonts.googleapis.com'>";
    echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>";
    echo "<link href='https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap' rel='stylesheet'>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>";
    echo "<style>";
    echo ":root{--ink:#14213d;--muted:#68758b;--primary:#3563e9;--surface:#fff;--line:#e8edf5}*{box-sizing:border-box}body{font-family:'DM Sans',sans-serif;color:var(--ink);background:#f5f7fb;background-image:radial-gradient(#dce5f5 1px,transparent 1px);background-size:24px 24px}.brand-font,h1,h2{font-family:'Space Grotesk',sans-serif}.page-shell{max-width:1180px}.hero{background:linear-gradient(120deg,#14213d 0%,#23458f 100%);border-radius:24px;color:#fff;overflow:hidden;position:relative}.hero:after{content:'';position:absolute;width:260px;height:260px;border:1px solid rgba(255,255,255,.16);border-radius:50%;right:-80px;top:-100px}.hero-content{position:relative;z-index:1}.eyebrow{letter-spacing:.12em;font-size:.72rem}.stat-card,.content-card{background:var(--surface);border:1px solid var(--line);border-radius:16px;box-shadow:0 10px 30px rgba(32,56,98,.06)}.stat-icon{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;background:#edf2ff;color:var(--primary);font-size:1.15rem}.content-card{overflow:hidden}.section-label{color:var(--muted);font-size:.82rem;font-weight:600;letter-spacing:.04em}.subject-pill{background:#f7f9fd;border:1px solid var(--line);color:#3d4b63;transition:all .2s ease}.subject-pill:hover{background:#edf2ff;border-color:#b9caff;color:var(--primary)}.table thead th{background:#f7f9fd;color:var(--muted);font-size:.72rem;letter-spacing:.06em;text-transform:uppercase;border-bottom:1px solid var(--line);padding:1rem 1.25rem}.table tbody td{padding:1rem 1.25rem;border-color:#eef1f6;color:#526078}.table tbody tr:last-child td{border-bottom:0}.student-name{color:var(--ink)}.score-badge{background:#eaf8f1;color:#198754;font-weight:600}.table-responsive{min-height:180px}@media(max-width:575.98px){.hero{border-radius:18px}.hero h1{font-size:2rem}.table{min-width:620px}.page-shell{padding-left:1rem;padding-right:1rem}}";
    echo "</style></head>";
    echo "<body>";
    echo "<main class='container page-shell py-4 py-md-5'>";
    echo "<section class='hero p-4 p-md-5 mb-4'>";
    echo "<div class='hero-content d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-4'>";
    echo "<div><p class='eyebrow text-uppercase fw-bold text-info mb-3'>Academic Overview</p>";
    echo "<h1 class='display-5 fw-bold mb-2'>Student Management</h1>";
    echo "<p class='mb-0 text-white-50'>A clear view of students and academic performance.</p></div>";
    echo "<div class='d-flex align-items-center gap-2'><span class='badge rounded-pill bg-white text-primary px-3 py-2'><i class='bi bi-calendar3 me-2'></i>Current Session</span></div>";
    echo "</div></section>";

    echo "<div class='row g-3 mb-4'>";
    echo "<div class='col-12 col-sm-6 col-lg-4'><div class='stat-card p-3 h-100 d-flex align-items-center gap-3'><div class='stat-icon'><i class='bi bi-people-fill'></i></div><div><div class='section-label text-uppercase'>Total Students</div><div class='brand-font fs-3 fw-bold'>" . count($students) . "</div></div></div></div>";
    echo "<div class='col-12 col-sm-6 col-lg-4'><div class='stat-card p-3 h-100 d-flex align-items-center gap-3'><div class='stat-icon'><i class='bi bi-journal-bookmark-fill'></i></div><div><div class='section-label text-uppercase'>Subjects Offered</div><div class='brand-font fs-3 fw-bold'>" . count($subjects) . "</div></div></div></div>";
    echo "<div class='col-12 col-lg-4'><div class='stat-card p-3 h-100 d-flex align-items-center gap-3'><div class='stat-icon'><i class='bi bi-bar-chart-fill'></i></div><div><div class='section-label text-uppercase'>Assessment Type</div><div class='brand-font fs-5 fw-bold'>Subject Scores</div></div></div></div>";
    echo "</div>";

    echo "<section class='content-card mb-4'>";
    echo "<div class='p-4'><div class='d-flex align-items-center gap-2 mb-3'><i class='bi bi-grid-3x3-gap-fill text-primary'></i><h2 class='h5 fw-bold mb-0'>Subjects Offered</h2></div>";
    echo "<div class='d-flex flex-wrap gap-2'>";
    foreach($subjects as $subject){
        echo "<span class='subject-pill rounded-pill px-3 py-2'>".$subject."</span>";
    }
    echo "</div></div></section>";


    //calculate total marks for each student and average marks
    echo "<section class='content-card'>";
    echo "<div class='p-4 pb-3 d-flex flex-column flex-sm-row justify-content-between gap-2'><div><div class='d-flex align-items-center gap-2 mb-1'><i class='bi bi-person-vcard-fill text-primary'></i><h2 class='h5 fw-bold mb-0'>Student Information</h2></div>";
    echo "<p class='section-label mb-0'>Performance summary by student</p></div><span class='section-label align-self-start'>" . count($students) . " records</span></div>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-hover align-middle mb-0'>";
    echo "<thead class='table-dark'><tr><th scope='col'>Name</th><th scope='col'>Age</th><th scope='col'>Total Marks</th><th scope='col'>Average Marks</th></tr></thead>";
    
    foreach($students as $student){
       $name = $student["name"];
         $age = $student["age"];
         $marks = $student[0];
         $totalMarks = array_sum($marks);
            $averageMarks = $totalMarks / count($marks);

            echo "<tr><td class='student-name fw-bold'>".$name."</td><td>".$age." years</td><td class='fw-semibold text-dark'>".$totalMarks."</td><td><span class='score-badge rounded-pill px-3 py-2'>".number_format($averageMarks, 2)."</span></td></tr>";


    }
    echo "</tbody></table></div></section>";
    echo "</main></body></html>";
    

?>