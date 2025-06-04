<?php
require_once 'Room.php';
require_once 'Customer.php';
require_once 'Reservation.php';

class Hotel {
    private array $rooms;
    private array $customers;
    private array $reservations;
    private int $nextReservationId;
    
    public function __construct() {
        $this->rooms = [];
        $this->customers = [];
        $this->reservations = [];
        $this->nextReservationId = 1;
    }
    
    public function addRoom(Room $room): void {
        $this->rooms[] = $room;
    }
    
    public function addCustomer(Customer $customer): void {
        $this->customers[] = $customer;
    }
    
    public function createReservation(Room $room, Customer $customer, DateTime $startDate, DateTime $endDate): Reservation {
        $reservation = new Reservation($this->nextReservationId++, $room, $customer, $startDate, $endDate);
        
        $room->addReservation($reservation);
        $customer->addReservation($reservation);
        $this->reservations[] = $reservation;
        
        return $reservation;
    }
    
    public function getAvailableRooms(DateTime $start, DateTime $end): array {
        $availableRooms = [];
        foreach ($this->rooms as $room) {
            if ($room->isAvailable($start, $end)) {
                $availableRooms[] = $room;
            }
        }
        return $availableRooms;
    }
    
    public function calculateTotalRevenue(?DateTime $month = null): float {
        $totalRevenue = 0;
        
        foreach ($this->reservations as $reservation) {
            if ($reservation->getStatus() === 'canceled') {
                continue;
            }
            
            if ($month === null || $this->isReservationInMonth($reservation, $month)) {
                $totalRevenue += $reservation->calculateAmount();
            }
        }
        
        return $totalRevenue;
    }
    
    private function isReservationInMonth(Reservation $reservation, DateTime $month): bool {
        $reservationMonth = $reservation->getStartDate()->format('Y-m');
        $targetMonth = $month->format('Y-m');
        return $reservationMonth === $targetMonth;
    }
    
    public function getRooms(): array {
        return $this->rooms;
    }
    
    public function getCustomers(): array {
        return $this->customers;
    }
    
    public function getReservations(): array {
        return $this->reservations;
    }
}