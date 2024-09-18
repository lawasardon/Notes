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

    // Retrieve the note from the notes table
    $stmt = $conn->prepare("SELECT * FROM notes WHERE n_id = ?");
    $stmt->execute([$note_id]);
    $note = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$note) {
        echo json_encode(['error' => 'Note not found']);
        exit();
    }

    // Insert the note into the archive table
    $stmt = $conn->prepare("INSERT INTO archives (n_id, title, content, is_favorite, time, u_id)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$note['n_id'], $note['title'], $note['content'], $note['is_favorite'], $note['time'], $note['u_id']]);

    // Delete the note from the notes table
    $stmt = $conn->prepare("DELETE FROM notes WHERE n_id = ?");
    $stmt->execute([$note_id]);

    // Respond with success message
    echo json_encode(['success' => 'Note archived successfully']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error archiving note: ' . $e->getMessage()]);
}
?>
