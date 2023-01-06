<?php
session_start();
require_once 'dbh.php';
?>   
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UserAccount</title>
  <link rel="stylesheet" href="css/landing.css">
  <link rel="stylesheet" href="css/UserAccount.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:700,400">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
</head>

<body>

<div class="navbar-wrapper">
  <div class="container">

    <nav class="navbar navbar-light navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          <a class="navbar-brand brand-name" href="index.php">La MediaTech.</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
          </ul>
        </div>
      </div>
    </nav>

  </div>
</div>



  <div class="layout">
    <input name="nav" type="radio" class="nav MyAccount-radio" id="MyAccount" checked="checked" />
    <div class="page MyAccount-page">
      <div class="page-contents">
        <h1>User Information</h1>
        <div>
          <div> Firstname :   <?php echo "<p  style='display: inline; font-weight: 600; margin-left: 100px'>" . $_SESSION["firstname"] . "</p>" ?> </div>
          <div>Lastname : <?php  echo "<p  style='display: inline; font-weight: 600; margin-left: 100px'>" . $_SESSION["lastname"] . "</p>"?> </div>
          <div >abonnement : <?php  echo "<p  style='display: inline; font-weight: 600; margin-left: 60px'>" . $_SESSION["abonnement"] . "</p>" ?> </div>
          <div>E-mail : <?php  echo "<p  style='display: inline; font-weight: 600; margin-left: 50px'>" . $_SESSION["email"] . "</p>"?></div>

          <div class="ButtonContainer">

            <button type="submit" class="SubmitButton" id="SubmitButtonBlue" name="submit">Edit My Information</button>

        </div>

        <div class="hover_bg" id="hover_bg_Form">
    <span class="helper"></span>
    <div>
        <div class="close">&times;</div>
        <form id="form1" action="UserAccount.intelmod.inc.php" method="POST">
          <h1>Edit Profile</h1>
          <?php
          echo"
        <div id='FN'>
        <label for='FirstName' class='form__label'>FirstName : </label>
                    <input type='text' value='" . $_SESSION["firstname"] . "' id='FirstName' name='firstName' class='form_field' onchange='this.setAttribute('value', this.value);' required>
                    
                   
                </div>

                <div id='LN'>
                <label for='LastName' class='form__label'>LastName : </label>
                    <input type='text' value='" . $_SESSION["lastname"] . "' id='LastName' name='lastName' class='form_field' onchange='this.setAttribute('value', this.value);' required>
                    

                </div>

                <div id='EM'>
                <label for='email' class='form__label'>E-mail : </label>
                    <input type='email' value='" . $_SESSION["email"] . "' id='email' name='email' class='form_field' onchange='this.setAttribute('value', this.value);' required>
                    
                </div>

                <div id='pass'>
                <label for='Password' class='form__label'>confirm password : </label> 
                    <input type='Password' name='Password' id='Password' class='form_field' onchange='this.setAttribute('value', this.value);' required>
                    

                </div>" ?>

                <div id="ButtonContainer">

                    <button type="submit" id="SubmitButton" name="submit">Confirm</button>

                </div>

                <?php
                if (isset($_GET["error"])){
                    if ($_GET["error"] == "invalidFirstName"){
                        echo"<p class=\"probleme\">FirstName is invalid</p>";
                    }else if ($_GET["error"] == "invalidLastName"){
                        echo"<p class=\"probleme\">LastName is invalid</p>";
                    }else if ($_GET["error"] == "invalidEmail"){
                        echo"<p class=\"probleme\">Email is invalid</p>";
                    }else if ($_GET["error"] == "existingEmail"){
                        echo"<p class=\"probleme\">Email already exists</p>";
                    }else if ($_GET["error"] == "emptyInput"){
                        echo"<p class=\"probleme\">Fill in all required fields!</p>";
                    }
                }
            ?>
        </form>

        <form id="form2" action="UserAccount.passmod.inc.php" method="POST">
          
          <h1>Edit Password</h1>
<div style="margin-top : 25%">
          <div id='passConfirmation'>
          <label for='OldPassword' class='form__label'>Current Password </label> 
                    <input type='Password' value='' name='OldPassword' id='OldPassword' placeholder='PassWord' class='form_field' onchange='this.setAttribute('value', this.value);' required>
                    

                </div>

                <div id='Newpass'>
                <label for='NewPassword' class='form__label'>New Password </label> 
                    <input type='Password' placeholder='New Password' value='' name='NewPassword' id='NewPassword' class='form_field' onchange='this.setAttribute('value', this.value);' required>
                    

                </div>

                <div id="ButtonContainer">

                      <button type="submit" id="SubmitButton" name="submit">Confirm</button>

                </div>
              </div>
                <?php
                if (isset($_GET["error"])){
                    if ($_GET["error"] == "invalidPassWord"){
                        echo"<p class=\"probleme\">Wrong Password</p>";
                    }
                }
            ?>
        </form>
    </div>
</div>


        <div class="ButtonContainer" style="top : -15px; position : relative;">

          <button type="submit" class="SubmitButton" id="SubmitButtonRed" name="submit">Delete My Account</button>

      </div>

    <div class="hover_bg" id="hover_bg_Delete">
    <span class="helper"></span>
    <div id="deletion">
        <div class="close">&times;</div>
        <form id="formDelete"action="delete.php" method="POST">
          
          <h1>Delete Account</h1>
          <p style="color: red ;">CAUTION : THIS ACTION IS IRREVERSIBLE</p>
<div style="margin-top : 5%">
          <div id='passConfirmation'>
          <label for='OldPassword' class='form__label'>Password </label> 
                    <input type='Password' value='' name='Password' id='Password' placeholder='PassWord' class='form_field' onchange='this.setAttribute('value', this.value);' required>
                </div>

                <div id="ButtonContainer" style="top : -15px; position : relative; left : -5%;">

                      <button type="submit" id="SubmitButton" name="submit">Confirm</button>

                </div>

              </div>
                <?php
                if (isset($_GET["error"])){
                    if ($_GET["error"] == "invalidPassWord"){
                        echo"<p class=\"probleme\">Wrong Password</p>";
                    }
                }
            ?>
        </form>
    </div>
</div>

        </div>
      </div>
    </div>
    <label class="nav" for="MyAccount">
      <span>
        <svg viewBox="0 0 20 20" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none"
          stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
          <path
            d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z">
          </path>
        </svg>
        My Account
      </span>
    </label>
            </div>

            <script>$(window).on('load', function() {
  $("#SubmitButtonRed").click(function(){
     $('#hover_bg_Delete').show();
  });
  $('.close').click(function(){
      $('#hover_bg_Delete').hide();
  });

  $("#SubmitButtonBlue").click(function(){
      $('#hover_bg_Form').show();
   });
   
   $('.close').click(function(){
       $('#hover_bg_Form').hide();
   });

   $(".trigger_popup_friccREP").click(function(){
    $('.hover_bkgr_friccREP').show();
 });

 $('.popupCloseButtonREP').click(function(){
     $('.hover_bkgr_friccREP').hide();
 });
});</script>

</body>
</html>