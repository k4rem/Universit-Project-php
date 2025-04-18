<?php
session_start();
include 'db.php';

// Optional: redirect if not logged in
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html
  lang="ar"
  dir="ltr"
  class="fontawesome-i2svg-active fontawesome-i2svg-complete"
>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/all.css" />
    <link rel="stylesheet" href="style/all.min.css" />
    <link rel="stylesheet" href="style/bootstrap.min.css" />
    <link rel="stylesheet" href="style/style.css?v=1.1" />
    <link rel="stylesheet" href="style/btn-effect.css?v=1.1" />
    <link rel="stylesheet" href="style/creatCase.css?v=1.1" />
    <link rel="stylesheet" href="style/blog.css?v=1.1" />
    <link rel="stylesheet" href="style/about.css?v=1.1" />
    <link rel="stylesheet" href="style/cases.css?v=1.1" />
    <link rel="stylesheet" href="style/login-modal.css?v=1.1" />
    <!--TODO fonts ---------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Parkinsans:wght@300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IT+Moderna:wght@100..400&family=Protest+Riot&display=swap"
      rel="stylesheet"
    />
    <!--TODO Fonts 2  ----------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Parkinsans:wght@300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IT+Moderna:wght@100..400&family=Protest+Riot&display=swap"
      rel="stylesheet"
    />
    <!-- *swiper -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <style>
      .container-modal {
        max-width: 800px;
        width: 100%;
        height: 1000px;
      }
    </style>
    <title>Taazur</title>
  </head>
  <body>

    <!--* ======================================================== start modal ======================================== -->
    <div class="login-modal">
      <div class="container-modal" id="container">
        <button id="close">X</button>
        <div class="form-container-modal sign-up">
        <form method="POST" action="signup.php" enctype="multipart/form-data" style="text-align: center;">
            <h1 class="my-4 fw-bold ">Create Account</h1>
            <input  type="text" name="first_name" placeholder="First Name" required />
            <input  type="text" name="last_name" placeholder="Last Name" required />
            <input  type="email" name="email" placeholder="Email" required />
              <input  type="text" name="phone_number" placeholder="Phone Number" required />
              <input  type="text" name="street" placeholder="Street Address" required />
              <input  type="text" name="city" placeholder="City" required />
              <select name="country" class="form-select my-2" required style="width: 99%;">
                <option value="">Select Country</option>
                <option value="Egypt">Egypt</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="Jordan">Jordan</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Qatar">Qatar</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Oman">Oman</option>
                <option value="Other">Other</option>
              </select>
              <input type="date" name="date_of_birth" placeholder="Date of Birth" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="hidden" name="role" id="role" value="patient" />

            <div class="account-type d-flex">
              <button type="button" class="type-btn sign-btn me-4 active" id="type1">Doctor</button>
              <button type="button" class="type-btn sign-btn" id="type2">Patient</button>
            </div>
            <div id="doc-info" style="display: none;">
              <p>If You Are A Doctor Please Provide Us:</p>
              <input type="text" name="license" placeholder="Medical License" />
              <input type="text" name="degree" placeholder="Medical Degree" />
              <input type="file" name="verification_id" required  style="width: 99%;"/>
            </div>
            <button type="submit" class="sign-btn mobile-signup-btn" style="width: 60%;">Sign Up</button>
          </form>
        </div>
        <div class="form-container-modal sign-in">
        <form class="d-flex" method="POST" action="login.php">
            <h1 class="fw-bold">Sign In</h1>
            <div class="social-icons">
              <a href="#" class="icon"
                ><i class="fa-brands fa-google-plus-g"></i
              ></a>
              <a href="#" class="icon"
                ><i class="fa-brands fa-facebook-f"></i
              ></a>
              <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
              <a href="#" class="icon"
                ><i class="fa-brands fa-linkedin-in"></i
              ></a>
            </div>
            <span>or use your email password</span>
            <input type="email" name="email" placeholder="Email" required style="width: 80%;"/>
            <input type="password" name="password" placeholder="Password" required style="width: 80%;"/>
            <a href="#" class="d-block">Forget Your Password?</a>
            <button type="submit" class="sign-btn mt-3" >Sign In</button>
          </form>
        </div>
        <div class="toggle-btn">
        <button id="register-mobile" onclick="document.getElementById('container').classList.add('right-panel-active')">Register</button>
        </div>
        <div class="toggle-container-modal">
          <div class="toggle">
            <div class="toggle-panel toggle-left">
              <h1>Welcome Back!</h1>
              <p>Enter your personal details to use all of site features</p>
              <button class="hidden sign-btn" id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
              <h1>Hello</h1>
              <p>
                Register with your personal details to use all of site features
              </p>
              <button class="hidden sign-btn" id="register">Sign Up</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--! ======================================================== end modal ======================================== -->
    <!--* ======================================================== start navbar ======================================== -->
    <header class="sticky-top">
      <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
          <a class="navbar-brand fw-bold" href="index.php">
            <img src="./imgs/logo2.png" alt="LOGO" width="30" height="50" />
            <span class="logo-text">Taazur</span>
          </a>
          <button
            class="navbar-toggler"
            id="toggle-color"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fa-solid fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul
              class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex justify-content-between"
            >
              <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'cases.php' ? 'active' : '' ?>" href="cases.php">Cases</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : '' ?>" href="blog.php">Blogs </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>" href="about.php">About</a>
              </li>
            </ul>
            
            <?php if (isset($_SESSION['user_id'])): ?>
  <div class="login d-flex align-items-center">
    <span class="me-2 fw-bold">Welcome, <?= $_SESSION['user_name'] ?></span>
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
  </div>
