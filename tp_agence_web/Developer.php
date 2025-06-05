<?php
class Developer {
    private int $id;
    private string $name;
    private array $skills;
    private array $assignedTasks;
    
    public function __construct(int $id, string $name, array $skills = []) {
        $this->id = $id;
        $this->name = $name;
        $this->skills = $skills;
        $this->assignedTasks = [];
    }
    
    public function assignTask(Task $task): void {
        $this->assignedTasks[] = $task;
        $task->setAssignedTo($this);
    }
    
    public function getWorkload(): int {
        $activeTasks = 0;
        foreach ($this->assignedTasks as $task) {
            if (!$task->isCompleted()) {
                $activeTasks++;
            }
        }
        return $activeTasks;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getSkills(): array {
        return $this->skills;
    }
    
    public function getAssignedTasks(): array {
        return $this->assignedTasks;
    }
    
    public function addSkill(string $skill): void {
        if (!in_array($skill, $this->skills)) {
            $this->skills[] = $skill;
        }
    }
}