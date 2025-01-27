<?php
include('config/db.php');

if (isset($_POST['eventId'])) {
    $eventId = $_POST['eventId'];

    // Fetch attendees for the selected event
    $sql = "SELECT bookingId, name, phone, email, gender, guestNo, payment, status FROM booking WHERE eventId=:eventId";
    $query = $pdo->prepare($sql);
    $query->bindParam(':eventId', $eventId, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0) {
        // Define the filename
        $filename = "attendees_event_$eventId.csv";

        // Set headers for file download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        // Open PHP output stream
        $output = fopen('php://output', 'w');

        // Write column headers
        fputcsv($output, array('Booking ID', 'Name', 'Phone', 'Email', 'Gender', 'No of Guests', 'Payment', 'Status'));

        // Write rows
        foreach ($results as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    } else {
        echo "No attendees found for this event.";
    }
}
?>