<?php else: ?>
  <div class="login">
    <button class="btn btn-login nav-link" id="show-login">
      <i class="fa-solid fa-user fs-4"></i>
    </button>
  </div>
<?php endif; ?>

          </div>
        </div>
      </nav>
    </header>
<?php if (isset($_GET['status'])): ?>
  <div class="alert text-center mb-0 rounded-0 
    <?= $_GET['status'] === 'success' ? 'alert-success' : 'alert-danger' ?>">
    <?php
      switch ($_GET['status']) {
        case 'success':
          echo 'Donation successful!';
          break;
        case 'unauthorized':
          echo 'Only logged-in patients can donate.';
          break;
        case 'invalid':
          echo 'Invalid donation data. Please try again.';
          break;
        default:
          echo 'Unexpected error.';
      }
    ?>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['signup_error'])): ?>
  <div class="alert alert-danger text-center mb-0 rounded-0">
    <?= $_SESSION['signup_error']; unset($_SESSION['signup_error']); ?>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['signup_success'])): ?>
  <div class="alert alert-success text-center mb-0 rounded-0">
    <?= $_SESSION['signup_success']; unset($_SESSION['signup_success']); ?>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['login_error'])): ?>
  <div class="alert alert-danger text-center mb-0 rounded-0">
    <?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['login_success'])): ?>
  <div class="alert alert-success text-center mb-0 rounded-0">
    <?= $_SESSION['login_success']; unset($_SESSION['login_success']); ?>
  </div>
<?php endif; ?>
<?php if (isset($_SESSION['message'])): ?>
  <div class="alert alert-info text-center mb-0 rounded-0 alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($_SESSION['message']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>
<script>
  document.getElementById('type1').onclick = () => {
    document.getElementById('role').value = 'doctor';
    document.getElementById('doc-info').style.display = 'block';
  };

  document.getElementById('type2').onclick = () => {
    document.getElementById('role').value = 'patient';
    document.getElementById('doc-info').style.display = 'none';
  };
</script>
<script>
  const docInfo = document.getElementById('doc-info');
  const roleInput = document.getElementById('role');
  const verificationInput = document.querySelector('input[name="verification_id"]');

  document.getElementById('type1').onclick = () => {
    roleInput.value = 'doctor';
    docInfo.style.display = 'block';
    verificationInput.setAttribute('required', true);
  };

  document.getElementById('type2').onclick = () => {
    roleInput.value = 'patient';
    docInfo.style.display = 'none';
    verificationInput.removeAttribute('required');
  };
</script>