<?php
class Customer {
    private int $id;
    private string $name;
    private string $email;
    private array $reservations;
    
    public function __construct(int $id, string $name, string $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->reservations = [];
    }
    
    public function addReservation($reservation) {
        $this->reservations[] = $reservation;
    }
    
    public function getReservationHistory(): array {
        return $this->reservations;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getEmail(): string {
        return $this->email;
    }
}