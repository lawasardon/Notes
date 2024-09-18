<?php
session_start();
include 'db_connectors.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to hold validation errors
    $errors = [];

    // Validate email
    if (empty($_POST['email'])) {
        $errors['email'] = "Email is required.";
    }else{
        $email = htmlspecialchars($_POST['email']);

    }
    

    // Validate password
    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required.";
    }else{
        $password = htmlspecialchars($_POST['password']);

    }
    

    // If there are validation errors, redirect back to the login page with error messages
    if (!empty($errors)) {
        $_SESSION['errors1'] = $errors;
        $_SESSION['Loginsubmitted_values'] = $_POST;
        header("Location: ../index.php");
        exit();
    }

    // If no validation errors, proceed with login
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $conn = connectDB();

    $sql = "SELECT u_id, name, password, photo FROM users WHERE email = ?";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed_password = $user['password'];
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user['u_id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_photo'] = $user['photo']; // Add user's photo to session
                header("Location: ../note.php");
                exit();
              
            } else {
                $_SESSION['errors1']['password'] = "Wrong password.";
                $_SESSION['Loginsubmitted_values']['email'] = $email; // Store submitted email
                $_SESSION['Loginsubmitted_values']['password'] = $password; 
                header("Location: ../index.php");
                exit();
            }
           
        } else {
            $_SESSION['errors1']['email'] = "Email not found.";
            $_SESSION['Loginsubmitted_values']['email'] = $email; // Store submitted email
            $_SESSION['Loginsubmitted_values']['password'] = $password; 
            header("Location: ../index.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
