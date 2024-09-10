<?php
include_once("../connect/session_check.php");

function jsonResponse($status, $message, $additionalData = [])
{
    header('Content-Type: application/json');
    echo json_encode(array_merge([
        'status' => $status,
        'message' => $message
    ], $additionalData));
    exit;
}

function get_term_description($target)
{
    switch ($target) {
        case "0":
            return "Hourly";
        case "1":
            return "Daily";
        case "2":
            return "Weekly";
        case "3":
            return "Monthly";
        default:
            return "Unknown Rate";
    }
}

function format_booking_date($date_string)
{
    $date = new DateTime($date_string);
    return $date->format('F j, Y');
}

function format_booking_time($time_string)
{
    $time = new DateTime($time_string);
    return $time->format('g:i A'); // Formats time in 12-hour format with AM/PM
}

function get_payment_method_description($methodId)
{
    switch ($methodId) {
        case "0":
            return "Online";
        case "1":
            return "On-site";
        default:
            return "Unknown Method";
    }
}

function fetchAllBookings($conn, $criteria = 'fullname', $direction = 'asc')
{
    // Whitelist allowed sorting fields to prevent SQL injection
    $allowedFields = ['reference_number', 'fullname', 'email', 'term_rate', 'booking_date', 'status', 'payment_method'];
    $allowedDirections = ['asc', 'desc'];

    // Validate criteria and direction
    if (!in_array($criteria, $allowedFields)) {
        $criteria = 'fullname';
    }
    if (!in_array($direction, $allowedDirections)) {
        $direction = 'asc';
    }

    // Build the ORDER BY clause safely using the validated input
    $orderByClause = $criteria . ' ' . $direction;

    // Prepare the query (use parameters where necessary)
    $query = "SELECT 
                    reference_number,
                    CONCAT(firstname, ' ', lastname) AS fullname,
                    email,
                    term_rate,
                    booking_date,
                    status,
                    payment_method,
                    bookingid
                FROM bookings
                ORDER BY $orderByClause";

    // Execute the query and handle the results
    $result = $conn->query($query);
    $bookings = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['term_rate'] = get_term_description($row['term_rate']);
            $row['booking_date'] = format_booking_date($row['booking_date']);
            $row['payment_method'] = get_payment_method_description($row['payment_method']);
            $bookings[] = $row;
        }
    }

    // Retrieve the total record count for display purposes
    $totalRecords = $conn->query("SELECT COUNT(*) as total FROM bookings")->fetch_assoc()['total'];

    // Return the data as JSON
    jsonResponse(true, "Bookings fetched successfully.", ['bookings' => $bookings, 'totalRecords' => $totalRecords]);
}

function fetchAllEvents($conn)
{
    $query = "SELECT category, event_title, event_start_date, event_end_date, start_time, end_time, event_desc FROM events";
    $result = $conn->query($query);
    $events = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Events fetched successfully.',
        'events' => $events
    ]);
}

function fetchLatestApprovedBookings($conn)
{
    $query = "SELECT reference_number, CONCAT(firstname, ' ', lastname) AS fullname, term_rate, pax
              FROM bookings
              WHERE status = 'approved'
              ORDER BY booking_date DESC
              LIMIT 10";  // Fetch only the 10 latest approved bookings

    $result = $conn->query($query);
    $bookings = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['term_rate'] = get_term_description($row['term_rate']);  // Convert term rate to descriptive text
            $bookings[] = $row;
        }
        jsonResponse(true, "Latest approved bookings fetched successfully.", ['bookings' => $bookings]);
    } else {
        jsonResponse(false, "No approved bookings found.");
    }
}

function updateBookingDetails($conn, $bookingid)
{
    $stmt = $conn->prepare("UPDATE bookings SET status = 'Approved' WHERE bookingid = ? AND status = 'Pending'");
    $stmt->bind_param("i", $bookingid);
    if ($stmt->execute()) {
        jsonResponse(true, "Booking updated successfully.");
    } else {
        jsonResponse(false, "Failed to update booking details.");
    }
}

function viewModal($conn, $bookingId)
{
    if (!$bookingId) {
        jsonResponse(false, "Booking ID is required.");
        return;
    }

    $query = "SELECT
                reference_number,
                CONCAT(firstname, ' ', lastname) AS fullname,
                email,
                number,
                term_rate,
                booking_date,
                status,
                payment_method,
                bookingid,
                start_time,
                end_time,
                pax,
                voucher
            FROM bookings
            WHERE bookingid = ?";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        jsonResponse(false, "SQL error: " . $conn->error);
        return;
    }

    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bookingDetails = $result->fetch_assoc();
        $bookingDetails['term_rate'] = get_term_description($bookingDetails['term_rate']);
        $bookingDetails['booking_date'] = format_booking_date($bookingDetails['booking_date']);
        $bookingDetails['payment_method'] = get_payment_method_description($bookingDetails['payment_method']);
        $bookingDetails['start_time'] = format_booking_time($bookingDetails['start_time']);
        $bookingDetails['end_time'] = format_booking_time($bookingDetails['end_time']);

        jsonResponse(true, "Booking details fetched successfully.", $bookingDetails);
    } else {
        jsonResponse(false, "No booking found with the specified ID.");
    }

    $stmt->close();
}

// Handling POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST['action']) {
        case 'fetchAllBookings':
            $page = $_POST['page'] ?? 1;
            $criteria = $_POST['criteria'] ?? 'fullname';
            $direction = $_POST['direction'] ?? 'asc';
            fetchAllBookings($conn, $page, $criteria);
            break;
        case 'fetchAllEvents':
            fetchAllEvents($conn);
            break;
        case 'fetchLatestApprovedBookings':
            fetchLatestApprovedBookings($conn);
            break;
        case 'updateBookingDetails':
            $bookingid = $_POST['bookingId'] ?? null;
            if ($bookingid) {
                updateBookingDetails($conn, $bookingid);
            } else {
                jsonResponse(false, "Missing data for booking update.");
            }
            break;
        case 'viewModal':
            $bookingId = $_POST['bookingId'] ?? null;
            if ($bookingId) {
                viewModal($conn, $bookingId);
            } else {
                jsonResponse(false, "Booking ID is required.");
            }
            break;
        default:
            jsonResponse(false, "Invalid action.");
            break;
    }
}
?>