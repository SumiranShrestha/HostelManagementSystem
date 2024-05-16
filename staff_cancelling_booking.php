<?php
include 'db.php';

// Start or resume a session to access $_SESSION superglobal
session_start();

// Check if the booking_id is set and not empty
if (isset($_POST['booking_id']) && !empty($_POST['booking_id'])) {
    // Retrieve booking_id from the form
    $bookingId = $_POST['booking_id'];

    // Prepare the SQL statement to delete the specific booking based on the booking_id
    $sqlBooking = "DELETE FROM booking WHERE id = ?";
    $stmtBooking = $conn->prepare($sqlBooking);

    // Bind parameters
    $stmtBooking->bind_param("i", $bookingId);

    // Execute the statement
    $success = $stmtBooking->execute();

    // Close the statement
    $stmtBooking->close();

    // Check if the deletion was successful
    if ($success) {
        // Redirect back to staff dashboard with success message
        header("Location: staff_dashboard.php?success=1");
        exit();
    } else {
        // Redirect back to staff dashboard with error message
        header("Location: staff_dashboard.php?error=1");
        exit();
    }
} else {
    // Redirect back to staff dashboard if booking_id is not set
    header("Location: staff_dashboard.php");
    exit();
}
?>