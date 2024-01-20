<?php
include '../../../../connection.php';
include '../../../../check.php';
include('backend.php');

// Handle search query
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // Fetch items from the database based on the search query
    $query = "SELECT * FROM  leads WHERE company LIKE '%$search%'";
    $result = mysqli_query($conn, $query);

    // Display search results
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<p>' . $row['company'] . '</p>';
    }

    // Close the database connection
    mysqli_close($conn);
    exit();
}
?>

