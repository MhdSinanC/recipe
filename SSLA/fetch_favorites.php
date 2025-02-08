<?php
// Include the database connection
include("../config/db_con.php");

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Start the session and get the logged-in user ID
    session_start();
    if (!isset($_SESSION['user_id'])) {
        die('User not logged in.');
    }

    $user_id = $_SESSION['user_id'];

    // SQL query to fetch favorites
    $query = "
        SELECT 
            f.id AS favorite_id,
            CASE 
                WHEN f.art_id IS NOT NULL THEN ai.title
                WHEN f.cuisine_id IS NOT NULL THEN c.name
                WHEN f.cultural_id IS NOT NULL THEN cu.name
            END AS title,
            CASE 
                WHEN f.art_id IS NOT NULL THEN ai.image
                WHEN f.cuisine_id IS NOT NULL THEN c.image
                WHEN f.cultural_id IS NOT NULL THEN cu.image
            END AS image_url,
            CASE 
                WHEN f.art_id IS NOT NULL THEN 'Art'
                WHEN f.cuisine_id IS NOT NULL THEN 'Cuisine'
                WHEN f.cultural_id IS NOT NULL THEN 'Cultural'
            END AS category
        FROM 
            favorites f
        LEFT JOIN art_items ai ON f.art_id = ai.id
        LEFT JOIN cuisine c ON f.cuisine_id = c.cuisine_id
        LEFT JOIN cultural cu ON f.cultural_id = cu.cultural_id
        WHERE 
            f.user_id = :user_id;
    ";

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all results
    $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the favorites
    if ($favorites) {
        echo "<h1>Your Favorites</h1>";
        echo "<ul>";
        foreach ($favorites as $favorite) {
            $image_url = "http://192.168.1.39/recipe/uploads/" . htmlspecialchars($favorite['image_url']);
            $title = htmlspecialchars($favorite['title']);
            $category = htmlspecialchars($favorite['category']);

            echo "<li>";
            echo "<img src='$image_url' alt='$title' style='width:100px;height:100px;'>";
            echo "<strong>$title</strong> ($category)";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No favorites found.</p>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>