<?php
    session_start();
    if(isset($_SESSION['unique_id']))
    {
        header("location: home.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
   
    <link rel="stylesheet" href="assets/css/signup.css">
    
</head>
<body>

      <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="" action="">
          <h2 class="form_title title">MyanLearn Account Login</h2>
          <div class="form__icons">
          <i class='bx bxl-facebook form__icon facebook'></i>  
          <i class='bx bxl-google form__icon google'></i>
          <i class='bx bxl-apple form__icon apple'></i>
          </div>
          <span class="form__span">or Login with Email</span>
          <span class="warningNote"><p>Please agree to the Terms of Service and Privacy Policy!</p></span>
          <input class="form__input" type="text" name="email" placeholder="Email" required autofocus>

          <div class="form__input passwordInput">
            <input type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required onfocus="myFunction(this)" onfocusout="PasswordFocusOut(this)">
            <i class='bx bxs-hide visibility'></i>
          </div>

          <div class="cntr CheckBoxWrapper labelWrapper">
              <label>Don't have an account? <a href="signup.php" class="loginLabel">Register Now</a></label>
          </div>  

          <button class="form__button button submit">LOG IN</button>

          <div class="Footer">
              <label class="labelFooter">© 2020 - 2022 MyanLearn. All rights reserved</label>
          </div>  

        </form>

      </div>
      
      
  <script type="text/javascript">
   const visibilityToggle = document.querySelector('.visibility');

const input = document.querySelector('.passwordInput input');

var password = true;

visibilityToggle.addEventListener('click', function() {
  if (password) {
    input.setAttribute('type', 'text');
    visibilityToggle.classList.replace("bxs-hide", "bx-show-alt");
  } else {
    input.setAttribute('type', 'password');
    visibilityToggle.classList.replace("bx-show-alt", "bxs-hide");
  }
  password = !password;
  
});



function myFunction(x) {
  document.querySelector(".passwordInput").classList.add('passwordFocus');
}

function PasswordFocusOut(x){
   document.querySelector(".passwordInput").classList.remove('passwordFocus');
}
</script>

<script src="assets/js/login.js"></script>

</body>
</html>