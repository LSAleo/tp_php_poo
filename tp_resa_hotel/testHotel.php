<?php
require_once 'Hotel.php';
require_once 'Room.php';
require_once 'Customer.php';
require_once 'Reservation.php';
require_once 'ReservationConflictException.php';

$hotel = new Hotel();

echo "=== SYSTÈME DE RÉSERVATION HÔTEL ===\n\n";

echo "--- Création des chambres ---\n";
$room1 = new Room(1, "101", "simple", 80.0);
$room2 = new Room(2, "102", "simple", 80.0);
$room3 = new Room(3, "201", "double", 120.0);
$room4 = new Room(4, "202", "double", 120.0);
$room5 = new Room(5, "301", "suite", 250.0);

$hotel->addRoom($room1);
$hotel->addRoom($room2);
$hotel->addRoom($room3);
$hotel->addRoom($room4);
$hotel->addRoom($room5);

echo "5 chambres créées avec succès :\n";
foreach ($hotel->getRooms() as $room) {
    echo "- Chambre " . $room->getNumber() . " (" . $room->getType() . ") - " . $room->getPricePerNight() . "€/nuit\n";
}
echo "\n";

echo "--- Création des clients ---\n";
$customer1 = new Customer(1, "Jean Dupont", "jean.dupont@email.com");
$customer2 = new Customer(2, "Marie Martin", "marie.martin@email.com");
$customer3 = new Customer(3, "Pierre Durand", "pierre.durand@email.com");

$hotel->addCustomer($customer1);
$hotel->addCustomer($customer2);
$hotel->addCustomer($customer3);

echo "3 clients créés avec succès :\n";
foreach ($hotel->getCustomers() as $customer) {
    echo "- " . $customer->getName() . " (" . $customer->getEmail() . ")\n";
}
echo "\n";

echo "--- Création de réservations valides ---\n";
try {
    $reservation1 = $hotel->createReservation(
        $room1, 
        $customer1, 
        new DateTime('2025-06-10'), 
        new DateTime('2025-06-15')
    );
    $reservation1->confirm();
    echo "Réservation 1 : " . $customer1->getName() . " - Chambre " . $room1->getNumber() . " du 10/06 au 15/06 (5 nuits) - " . $reservation1->calculateAmount() . "€\n";
    
    $reservation2 = $hotel->createReservation(
        $room3, 
        $customer2, 
        new DateTime('2025-06-12'), 
        new DateTime('2025-06-18')
    );
    $reservation2->confirm();
    echo "Réservation 2 : " . $customer2->getName() . " - Chambre " . $room3->getNumber() . " du 12/06 au 18/06 (6 nuits) - " . $reservation2->calculateAmount() . "€\n";
    
    $reservation3 = $hotel->createReservation(
        $room5, 
        $customer3, 
        new DateTime('2025-06-20'), 
        new DateTime('2025-06-25')
    );
    $reservation3->confirm();
    echo "Réservation 3 : " . $customer3->getName() . " - Chambre " . $room5->getNumber() . " du 20/06 au 25/06 (5 nuits) - " . $reservation3->calculateAmount() . "€\n";
    
} catch (ReservationConflictException $e) {
    echo "Erreur inattendue : " . $e->getMessage() . "\n";
}
echo "\n";

echo "--- Test de conflit de réservation ---\n";
try {
    $conflictReservation = $hotel->createReservation(
        $room1, 
        $customer2, 
        new DateTime('2025-06-12'), 
        new DateTime('2025-06-16')
    );
    echo "ERREUR : La réservation en conflit n'a pas été détectée !\n";
} catch (ReservationConflictException $e) {
    echo "✓ Conflit détecté avec succès : " . $e->getMessage() . "\n";
}
echo "\n";

echo "--- Historique des réservations par client ---\n";
foreach ($hotel->getCustomers() as $customer) {
    echo "Client : " . $customer->getName() . "\n";
    $reservations = $customer->getReservationHistory();
    if (empty($reservations)) {
        echo "  Aucune réservation\n";
    } else {
        foreach ($reservations as $reservation) {
            echo "  - Chambre " . $reservation->getRoom()->getNumber() . 
                 " du " . $reservation->getStartDate()->format('d/m/Y') . 
                 " au " . $reservation->getEndDate()->format('d/m/Y') . 
                 " (" . $reservation->getDurationInNights() . " nuits) - " . 
                 $reservation->calculateAmount() . "€ - Statut: " . $reservation->getStatus() . "\n";
        }
    }
    echo "\n";
}

echo "--- Chiffre d'affaires total de l'hôtel ---\n";
$totalRevenue = $hotel->calculateTotalRevenue();
echo "Chiffre d'affaires total : " . $totalRevenue . "€\n";

$currentMonth = new DateTime('2025-06-01');
$monthlyRevenue = $hotel->calculateTotalRevenue($currentMonth);
echo "Chiffre d'affaires pour juin 2025 : " . $monthlyRevenue . "€\n\n";

echo "--- Chambres disponibles du 14/06 au 19/06 ---\n";
$availableRooms = $hotel->getAvailableRooms(
    new DateTime('2025-06-14'), 
    new DateTime('2025-06-19')
);

if (empty($availableRooms)) {
    echo "Aucune chambre disponible sur cette période.\n";
} else {
    echo "Chambres disponibles :\n";
    foreach ($availableRooms as $room) {
        echo "- Chambre " . $room->getNumber() . " (" . $room->getType() . ") - " . $room->getPricePerNight() . "€/nuit\n";
    }
}
echo "\n";

echo "--- Test d'annulation de réservation ---\n";
echo "Annulation de la réservation de " . $customer1->getName() . "\n";
$reservation1->cancel();
echo "Statut de la réservation : " . $reservation1->getStatus() . "\n";

echo "\nChambres disponibles du 10/06 au 15/06 après annulation :\n";
$availableAfterCancel = $hotel->getAvailableRooms(
    new DateTime('2025-06-10'), 
    new DateTime('2025-06-15')
);

foreach ($availableAfterCancel as $room) {
    echo "- Chambre " . $room->getNumber() . " (" . $room->getType() . ") - " . $room->getPricePerNight() . "€/nuit\n";
}

echo "\n=== SIMULATION TERMINÉE ===\n";