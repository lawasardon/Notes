<?php
include_once 'db_connectors.php'; // Update this path as needed

// Check if note ID is provided
if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Note ID not provided']);
    exit();
}

// Get the note ID from the request
$note_id = $_GET['id'];
try {
    $conn = connectDB();

    // Retrieve the note from the archives table
    $stmt = $conn->prepare("SELECT * FROM archives WHERE n_id = ?");
    $stmt->execute([$note_id]);
    $note = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$note) {
        echo json_encode(['error' => 'Note not found']);
        exit();
    }

    // Delete the note from the archives table
    $stmt = $conn->prepare("DELETE FROM archives WHERE n_id = ?");
    $stmt->execute([$note_id]);

    // Respond with success message
    echo json_encode(['success' => 'Note deleted successfully']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error deleting note: ' . $e->getMessage()]);
}
?>
