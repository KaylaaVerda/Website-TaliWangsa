<?php
$mysqli = new mysqli('localhost','root','','taliwangsa',3306);
if ($mysqli->connect_error) {
    echo "connect error: " . $mysqli->connect_error . "\n";
    exit(1);
}

$res = $mysqli->query("DESCRIBE services");
if (!$res) {
    echo "DESCRIBE error: " . $mysqli->error . "\n";
    exit(1);
}

echo "=== Services columns ===\n";
while ($row = $res->fetch_assoc()) {
    echo $row['Field'] . ' - ' . $row['Type'] . "\n";
}

echo "\n=== Sample rows ===\n";
$res2 = $mysqli->query("SELECT * FROM services LIMIT 3");
if (!$res2) {
    echo "SELECT error: " . $mysqli->error . "\n";
    exit(1);
}
while ($r = $res2->fetch_assoc()) {
    print_r($r);
    echo "\n";
}

$mysqli->close();
