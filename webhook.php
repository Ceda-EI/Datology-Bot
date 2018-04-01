<?php
// MySQL credentials
$mysql = require('mysql_credentials.php');

// Get JSON from post, store it and decode it.
$var = file_get_contents('php://input');
$json = fopen('json', "w");
fwrite($json, $var);
fclose($json);
$decoded = json_decode($var);

// Store the sender ID
$sender_id = $decoded->{"message"}->{"from"}->{"id"};
$text = strtolower($decoded->{"message"}->{"text"});

$alphabet = array(
  "a" => 0,
  "b" => 0,
  "c" => 0,
  "d" => 0,
  "e" => 0,
  "f" => 0,
  "g" => 0,
  "h" => 0,
  "i" => 0,
  "j" => 0,
  "k" => 0,
  "l" => 0,
  "m" => 0,
  "n" => 0,
  "o" => 0,
  "p" => 0,
  "q" => 0,
  "r" => 0,
  "s" => 0,
  "t" => 0,
  "u" => 0,
  "v" => 0,
  "w" => 0,
  "x" => 0,
  "y" => 0,
  "z" => 0
);
$conn = new mysqli($mysql['servername'], $mysql['username'], $mysql['password'], $mysql['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$query = "SELECT * FROM data WHERE id = $sender_id ;";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  $alphabet = $result->fetch_assoc();
}

$new_alphabet = count_chars($text, 0);

// ASCII range for a-z 97-122
for ($i = 97; $i <= 122 ; $i++) {
  $alphabet[chr($i)] += $new_alphabet[$i];
}

if ($result->num_rows > 0) {
  $query = "DELETE FROM " . $mysql['dbname'] . " WHERE id = $sender_id ;";
  $conn->query($query);
}

$query = "INSERT INTO data values( $sender_id";

foreach ($alphabet as $letter=>$num){
  $query .= "," . $num;
}

$query .= ");";

$conn->query($query);
?>
