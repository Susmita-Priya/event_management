<?php
include('includes/auth.php');
check_login();

// Validate and process the request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eventId'])) {
    $eventId = intval($_POST['eventId']); 
    try {
        $sql = "SELECT availability, payment FROM event WHERE id = :eventId";
        $query = $pdo->prepare($sql);
        $query->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $query->execute();
        $event = $query->fetch(PDO::FETCH_OBJ);

        if ($event) {
            echo json_encode([
                'availability' => (int)$event->availability,
                'payment' => (float)$event->payment,
            ]);
        } else {
            echo json_encode(['error' => 'Event not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error fetching event details: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

?>
