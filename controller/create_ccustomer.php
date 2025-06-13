<?php
// Set response header
header('Content-Type: application/json');

// Allow CORS if needed (uncomment if required)
// header("Access-Control-Allow-Origin: *");

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method.']);
    exit;
}

// Validate required fields
$required = [
    'customer_number', 'customer_name', 'dob', 'mobile_number',
    'aadhar_number', 'city', 'street', 'pincode', 'full_address'
];

print_r($_POST); // Debugging line to see the POST data

// $missing = [];
// foreach ($required as $field) {
//     if (empty($_POST[$field])) {
//         $missing[] = $field;
//     }
// }

// if (!empty($missing)) {
//     http_response_code(400);
//     echo json_encode(['error' => 'Missing fields', 'fields' => $missing]);
//     exit;
// }

// Handle file uploads
// $uploads_dir = __DIR__ . '/../uploads';
// if (!is_dir($uploads_dir)) {
//     mkdir($uploads_dir, 0777, true);
// }

// function save_uploaded_file($fileKey, $uploads_dir) {
//     if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
//         return null;
//     }
//     $tmp_name = $_FILES[$fileKey]['tmp_name'];
//     $name = uniqid() . '_' . basename($_FILES[$fileKey]['name']);
//     $target = $uploads_dir . '/' . $name;
//     if (move_uploaded_file($tmp_name, $target)) {
//         return $name;
//     }
//     return null;
// }

// $customer_photo = save_uploaded_file('customer_photo', $uploads_dir);
// $aadhar_photo = save_uploaded_file('aadhar_photo', $uploads_dir);

// Example: Save to database (pseudo code, replace with actual DB code)
/*
require_once '../db.php';
$stmt = $pdo->prepare("INSERT INTO customers (...) VALUES (...)");
$stmt->execute([...]);
*/

// Prepare response
$response = [
    'status' => 'success',
    'data' => [
        'customer_number' => $_POST['customer_number'],
        'customer_name' => $_POST['customer_name'],
        'dob' => $_POST['dob'],
        'mobile_number' => $_POST['mobile_number'],
        'aadhar_number' => $_POST['aadhar_number'],
        'city' => $_POST['city'],
        'street' => $_POST['street'],
        'pincode' => $_POST['pincode'],
        'full_address' => $_POST['full_address'],
        'customer_photo' => $customer_photo,
        'aadhar_photo' => $aadhar_photo
    ]
];

echo json_encode($response);
?>