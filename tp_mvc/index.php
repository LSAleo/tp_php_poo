<?php
require_once 'TacheController.php';
require_once 'TacheVue.php';

$controller = new TacheController();
$vue = new TacheVue();

$action = isset($_GET['action']) ? $_GET['action'] : '';
$message = '';
$messageType = 'success';

switch ($action) {
    case 'ajouter':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom']);
            $description = trim($_POST['description']);
            
            if (!empty($nom)) {
                $controller->ajouterTache($nom, $description);
                $message = 'Tâche ajoutée avec succès !';
            } else {
                $message = 'Le nom de la tâche est obligatoire.';
                $messageType = 'error';
            }
        }
        break;
        
    case 'supprimer':
        if (isset($_GET['id'])) {
            if ($controller->supprimerTache($_GET['id'])) {
                $message = 'Tâche supprimée avec succès !';
            } else {
                $message = 'Erreur lors de la suppression.';
                $messageType = 'error';
            }
        }
        break;
        
    case 'toggle':
        if (isset($_GET['id'])) {
            if ($controller->marquerComplete($_GET['id'])) {
                $message = 'Statut de la tâche modifié !';
            } else {
                $message = 'Erreur lors de la modification.';
                $messageType = 'error';
            }
        }
        break;
        
    case 'modifier':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $nom = trim($_POST['nom']);
            $description = trim($_POST['description']);
            
            if (!empty($nom)) {
                if ($controller->modifierTache($_GET['id'], $nom, $description)) {
                    $message = 'Tâche modifiée avec succès !';
                    header('Location: ?');
                    exit;
                } else {
                    $message = 'Erreur lors de la modification.';
                    $messageType = 'error';
                }
            } else {
                $message = 'Le nom de la tâche est obligatoire.';
                $messageType = 'error';
            }
        }
        break;
}

$taches = $controller->getTaches();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - MVC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
            color: #333;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .formulaire-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .formulaire-tache {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .champ {
            display: flex;
            flex-direction: column;
        }
        
        label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #555;
        }
        
        input, textarea {
            padding: 0.75rem;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s;
            display: inline-block;
            text-align: center;
        }
        
        .btn-ajouter {
            background: #4CAF50;
            color: white;
        }
        
        .btn-ajouter:hover {
            background: #45a049;
        }
        
        .btn-modifier {
            background: #2196F3;
            color: white;
        }
        
        .btn-modifier:hover {
            background: #1976D2;
        }
        
        .btn-supprimer {
            background: #f44336;
            color: white;
        }
        
        .btn-supprimer:hover {
            background: #d32f2f;
        }
        
        .btn-toggle {
            background: #FF9800;
            color: white;
        }
        
        .btn-toggle:hover {
            background: #F57C00;
        }
        
        .btn-annuler {
            background: #9E9E9E;
            color: white;
        }
        
        .btn-annuler:hover {
            background: #757575;
        }
        
        .taches-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .liste-taches {
            list-style: none;
        }
        
        .tache-item {
            border: 2px solid #eee;
            margin-bottom: 1rem;
            padding: 1.5rem;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .tache-item:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        .tache-completee {
            background-color: #f1f8e9;
            border-color: #4CAF50;
        }
        
        .tache-completee .tache-contenu h3 {
            text-decoration: line-through;
            color: #888;
        }
        
        .tache-contenu {
            flex: 1;
        }
        
        .tache-contenu h3 {
            margin-bottom: 0.5rem;
            color: #333;
        }
        
        .tache-contenu p {
            color: #666;
            margin-bottom: 0.5rem;
        }
        
        .tache-contenu small {
            color: #999;
        }
        
        .tache-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .tache-actions .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .aucune-tache {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 2rem;
        }
        
        .message {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🗂️ Gestionnaire de Tâches</h1>
            <p>Application MVC en PHP</p>
        </header>
        
        <?php if (!empty($message)): ?>
            <?php $vue->afficherMessage($message, $messageType); ?>
        <?php endif; ?>
        
        <?php if ($action === 'modifier' && isset($_GET['id'])): ?>
            <?php 
            $tacheModifier = $controller->getTache($_GET['id']);
            if ($tacheModifier): 
                $vue->afficherFormulaireModification($tacheModifier);
            else:
                echo '<div class="message error">Tâche non trouvée.</div>';
            endif;
            ?>
        <?php else: ?>
            <?php $vue->afficherFormulaireAjout(); ?>
        <?php endif; ?>
        
        <h2 style="margin: 2rem 0 1rem 0; color: #333;">📋 Liste des tâches (<?php echo count($taches); ?>)</h2>
        <?php $vue->afficherTaches($taches); ?>
    </div>
</body>
</html>