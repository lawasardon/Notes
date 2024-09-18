<?php
session_start(); // Start the session
include 'db_connectors.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define an array to hold validation errors
    $errors = array();

    // Validate name
    if (empty($_POST['name1'])) {
        $errors['name1'] = "Name is required.";
    } else {
        // Remove spaces from the input name
        $nameWithoutSpaces = str_replace(' ', '', $_POST['name1']);
        
        // Validate the length of the name (excluding spaces)
        $nameLength = strlen($nameWithoutSpaces);
        if ($nameLength < 3 || $nameLength > 10) {
            $errors['name1'] = "Name must be 3 to 10 characters long.";
        } else {
            // If validation passes, store the name with HTML special characters escaped
            $name = htmlspecialchars($_POST['name1']);
        }
    }
    

    if (empty($_POST['email1'])) {
        $errors['email1'] = "Email is required.";
    } else {
        $email = filter_var($_POST['email1'], FILTER_SANITIZE_EMAIL);
        $emailParts = explode('@', $email);
        // Check if the email has two parts (username and domain)
        if (count($emailParts) != 2) {
            $errors['email1'] = "Invalid email.";
        } else {
            list($username, $domain) = $emailParts;
            // Check if the domain is "gmail.com"
            if ($domain !== 'gmail.com') {
                $errors['email1'] = "Email domain must be 'gmail.com'.";
            }
            else {
                // Check if the email is already registered in the database
                $conn = connectDB();

                $sql = "SELECT * FROM users WHERE email = ?";

                try {
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $email);
                    $stmt->execute();

                    // If the email exists in the database, set an error
                    if ($stmt->rowCount() > 0) {
                        $errors['email1'] = "Email is already registered.";
                    }

                    // Close the database connection
                    $conn = null;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

                // If validation passes, store the email with HTML special characters escaped
                $email = htmlspecialchars($_POST['email1']);
            }
        }
      
    }
    
    
    if (empty($_POST['password1'])) {
        $errors['password1'] = "Password is required.";
    } else {
        $password = $_POST['password1'];
        if (strlen($password) < 5 || strlen($password) > 10) {
            $errors['password1'] = "Password must be 5 to 10 characters long.";
        } elseif (!preg_match('/^(?=.*[A-Z]{1})(?=.*[a-z])(?=.*\d).{5,10}$/', $password)) {
            $errors['password1'] = "Password must start with one uppercase letter, followed by a lowercase letter, and then a number.";
        } else {
            // If validation passes, store the password with HTML special characters escaped
            $password = htmlspecialchars($password);
        }
    }
    
    

    
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
     $_SESSION['submitted_values'] = $_POST;
    header("Location: ../index.php");
    exit();
}
else {
        // No validation errors, proceed with database insertion
        $name = htmlspecialchars($_POST['name1']);
        $email = filter_var($_POST['email1'], FILTER_SANITIZE_EMAIL);
        $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);

        $conn = connectDB();

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $password);
            $stmt->execute();

            // Redirect to a success page
            echo '<script>alert("Registration successful");</script>';

            // Redirect to a success page
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}


?>
