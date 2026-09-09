<html>

<body>
    
<!-- <h2>Add User</h2>
<form action="Post">

    <label for="">Name</label>
   
    <input type="text" name="" required>
 <br> <br>

    <label for="">Email</label>
    <input type="text" name="email" required>
 <br> <br>
    <button type="submit">Save</button>
 -->
  
<!-- require must have and not work without it -->
<!-- include is word without it -->





<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Add User | User Manager</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
   <style>
      :root {
         --ink: #17202a;
         --muted: #6e7781;
         --teal: #087f8c;
         --teal-dark: #05616b;
         --peach: #fff4ec;
      }

      * { box-sizing: border-box; }

      body {
         min-height: 100vh;
         margin: 0;
         color: var(--ink);
         font-family: "DM Sans", sans-serif;
         background: #f7fbfa;
         background-image: linear-gradient(120deg, rgba(8, 127, 140, .08), transparent 42%),
            radial-gradient(circle at 92% 10%, rgba(250, 177, 126, .24), transparent 28%);
      }

      .page-shell { min-height: 100vh; }

      .brand-mark {
         display: inline-grid;
         width: 42px;
         height: 42px;
         place-items: center;
         color: white;
         font-family: "Space Grotesk", sans-serif;
         font-weight: 700;
         border-radius: 12px;
         background: var(--teal);
         box-shadow: 0 8px 18px rgba(8, 127, 140, .22);
      }

      .eyebrow {
         color: var(--teal);
         font-size: .75rem;
         font-weight: 700;
         letter-spacing: .12em;
         text-transform: uppercase;
      }

      h1, h2 { font-family: "Space Grotesk", sans-serif; }

      .form-panel {
         overflow: hidden;
         border: 1px solid rgba(8, 127, 140, .13);
         border-radius: 24px;
         background: rgba(255, 255, 255, .9);
         box-shadow: 0 22px 60px rgba(30, 68, 70, .1);
      }

      .panel-intro {
         color: white;
         background: var(--teal);
         background-image: linear-gradient(145deg, rgba(255,255,255,.09), transparent 60%);
      }

      .panel-intro p { color: rgba(255, 255, 255, .75); }

      .form-control {
         min-height: 52px;
         border-color: #dce7e5;
         border-radius: 12px;
      }

      .form-control:focus {
         border-color: var(--teal);
         box-shadow: 0 0 0 .2rem rgba(8, 127, 140, .13);
      }

      .form-label { margin-bottom: .5rem; font-weight: 600; }
      .form-text { color: var(--muted); }

      .btn-save {
         min-height: 52px;
         border: 0;
         border-radius: 12px;
         background: var(--teal);
         font-weight: 700;
      }

      .btn-save:hover, .btn-save:focus { background: var(--teal-dark); }
      .required { color: #d36a45; }

      @media (max-width: 767.98px) {
         .form-panel { border-radius: 18px; }
         .panel-intro { padding: 2rem 1.5rem !important; }
      }
   </style>
</head>

<body>
   <main class="page-shell d-flex align-items-center py-4 py-md-5">
      <div class="container">
         <header class="d-flex align-items-center gap-3 mb-4 mb-md-5">
            <span class="brand-mark" aria-hidden="true">UM</span>
            <div>
               <div class="fw-bold">User Manager</div>
               <small class="text-secondary">Simple people directory</small>
            </div>
         </header>

         <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
               <section class="form-panel row g-0">
                  <div class="panel-intro col-lg-5 p-4 p-md-5 d-flex flex-column justify-content-between">
                     <div>
                        <span class="eyebrow text-white-50">New profile</span>
                        <h1 class="display-6 fw-bold mt-3 mb-3">Add a new user</h1>
                        <p class="mb-0">Create a clean profile so your team can find the right person at a glance.</p>
                     </div>
                     <div class="d-none d-lg-block mt-5 small text-white-50">All fields marked with <span class="required">*</span> are required.</div>
                  </div>

                  <div class="col-lg-7 p-4 p-md-5">
                     <div class="mb-4">
                        <span class="eyebrow">Profile details</span>
                        <h2 class="h3 mt-2 mb-1">Personal information</h2>
                        <p class="form-text mb-0">Enter the details below to get started.</p>
                     </div>

                     <form action="Post" method="post">
                        <div class="mb-3">
                           <label for="name" class="form-label">Full name <span class="required">*</span></label>
                           <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Aye Aye Win" autocomplete="name" required>
                        </div>

                        <div class="mb-4">
                           <label for="email" class="form-label">Email address <span class="required">*</span></label>
                           <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" autocomplete="email" required>
                           <div class="form-text mt-2">We will use this to contact the user.</div>
                        </div>

                        <button type="submit" class="btn btn-save btn-primary w-100">Save user <span aria-hidden="true">&rarr;</span></button>
                     </form>
                  </div>
               </section>
            </div>
         </div>
      </div>
   </main>
</body>

</html>