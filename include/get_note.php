<?php
// Include your database connection file
include_once 'db_connectors.php';

// Check if the note ID is provided in the request
if (isset($_GET['id'])) {
    // Sanitize the note ID
    $noteId = $_GET['id'];

    try {
        // Connect to the database
        $conn = connectDB();

        // Prepare and execute a query to fetch the note content based on the ID
        $stmt = $conn->prepare("SELECT title, content FROM notes WHERE n_id = ?");
        $stmt->execute([$noteId]);

        // Fetch the result
        $note = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the note exists
        if ($note) {
            // Return the note title and content as JSON
            echo json_encode($note);
        } else {
            // If the note does not exist, return an error message
            echo json_encode(['error' => 'Note not found.']);
        }
    } catch (PDOException $e) {
        // If an error occurs, return an error message
        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
    }
} else {
    // If the note ID is not provided, return an error message
    echo json_encode(['error' => 'Note ID not provided.']);
}
?>
