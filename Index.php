

<?php 
session_start(); 
include_once 'inc/header.php';

?>
<div class="home" id="homepage">

<div class="container">

        <div class="logo">
            <img src="img/notelogo.png" alt="Logo"  id="spinningLogo">
</div>
        <div class="content">
            <h1>Welcome to Online Note App</h1>
            <p>Hello there! Welcome to my world of notes, where organization meets creativity.
                <br> I'm your trusty online note app, designed to be your digital companion in capturing
                <br> thoughts, ideas, and inspirations effortlessly. With a sleek interface and intuitive
                <br> features, I strive to make your note-taking experience seamless and enjoyable.
                <br> Whether you're jotting down meeting minutes, brainstorming for your next big project,
                <br> or simply keeping track of your daily to-dos, I've got you covered. From customizable
                <br> formatting options to seamless synchronization across devices, I'm here to adapt to
                <br> your unique needs and preferences. Let's embark on this journey together, where
                <br> every note is a canvas waiting for your ideas to flourish.</p>
</div>
   
</div>

</div>





<div class="form-box" id="form_box" style="display: none;">
        
        

        <div class="login-container" id="login" >
            <div class="top">
                <span>Don't have an account? <a href="#" onclick="showRegistrationForm()">Sign Up</a></span>
                <header>Login</header>
            </div>
            <form action="include/login.php" method="POST">
            <div class="input-box">
           
                <input type="text" class="input-field" placeholder="Email" id="email" name="email" value="<?php echo isset($_SESSION['Loginsubmitted_values']['email']) ? htmlspecialchars($_SESSION['Loginsubmitted_values']['email']) : ''; ?>">
                <i class="bx bx-envelope"></i>
                <?php if (isset($_SESSION['errors1']['email'])) { echo '<div class="error1">' . $_SESSION['errors1']['email'] . '</div>'; } ?>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password" id="password" name="password" value="<?php echo isset($_SESSION['Loginsubmitted_values']['password']) ? htmlspecialchars($_SESSION['Loginsubmitted_values']['password']) : ''; ?>">
                <i class="bx bx-lock-alt"></i>
                <?php if (isset($_SESSION['errors1']['password'])) { echo '<div class="error1">' . $_SESSION['errors1']['password'] . '</div>'; } ?>
            </div>
           
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Forgot password?</a></label>
                </div>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" id="signin" value="Sign In">
            </div>
            </form>
        </div>

      
        <div class="register-container" id="register">
            <div class="top">
                <span>Have an account? <a href="#" onclick="showLoginForm()">Login</a></span>
                <header>Sign Up</header>
            </div>
            <form action="include/insertion.php" method="POST">
                <div class="input-box">
                     
                <input type="text" class="input-field" placeholder="Username" id="name1" name="name1" value="<?php echo isset($_SESSION['submitted_values']['name1']) ? htmlspecialchars($_SESSION['submitted_values']['name1']) : ''; ?>">
                    <i class="bx bx-user"></i>
                    <?php if (isset($_SESSION['errors']['name1'])) { echo '<div class="error">' . $_SESSION['errors']['name1'] . '</div>'; } ?>
                </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Email" id="email1" name="email1" value="<?php echo isset($_SESSION['submitted_values']['email1']) ? htmlspecialchars($_SESSION['submitted_values']['email1']) : ''; ?>">
                <i class="bx bx-envelope"></i>
                <?php if (isset($_SESSION['errors']['email1'])) { echo '<div class="error">' . $_SESSION['errors']['email1'] . '</div>'; } ?>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password" id="password1" name="password1" value="<?php echo isset($_SESSION['submitted_values']['password1']) ? htmlspecialchars($_SESSION['submitted_values']['password1']) : ''; ?>">
                <i class="bx bx-lock-alt"></i>
                <?php if (isset($_SESSION['errors']['password1'])) { echo '<div class="error">' . $_SESSION['errors']['password1'] . '</div>'; } ?>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" id="register" value="Register">
            </div>
            </form>
        </div>
        </div>   


        <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");
            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }
    </script>

