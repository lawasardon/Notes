<?php
session_start();

include_once 'db_connectors.php';

if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in";
    exit(); 
}

$title = $_POST['noteTitle'];
$content = $_POST['noteContent'];
$user_id = $_SESSION['user_id']; 

$errors = array();

// Validate note title
// Validate note title
// Validate note title
if (empty($title) || trim($title) === '') {
    $errors['noteTitle'] = "Add title.";
} else {
    // Check if the first character is a space
    if ($title[0] === ' ') {
        $errors['noteTitle'] = "Title must not start with a space.";
    }
    // Check if the first character is an uppercase letter
    else if (!ctype_upper($title[0])) {
        $errors['noteTitle'] = "Title must start with an uppercase letter.";
    } else {
        // Check if the title already exists in the database
        try {
            $conn = connectDB();
            $stmt = $conn->prepare("SELECT COUNT(*) FROM notes WHERE title = ?");
            $stmt->execute([$title]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $errors['noteTitle'] = "Title already exists.";
            } else {
                $title = htmlspecialchars($_POST['noteTitle']);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}





// Validate note content
if (empty($content) || trim($content) === '') {
    $errors['noteContent'] = "Add Content.";
}else{
    $content = htmlspecialchars($_POST['noteContent']);

}

if (!empty($errors)) {
    $_SESSION['note_insert_errors'] = $errors;
    $_SESSION['Notesubmitted_values'] = $_POST;
  
    header("Location: ../note.php");
    exit();
}

try {
    $conn = connectDB();

    $stmt = $conn->prepare("INSERT INTO notes (title, content, u_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $user_id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['note_insert_message'] = "Note inserted successfully";
        header("Location: ../note.php?shownoteModal=true&view=allNotes");
    } else {
        $_SESSION['note_insert_message'] = "Failed to insert note";
        header("Location: ../note.php");
    }

    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
