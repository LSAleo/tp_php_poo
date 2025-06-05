<?php
require_once 'TaskAlreadyCompletedException.php';

abstract class Task {
    protected int $id;
    protected string $title;
    protected $assignedTo;
    protected bool $isCompleted;
    
    public function __construct(int $id, string $title) {
        $this->id = $id;
        $this->title = $title;
        $this->assignedTo = null;
        $this->isCompleted = false;
    }
    
    public function completeTask(): void {
        if ($this->isCompleted) {
            throw new TaskAlreadyCompletedException("La tâche '" . $this->title . "' est déjà terminée");
        }
        $this->isCompleted = true;
    }
    
    public function isCompleted(): bool {
        return $this->isCompleted;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getTitle(): string {
        return $this->title;
    }
    
    public function getAssignedTo() {
        return $this->assignedTo;
    }
    
    public function setAssignedTo($developer): void {
        $this->assignedTo = $developer;
    }
}