<?php
require_once 'Task.php';

class Project {
    private int $id;
    private string $name;
    private string $clientName;
    private DateTime $startDate;
    private ?DateTime $endDate;
    private array $tasks;
    
    public function __construct(int $id, string $name, string $clientName, DateTime $startDate, ?DateTime $endDate = null) {
        $this->id = $id;
        $this->name = $name;
        $this->clientName = $clientName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->tasks = [];
    }
    
    public function addTask(Task $task): void {
        $this->tasks[] = $task;
    }
    
    public function getProgress(): float {
        if (empty($this->tasks)) {
            return 0.0;
        }
        
        $completedTasks = 0;
        foreach ($this->tasks as $task) {
            if ($task->isCompleted()) {
                $completedTasks++;
            }
        }
        
        return ($completedTasks / count($this->tasks)) * 100;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getClientName(): string {
        return $this->clientName;
    }
    
    public function getStartDate(): DateTime {
        return $this->startDate;
    }
    
    public function getEndDate(): ?DateTime {
        return $this->endDate;
    }
    
    public function setEndDate(DateTime $endDate): void {
        $this->endDate = $endDate;
    }
    
    public function getTasks(): array {
        return $this->tasks;
    }
    
    public function getTotalDevelopmentCost(): float {
        $totalCost = 0;
        foreach ($this->tasks as $task) {
            if ($task instanceof Billable) {
                $totalCost += $task->calculateCost();
            }
        }
        return $totalCost;
    }
}