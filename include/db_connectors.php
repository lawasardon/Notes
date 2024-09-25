<?php
// Dynamic mysqli connection using environment variables
function connectMysqli() {
    $conn = mysqli_connect(
        getenv('DB_HOST'),       // Database host (e.g., localhost or the Coolify server)
        getenv('DB_USERNAME'),   // Database username
        getenv('DB_PASSWORD'),   // Database password
        getenv('DB_DATABASE'),   // Database name
        getenv('DB_PORT') ?: '3306' // Database port, default to 3306 if not set
    );

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

// Dynamic PDO connection using environment variables
function connectPDO() {
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_DATABASE');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $port = getenv('DB_PORT') ?: '3306'; // Default to 3306 if not set

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return null;
}

// Example usage
$mysqli_conn = connectMysqli();
$pdo_conn = connectPDO();
?>
