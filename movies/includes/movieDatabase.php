<?php
include __DIR__ . '/../../loadenv.php';

$servername = getenv('DATABASE_HOST');
$username = getenv('DATABASE_USER');
$password = getenv('DATABASE_PASSWORD');
$dbname = getenv('DATABASE_NAME') ?: 'media';


$conn = mysqli_connect($servername, $username, $password,$dbname );
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

