<?php
session_start();

include_once 'db_connectors.php';

if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in";
    exit();
}

if (isset($_POST['noteId']) && isset($_POST['isChecked'])) {
    $noteId = $_POST['noteId'];
    $isChecked = $_POST['isChecked'];
    
    try {
        $conn = connectDB();
        $stmt = $conn->prepare("UPDATE notes SET is_favorite = ? WHERE n_id = ?");
        $stmt->execute([$isChecked, $noteId]);
        // You can perform additional actions or return a response if needed
        echo "Favorite status updated successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
