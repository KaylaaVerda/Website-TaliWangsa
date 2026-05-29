<?php
require 'vendor/autoload.php';

$db = \Config\Database::connect();

echo "=== Services Table Structure ===\n";
$result = $db->query('DESCRIBE services')->getResultArray();
foreach($result as $row) {
    echo $row['Field'] . ' - ' . $row['Type'] . ' - ' . ($row['Null'] === 'YES' ? 'NULL' : 'NOT NULL') . "\n";
}

echo "\n=== Sample Services Data ===\n";
$services = $db->query('SELECT * FROM services LIMIT 3')->getResultArray();
foreach($services as $service) {
    echo "Service: " . print_r($service, true) . "\n";
}
?>
