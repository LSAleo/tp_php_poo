<?php
require_once 'Project.php';
require_once 'Developer.php';
require_once 'DevelopmentTask.php';
require_once 'DesignTask.php';
require_once 'TaskAlreadyCompletedException.php';

echo "=== SYSTÈME DE GESTION DE PROJETS - AGENCE WEB ===\n\n";

echo "--- Création des développeurs ---\n";
$dev1 = new Developer(1, "Alice Martin", ["PHP", "Symfony", "JavaScript", "MySQL"]);
$dev2 = new Developer(2, "Bob Durand", ["JavaScript", "React", "Node.js", "UX"]);

echo "Développeur 1 : " . $dev1->getName() . " - Compétences : " . implode(", ", $dev1->getSkills()) . "\n";
echo "Développeur 2 : " . $dev2->getName() . " - Compétences : " . implode(", ", $dev2->getSkills()) . "\n\n";

echo "--- Création des projets ---\n";
$project1 = new Project(
    1, 
    "Site E-commerce", 
    "TechCorp", 
    new DateTime('2025-06-01')
);

$project2 = new Project(
    2, 
    "Application Mobile", 
    "StartupXYZ", 
    new DateTime('2025-06-15')
);

echo "Projet 1 : " . $project1->getName() . " pour " . $project1->getClientName() . "\n";
echo "Projet 2 : " . $project2->getName() . " pour " . $project2->getClientName() . "\n\n";

echo "--- Création des tâches ---\n";

$task1 = new DevelopmentTask(1, "Développement du backend API", 25.0);
$task2 = new DevelopmentTask(2, "Intégration du système de paiement", 15.0);
$task3 = new DesignTask(3, "Maquette de l'interface utilisateur", "Figma");
$task4 = new DesignTask(4, "Design du logo", "Photoshop");

$task5 = new DevelopmentTask(5, "Développement de l'app mobile", 40.0);
$task6 = new DevelopmentTask(6, "API REST pour mobile", 20.0);
$task7 = new DesignTask(7, "Design UX/UI mobile", "Sketch");

echo "Tâches créées :\n";
echo "- " . $task1->getTitle() . " (" . $task1->getEstimatedHours() . "h)\n";
echo "- " . $task2->getTitle() . " (" . $task2->getEstimatedHours() . "h)\n";
echo "- " . $task3->getTitle() . " (Outil: " . $task3->getToolUsed() . ")\n";
echo "- " . $task4->getTitle() . " (Outil: " . $task4->getToolUsed() . ")\n";
echo "- " . $task5->getTitle() . " (" . $task5->getEstimatedHours() . "h)\n";
echo "- " . $task6->getTitle() . " (" . $task6->getEstimatedHours() . "h)\n";
echo "- " . $task7->getTitle() . " (Outil: " . $task7->getToolUsed() . ")\n\n";

echo "--- Attribution des tâches aux projets ---\n";
$project1->addTask($task1);
$project1->addTask($task2);
$project1->addTask($task3);
$project1->addTask($task4);

$project2->addTask($task5);
$project2->addTask($task6);
$project2->addTask($task7);

echo "Projet 1 (" . $project1->getName() . ") : " . count($project1->getTasks()) . " tâches\n";
echo "Projet 2 (" . $project2->getName() . ") : " . count($project2->getTasks()) . " tâches\n\n";

echo "--- Assignation des tâches aux développeurs ---\n";
$dev1->assignTask($task1);
$dev1->assignTask($task2);
$dev1->assignTask($task6);

$dev2->assignTask($task3);
$dev2->assignTask($task5);
$dev2->assignTask($task7);

$task4->setAssignedTo($dev2);

echo "Assignations :\n";
foreach ($dev1->getAssignedTasks() as $task) {
    echo "- " . $dev1->getName() . " : " . $task->getTitle() . "\n";
}
foreach ($dev2->getAssignedTasks() as $task) {
    echo "- " . $dev2->getName() . " : " . $task->getTitle() . "\n";
}
echo "- " . $dev2->getName() . " : " . $task4->getTitle() . " (assigné manuellement)\n\n";

echo "--- Charge de travail des développeurs ---\n";
echo $dev1->getName() . " : " . $dev1->getWorkload() . " tâches en cours\n";
echo $dev2->getName() . " : " . $dev2->getWorkload() . " tâches en cours\n\n";

echo "--- Simulation de l'avancement ---\n";
echo "Progression initiale :\n";
echo "- " . $project1->getName() . " : " . round($project1->getProgress(), 1) . "%\n";
echo "- " . $project2->getName() . " : " . round($project2->getProgress(), 1) . "%\n\n";

echo "Marquage de certaines tâches comme terminées :\n";
try {
    $task3->completeTask();
    echo "✓ " . $task3->getTitle() . " terminée\n";
    
    $task4->completeTask();
    echo "✓ " . $task4->getTitle() . " terminée\n";
    
    $task1->completeTask();
    echo "✓ " . $task1->getTitle() . " terminée\n";
    
    $task7->completeTask();
    echo "✓ " . $task7->getTitle() . " terminée\n";
    
} catch (TaskAlreadyCompletedException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

echo "\nProgression après completion :\n";
echo "- " . $project1->getName() . " : " . round($project1->getProgress(), 1) . "%\n";
echo "- " . $project2->getName() . " : " . round($project2->getProgress(), 1) . "%\n\n";

echo "--- Charge de travail mise à jour ---\n";
echo $dev1->getName() . " : " . $dev1->getWorkload() . " tâches en cours\n";
echo $dev2->getName() . " : " . $dev2->getWorkload() . " tâches en cours\n\n";

echo "--- Test de l'exception ---\n";
try {
    $task3->completeTask();
    echo "ERREUR : L'exception n'a pas été levée !\n";
} catch (TaskAlreadyCompletedException $e) {
    echo "✓ Exception capturée : " . $e->getMessage() . "\n";
}
echo "\n";

echo "--- Calcul des coûts de développement ---\n";
echo "Coûts par tâche de développement :\n";
foreach ([$task1, $task2, $task5, $task6] as $devTask) {
    if ($devTask instanceof Billable) {
        echo "- " . $devTask->getTitle() . " : " . $devTask->calculateCost() . "€ (" . $devTask->getEstimatedHours() . "h × 50€)\n";
    }
}

echo "\nCoût total par projet :\n";
echo "- " . $project1->getName() . " : " . $project1->getTotalDevelopmentCost() . "€\n";
echo "- " . $project2->getName() . " : " . $project2->getTotalDevelopmentCost() . "€\n";

$totalAgencyCost = $project1->getTotalDevelopmentCost() + $project2->getTotalDevelopmentCost();
echo "- Coût total agence : " . $totalAgencyCost . "€\n\n";

echo "--- Résumé final ---\n";
echo "Nombre de projets : 2\n";
echo "Nombre de développeurs : 2\n";
echo "Nombre total de tâches : " . (count($project1->getTasks()) + count($project2->getTasks())) . "\n";
echo "Tâches terminées : " . array_sum([
    $task1->isCompleted() ? 1 : 0,
    $task2->isCompleted() ? 1 : 0,
    $task3->isCompleted() ? 1 : 0,
    $task4->isCompleted() ? 1 : 0,
    $task5->isCompleted() ? 1 : 0,
    $task6->isCompleted() ? 1 : 0,
    $task7->isCompleted() ? 1 : 0
]) . "\n";

echo "Chiffre d'affaires prévisionnel : " . $totalAgencyCost . "€\n";

echo "\n=== SIMULATION TERMINÉE ===\n";