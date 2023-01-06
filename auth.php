<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Website</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/auth.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<div class="container mt-5" id="container">
    <div class="form-container sign-up-container mt-2">
      <form id="SignUpForm" action="SignUp.inc.php" method="POST">
        <h1 class="font-weight-bold">Create An Account</h1>
        <div class="inputs">
        <div class="input-container">
		<input name ="firstname" id ="firstname" type="text" required=""/>
		<label>FIRSTNAME</label>		
	    </div>
        <div class="input-container">
		<input name ="lastname" id ="lastname" type="text" required=""/>
		<label>LASTNAME</label>		
	    </div>
        <div class="input-container">
		<input name="email" id ="email" type="text" required=""/>
		<label>EMAIL</label>		
	    </div>
        <div class="input-container">
		<input name="password" id ="password" type="password" required=""/>
		<label>PASSWORD</label>		
	    </div>
        </div>
        <button class="but" type="submit" id="SubmitButton" name="submit">Sign up</button>
        <?php
                if (isset($_GET["error1"])){
                    if ($_GET["error1"] == "invalidFirstName"){
                        echo"<p class=\"probleme\">FirstName is invalid</p>";
                    }else if ($_GET["error1"] == "invalidLastName"){
                        echo"<p class=\"probleme\">LastName is invalid</p>";
                    }else if ($_GET["error1"] == "invalidEmail"){
                        echo"<p class=\"probleme\">Email is invalid</p>";
                    }else if ($_GET["error1"] == "existingEmail"){
                        echo"<p class=\"probleme\">Email already exists</p>";
                    }else if ($_GET["error1"] == "emptyInput"){
                        echo"<p class=\"probleme\">Fill in all required fields!</p>";
                    }
                }
            ?>    
      </form>
    </div>

    <div class="form-container sign-in-container">
      <form id="SignInForm" action="SignIn.inc.php" method="POST">
        <h1 class="font-weight-bold">Sign in</h1>
        <p> use email : "debug@debug.com" and password : "1234" to access debug page. or just <a style="color : green" href="table.php">click here</a></p>
        <div class="input-container">
		<input name="SIemail" id ="SIemail" type="text" required=""/>
		<label>EMAIL</label>		
	    </div>
        <div class="input-container">
		<input name="SIpassword" id ="SIpassword" type="password" required=""/>
		<label>Password</label>		
	    </div>
        <button class="but "type="submit" id="SubmitButton" name="SIsubmit">Sign In</button>
        <?php
                if (isset($_GET["error2"])){
                    if ($_GET["error2"] == "WrongPassword"){
                        echo"<p class=\"probleme\">Password is incorrect</p>";
                    }else if ($_GET["error2"] == "EmailNotFound"){
                        echo"<p class=\"probleme\">Email does not exist</p>";
                    }else if ($_GET["error2"] == "emptyInput"){
                        echo"<p class=\"probleme\">Fill in all required fields!</p>";
                    }
                }
            ?>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1 class="font-weight-bold">Good to see you!<h1>
          <p>You already have an account? <br>Sign in!</p>
          <button class="but" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 class="font-weight-bold">Hello, Friend!</h1>
          <p>You don't have account yet? Join us!</p>
          <button class="but" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
      container.classList.add('right-panel-active');
    });

    signInButton.addEventListener('click', () => {
      container.classList.remove('right-panel-active');
    });
</script>
</body>
</html>