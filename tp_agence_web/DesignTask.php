<?php
require_once 'Task.php';

class DesignTask extends Task {
    private string $toolUsed;
    
    public function __construct(int $id, string $title, string $toolUsed) {
        parent::__construct($id, $title);
        $this->toolUsed = $toolUsed;
    }
    
    public function getToolUsed(): string {
        return $this->toolUsed;
    }
    
    public function setToolUsed(string $tool): void {
        $this->toolUsed = $tool;
    }
}