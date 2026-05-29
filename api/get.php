<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$dataFile = __DIR__ . '/data.json';

if (file_exists($dataFile)) {
    readfile($dataFile);
} else {
    echo json_encode([
        'animals' => [],
        'orders' => [],
        'settings' => [],
        'lastUpdated' => date('Y-m-d H:i:s')
    ]);
}
?>
