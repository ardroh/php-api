<?php

require __DIR__ . '/src/Controllers/BookingController.php';
require __DIR__ . '/src/Controllers/TableController.php';

use App\Controllers\BookingController;
use App\Controllers\TableController;

// Basic Router
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

$bookingController = new BookingController();
$tableController = new TableController();

header("Access-Control-Allow-Origin: *"); // Allow requests from any origin (for simple testing)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle CORS preflight requests
if ($requestMethod === 'OPTIONS') {
    http_response_code(204); // No Content
    exit;
}

switch ($requestUri) {
    case '/tables':
        if ($requestMethod === 'GET') {
            $tableController->listTables();
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['error' => 'Method Not Allowed']);
        }
        break;

    case '/bookings':
        if ($requestMethod === 'GET') {
            $bookingController->listBookings();
        } elseif ($requestMethod === 'POST') {
            $bookingController->createBooking();
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['error' => 'Method Not Allowed']);
        }
        break;

    default:
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Endpoint not found']);
        break;
} 