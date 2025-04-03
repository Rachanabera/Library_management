<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<h2>📜 Registered Users</h2>";
echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Roll Number</th><th>Year</th><th>Division</th><th>Branch</th><th>Phone</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['roll_number']}</td>
              <td>{$row['year']}</td><td>{$row['division']}</td><td>{$row['branch']}</td><td>{$row['phone_number']}</td></tr>";
    }
} else {
    echo "<tr><td colspan='7'>No users found</td></tr>";
}

echo "</table>";

$conn->close();
?>
