<?php

namespace App\Controllers;

class TableController {
    private static $tables = [
        ['id' => 'T1', 'capacity' => 2, 'location' => 'window'],
        ['id' => 'T2', 'capacity' => 4, 'location' => 'center'],
        ['id' => 'T3', 'capacity' => 4, 'location' => 'center'],
        ['id' => 'T4', 'capacity' => 6, 'location' => 'booth'],
        ['id' => 'T5', 'capacity' => 2, 'location' => 'patio'],
    ];

    public function listTables() {
        header('Content-Type: application/json');
        echo json_encode(self::$tables);
    }
} 