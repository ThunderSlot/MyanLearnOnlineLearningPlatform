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
	<title>MyanLearn Signup Page</title>
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
          <h2 class="form_title title">Register Account</h2>
          <div class="form__icons">
          <i class='bx bxl-facebook form__icon facebook'></i>  
          <i class='bx bxl-google form__icon google'></i>
          <i class='bx bxl-apple form__icon apple'></i>
          </div>
          <span class="form__span">or Register with Email</span>
          <span class="warningNote"><p>Please agree to the Terms of Service and Privacy Policy!</p></span>
          <input class="form__input" type="text" name="fullName" placeholder="Name" required autofocus>
          <input class="form__input" type="email" name="email" placeholder="Email" required>

          <div class="form__input passwordInput">
            <input type="password" name="password" class="password" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title=" Please enter atleast 8 charatcer with number, symbol, small and capital letter." required onfocus="myFunction(this)" onfocusout="PasswordFocusOut(this)">
            <i class='bx bxs-hide visibility'></i>
          </div>
          
        
          <div class="form__input passwordInput confirmPassword">
            <input type="password" name="confirmPassword" class="cPassword" placeholder="Confirm Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title=" Please enter atleast 8 charatcer with number, symbol, small and capital letter." required onfocus="myFunction1(this)" onfocusout="PasswordFocusOut1(this)"> 
            <i class='bx bxs-hide visibility1 visibility'></i>
          </div>
          <span class="confirmPasswordWrapper">
            <span class="error cPassword-error">
              <i class="bx bx-error-circle error-icon"></i>
              <p class="error-text">Password don't match</p>
            </span>
          </span>

          <div class="cntr CheckBoxWrapper">
              <input type="checkbox" name="agreeCheck" id="cbx" class="hidden-xs-up">
              <label for="cbx" class="cbx" ></label>
              <label for="cbx" class="checkboxLabel">I agree to <b>MyanLearn</b>'s Terms of Service and Privacy Policy.</label>
          </div>          

          <div class="cntr CheckBoxWrapper labelWrapper">
              <label>Already have an account? <a href="login.php" class="loginLabel">Log in Now</a></label>
          </div>  

          <input type="submit" class="form__button button submit" value="Sign Up"></input>

          <div class="Footer">
              <label class="labelFooter">© 2020 - 2022 MyanLearn. All rights reserved</label>
          </div>  

        </form>

      </div>
      
  <!-- Show Hide Password -->
  <script type="text/javascript">

const visibilityToggle = document.querySelector('.visibility');
const visibilityToggle1 = document.querySelector('.visibility1');
const input = document.querySelector('.passwordInput input');
const input1 = document.querySelector('.passwordInput .cPassword');
var password = true;

visibilityToggle.addEventListener('click', function() {
  if (password) {
    input1.setAttribute('type', 'text');
    visibilityToggle1.classList.replace("bxs-hide", "bx-show-alt");
    input.setAttribute('type', 'text');
    visibilityToggle.classList.replace("bxs-hide", "bx-show-alt");
  } else {
    input1.setAttribute('type', 'password');
    visibilityToggle1.classList.replace("bx-show-alt", "bxs-hide");
    input.setAttribute('type', 'password');
    visibilityToggle.classList.replace("bx-show-alt", "bxs-hide");
  }
  password = !password;
  
});

visibilityToggle1.addEventListener('click', function() {
  if (password) {
    input1.setAttribute('type', 'text');
    visibilityToggle1.classList.replace("bxs-hide", "bx-show-alt");
    input.setAttribute('type', 'text');
    visibilityToggle.classList.replace("bxs-hide", "bx-show-alt");
  } else {
    input1.setAttribute('type', 'password');
    visibilityToggle1.classList.replace("bx-show-alt", "bxs-hide");
    input.setAttribute('type', 'password');
    visibilityToggle.classList.replace("bx-show-alt", "bxs-hide");
  }
  password = !password;
  
});


// Hightlight on focus
function myFunction(x) {
  document.querySelector(".passwordInput").classList.add('passwordFocus');
}

function PasswordFocusOut(x){
   document.querySelector(".passwordInput").classList.remove('passwordFocus');
}

function myFunction1(x) {
  document.querySelector(".confirmPassword").classList.add('passwordFocus');
}

function PasswordFocusOut1(x){
   document.querySelector(".confirmPassword").classList.remove('passwordFocus');
}

// checkbox validate
function checkbloxValidate() {
      if (!document.querySelector("#cbx").checked) {
        document.querySelector(".warningNote").classList.add("show");
        document.querySelector("#cbx").classList.add("notCheck");
        
        // alert (checkStatus);
      } 
    var checkStatus = 1; 
  }

document.querySelector("#cbx").addEventListener('click', function() {
    if(checkStatus = 1 ){
      if (document.querySelector("#cbx").checked) {
        document.querySelector(".warningNote").classList.remove("show");
        document.querySelector("#cbx").classList.remove("notCheck");
      } 
      else{
        document.querySelector(".warningNote").classList.add("show");
        document.querySelector("#cbx").classList.add("notCheck");
      }
    }

  });

// Confirm password

function confirmPasswordValidation() {
  if (document.querySelector(".password").value !== document.querySelector(".cPassword").value || document.querySelector(".cPassword").value === "") 
  {
    document.querySelector(".confirmPassword").classList.add("invalidConfirmPassword");
    return document.querySelector(".confirmPasswordWrapper").classList.add("invalid");
  }
  else if (document.querySelector(".confirmPassword").classList.contains("invalidConfirmPassword")){
    document.querySelector(".confirmPassword").classList.replace("invalidConfirmPassword", "validInput");
  return document.querySelector(".confirmPasswordWrapper").classList.replace("invalid", "dfd");
  }
  
}

document.querySelector(".cPassword").addEventListener("keyup", confirmPasswordValidation);
// document.querySelector(".cPassword").addEventListener("focus", confirmPasswordValidation);
document.querySelector(".cPassword").addEventListener('focus', function() {
  if (document.querySelector(".password").value !== document.querySelector(".cPassword").value || document.querySelector(".cPassword").value === "") 
  {
    document.querySelector(".confirmPassword").classList.add("invalidConfirmPassword");
    return document.querySelector(".confirmPasswordWrapper").classList.add("invalid");
  }
  else if (document.querySelector(".confirmPassword").classList.contains("invalidConfirmPassword")){
    document.querySelector(".confirmPassword").classList.replace("invalidConfirmPassword", "validInput");
  return document.querySelector(".confirmPasswordWrapper").classList.replace("invalid", "dfd");
  }

  });

const form = document.querySelector("form");

form.addEventListener("submit", (e) => {
  e.preventDefault(); //preventing form submitting


});

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets/js/signup.js"></script>

</body>
</html>