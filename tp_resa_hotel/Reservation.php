<?php
require_once 'Billable.php';
require_once 'Room.php';
require_once 'Customer.php';

class Reservation implements Billable {
    private int $id;
    private Room $room;
    private Customer $customer;
    private DateTime $startDate;
    private DateTime $endDate;
    private string $status;
    
    public function __construct(int $id, Room $room, Customer $customer, DateTime $startDate, DateTime $endDate) {
        $this->id = $id;
        $this->room = $room;
        $this->customer = $customer;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = 'pending';
    }
    
    public function calculateAmount(): float {
        return $this->getDurationInNights() * $this->room->getPricePerNight();
    }
    
    public function cancel(): void {
        $this->status = 'canceled';
    }
    
    public function getDurationInNights(): int {
        $diff = $this->startDate->diff($this->endDate);
        return $diff->days;
    }
    
    public function confirm(): void {
        $this->status = 'confirmed';
    }
    
    public function complete(): void {
        $this->status = 'completed';
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getRoom(): Room {
        return $this->room;
    }
    
    public function getCustomer(): Customer {
        return $this->customer;
    }
    
    public function getStartDate(): DateTime {
        return $this->startDate;
    }
    
    public function getEndDate(): DateTime {
        return $this->endDate;
    }
    
    public function getStatus(): string {
        return $this->status;
    }
}