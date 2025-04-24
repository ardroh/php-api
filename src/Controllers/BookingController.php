<?php

namespace App\Controllers;

class BookingController {
    private static $bookings = []; // In-memory storage

    public function listBookings() {
        header('Content-Type: application/json');
        echo json_encode(self::$bookings);
    }

    public function createBooking() {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['table_id']) || !isset($input['customer_name']) || !isset($input['booking_time'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields: table_id, customer_name, booking_time']);
            return;
        }

        $newBooking = [
            'id' => uniqid(),
            'table_id' => $input['table_id'],
            'customer_name' => $input['customer_name'],
            'booking_time' => $input['booking_time'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        self::$bookings[] = $newBooking;

        http_response_code(201);
        header('Content-Type: application/json');
        echo json_encode($newBooking);
    }
} 