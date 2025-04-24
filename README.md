# Simple PHP Restaurant Table Booking API

This is a very basic PHP API for managing restaurant table bookings. It uses in-memory data storage, meaning all bookings will be lost when the server stops.

## Files

- `index.php`: Entry point and basic router.
- `src/Controllers/BookingController.php`: Handles booking logic (list, create).
- `src/Controllers/TableController.php`: Handles table logic (list predefined tables).
- `plan.md`: Development plan (this file you are reading is the final README).
- `README.md`: This file.

## Requirements

- PHP (tested with PHP 8.x)

## How to Run

1.  Navigate to the project directory in your terminal.
2.  Start the PHP built-in web server:
    ```bash
    php -S localhost:8000
    ```
3.  The API will be available at `http://localhost:8000`.

## API Endpoints

### Tables

- **`GET /tables`**
  - **Description:** Retrieves a list of available restaurant tables.
  - **Response:**
    ```json
    [
        {"id": "T1", "capacity": 2, "location": "window"},
        {"id": "T2", "capacity": 4, "location": "center"}
        // ... other tables
    ]
    ```

### Bookings

- **`GET /bookings`**
  - **Description:** Retrieves a list of all current bookings.
  - **Response:**
    ```json
    [
        {
            "id": "66a2e4f0a1b2c",
            "table_id": "T2",
            "customer_name": "John Doe",
            "booking_time": "2024-07-25 19:00:00",
            "created_at": "2024-07-25 14:30:00"
        }
        // ... other bookings
    ]
    ```

- **`POST /bookings`**
  - **Description:** Creates a new booking.
  - **Request Body:**
    ```json
    {
        "table_id": "T1",
        "customer_name": "Jane Smith",
        "booking_time": "2024-07-26 20:00:00"
    }
    ```
  - **Success Response (201 Created):**
    ```json
    {
        "id": "66a2e5a0b3d4e",
        "table_id": "T1",
        "customer_name": "Jane Smith",
        "booking_time": "2024-07-26 20:00:00",
        "created_at": "2024-07-25 14:35:00"
    }
    ```
  - **Error Response (400 Bad Request):** If required fields are missing.
    ```json
    {
        "error": "Missing required fields: table_id, customer_name, booking_time"
    }
    ```

## Example Usage (using curl)

```bash
# List tables
curl http://localhost:8000/tables

# Create a booking
curl -X POST http://localhost:8000/bookings -H "Content-Type: application/json" -d '{"table_id":"T3", "customer_name":"Alice", "booking_time":"2024-08-01 18:30:00"}'

# List bookings (including the new one)
curl http://localhost:8000/bookings
``` 