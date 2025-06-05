<?php
require_once 'Task.php';
require_once 'Billable.php';

class DevelopmentTask extends Task implements Billable {
    private float $estimatedHours;
    private const HOURLY_RATE = 50.0;
    
    public function __construct(int $id, string $title, float $estimatedHours) {
        parent::__construct($id, $title);
        $this->estimatedHours = $estimatedHours;
    }
    
    public function calculateCost(): float {
        return $this->estimatedHours * self::HOURLY_RATE;
    }
    
    public function getEstimatedHours(): float {
        return $this->estimatedHours;
    }
    
    public function setEstimatedHours(float $hours): void {
        $this->estimatedHours = $hours;
    }
}