<script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function showLoginForm() {
        resetRegistrationForm();
        x.style.left = "4px";
        y.style.right = "-520px";
        x.style.opacity = 1;
        y.style.opacity = 0;
        document.getElementById("form_box").style.display = "block";
        document.getElementById("homepage").style.display = "none";
    }

    function showRegistrationForm() {
        resetLoginForm();
        x.style.left = "-510px";
        y.style.right = "5px";
        x.style.opacity = 0;
        y.style.opacity = 1;
        document.getElementById("form_box").style.display = "block";
        document.getElementById("homepage").style.display = "none";
    }


    function hideForm() {
        resetRegistrationForm();
        resetLoginForm();
            document.getElementById("form_box").style.display = "none";
            document.getElementById("homepage").style.display = "block";
        }
</script>


<script>
    function resetRegistrationForm() {
        // Clear form fields
        document.getElementById('name1').value = '';
        document.getElementById('email1').value = '';
        document.getElementById('password1').value = '';
        
        // Hide any displayed errors
        var errorElements = document.getElementsByClassName('error');
        for (var i = 0; i < errorElements.length; i++) {
            errorElements[i].style.display = 'none';
        }
    }
</script>

<script>
    function resetLoginForm() {
        // Clear form fields
      
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
        
        // Hide any displayed errors
        var errorElements = document.getElementsByClassName('error1');
        for (var i = 0; i < errorElements.length; i++) {
            errorElements[i].style.display = 'none';
        }
    }
</script>




<script>
    window.onload = function() {
        <?php if (!empty($_SESSION['errors']) && empty($_SESSION['errors1'])) : ?>
            showRegistrationForm();
        <?php elseif (!empty($_SESSION['errors1']) && empty($_SESSION['errors'])) : ?>
            showLoginForm();
        <?php endif; ?>
    };
</script>




<!-- Add this script tag at the end of your HTML body -->
<script>
    // Get all input fields
    var inputFields = document.querySelectorAll('input[type="text"], input[type="password"]');

    // Iterate over each input field
    inputFields.forEach(function(inputField) {
        // Add event listener for keydown event
        inputField.addEventListener('keydown', function(event) {
            // Check if the pressed key is the spacebar and the input field is focused
            if (event.keyCode === 32 && document.activeElement === inputField) {
                // Prevent the default spacebar behavior
                event.preventDefault();
            }
        });
    });
</script>

<!-- Add this script tag at the end of your HTML body -->
<script>
    // Get the username input field
    var usernameField = document.getElementById('name1');

    // Flag to track if a character has been entered
    var characterEntered = false;

    // Flag to track if space is allowed
    var spaceAllowed = false;

    // Add event listener for keydown event
    usernameField.addEventListener('keydown', function(event) {
        // Check if the pressed key is the spacebar
        if (event.keyCode === 32) {
            // Prevent the default spacebar behavior
            event.preventDefault();
            // Check if a character has been entered before allowing a space
            if (characterEntered && spaceAllowed) {
                // Append space to the input value
                this.value += ' ';
                // Set space allowed flag to false
                spaceAllowed = false;
            }
        } else {
            // Set character entered flag to true
            characterEntered = true;
            // Set space allowed flag to true if a character is entered
            spaceAllowed = true;
        }
    });

    // Add event listener for input event to reset flags if space is deleted
    usernameField.addEventListener('input', function(event) {
        if (event.inputType === 'deleteContentBackward' || event.inputType === 'deleteContentForward') {
            // Reset flags if space is deleted
            if (!this.value.trim()) {
                characterEntered = false;
                spaceAllowed = false;
            }
        }
    });
</script>


<?php include_once 'inc/footer.php'; ?>

<?php
unset($_SESSION['errors']);
unset($_SESSION['errors1']);
unset($_SESSION['submitted_values']);
unset($_SESSION['Loginsubmitted_values']);
?>