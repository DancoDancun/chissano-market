<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

$dataFile = __DIR__ . '/data.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if ($data) {
        $existing = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];
        $merged = array_merge($existing, $data);
        $merged['lastUpdated'] = date('Y-m-d H:i:s');
        
        file_put_contents($dataFile, json_encode($merged, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'message' => 'Data saved']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
} else {
    // GET - return data
    if (file_exists($dataFile)) {
        echo file_get_contents($dataFile);
    } else {
        echo json_encode(['animals' => [], 'orders' => [], 'settings' => []]);
    }
}
?>
