<?php
$dbname = 'postgres'; 
$user = 'postgres'; 
$password = 'mas786mas'; 
$host = 'localhost'; 
$port = '5432'; 

// Connect to the PostGIS database
$conn = pg_connect("dbname=$dbname user=$user password=$password host=$host port=$port");
// Check if the connection was successful
if (!$conn) {
    echo "An error occurred.\n";
    exit;
} else {
    // Fetch the location points from the database
    $result = pg_query($conn, "SELECT ST_X(geom) AS lng, ST_Y(geom) AS lat FROM location_data.points");
    // Check if the query was successful
    if (!$result) {
        echo "Data Fetch error\n";
        exit;
    } else {
        // Create an array to store the location points
        $locationPoints = array();
        // Loop through the rows returned by the query
        while ($row = pg_fetch_assoc($result)) {
            // Add the location point to the array
            $locationPoints[] = $row;
        }
        // Return the array as JSON
        echo json_encode($locationPoints);
    }

    // Close the database connection
}
pg_close($conn);
