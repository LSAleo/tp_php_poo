<?php
require_once 'ReservationConflictException.php';

class Room {
    private int $id;
    private string $number;
    private string $type;
    private float $pricePerNight;
    private array $reservations;
    
    public function __construct(int $id, string $number, string $type, float $pricePerNight) {
        $this->id = $id;
        $this->number = $number;
        $this->type = $type;
        $this->pricePerNight = $pricePerNight;
        $this->reservations = [];
    }
    
    public function isAvailable(DateTime $start, DateTime $end): bool {
        foreach ($this->reservations as $reservation) {
            if ($reservation->getStatus() === 'canceled') {
                continue;
            }
            
            $reservationStart = $reservation->getStartDate();
            $reservationEnd = $reservation->getEndDate();
            
            if (($start < $reservationEnd) && ($end > $reservationStart)) {
                return false;
            }
        }
        return true;
    }
    
    public function addReservation($reservation) {
        if (!$this->isAvailable($reservation->getStartDate(), $reservation->getEndDate())) {
            throw new ReservationConflictException(
                "La chambre " . $this->number . " n'est pas disponible du " . 
                $reservation->getStartDate()->format('Y-m-d') . " au " . 
                $reservation->getEndDate()->format('Y-m-d')
            );
        }
        $this->reservations[] = $reservation;
    }
    
    public function getReservations(): array {
        return $this->reservations;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getNumber(): string {
        return $this->number;
    }
    
    public function getType(): string {
        return $this->type;
    }
    
    public function getPricePerNight(): float {
        return $this->pricePerNight;
    }
}