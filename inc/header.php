<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Note App</title>
    <link rel="stylesheet" href="css/index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   
 
    
</head>

<body>
<div class="wrapper">
    
    <div class="header">
        <h1>NoteApp</h1>
        <nav>
            <div class="nav_button">
            <button class="btn" id="homeBtn" onclick="hideForm(); resetRegistrationForm(); resetLoginForm();">Home</button>
                <button class="btn" id="loginBtn" onclick="showLoginForm(); resetRegistrationForm();">Log In</button>
                <button class="btn" id="registerBtn" onclick="showRegistrationForm(); resetLoginForm();">Register</button>          
            </div>             
            <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
        </nav>
</div>


   
      
