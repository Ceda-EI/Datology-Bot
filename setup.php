<?php
// MySQL credentials
$mysql = require('mysql_credentials.php');

$conn = new mysqli($mysql["servername"], $mysql["username"], $mysql["password"], $mysql["database"]);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$query = "create table data(
  id int(10) primary key,
  a int(8) default 0,
  b int(8) default 0,
  c int(8) default 0,
  d int(8) default 0,
  e int(8) default 0,
  f int(8) default 0,
  g int(8) default 0,
  h int(8) default 0,
  i int(8) default 0,
  j int(8) default 0,
  k int(8) default 0,
  l int(8) default 0,
  m int(8) default 0,
  n int(8) default 0,
  o int(8) default 0,
  p int(8) default 0,
  q int(8) default 0,
  r int(8) default 0,
  s int(8) default 0,
  t int(8) default 0,
  u int(8) default 0,
  v int(8) default 0,
  w int(8) default 0,
  x int(8) default 0,
  y int(8) default 0,
  z int(8) default 0
);";
if ($conn->query($query) === true) {
  echo "Succesfully created table";
}
else {
  echo "Error creating tables";
}
$conn->close();
?>
