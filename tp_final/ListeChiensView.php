<?php
class ListeChiensView {
    public function afficher(array $chiens): void {
        $this->afficherEnTete();
        $this->afficherBarreRecherche();
        $this->afficherMessages();
        $this->afficherBoutonAjouter();
        $this->afficherListeChiens($chiens);
        $this->afficherPiedDePage();
    }
    
    public function afficherResultatsRecherche(array $resultats, string $terme): void {
        $this->afficherEnTete();
        $this->afficherBarreRecherche($terme);
        echo '<div class="alert alert-info">';
        echo '<h3>Résultats de recherche pour "' . htmlspecialchars($terme) . '"</h3>';
        echo '<p>' . count($resultats) . ' chien(s) trouvé(s)</p>';
        echo '<a href="?" class="btn btn-secondary">Retour à la liste complète</a>';
        echo '</div>';
        $this->afficherListeChiens($resultats);
        $this->afficherPiedDePage();
    }
    
    public function afficherPolymorphisme(array $chiens): void {
        $this->afficherEnTete();
        echo '<div class="container mt-4">';
        echo '<h2>🔊 Démonstration du Polymorphisme</h2>';
        echo '<p class="lead">Chaque type de chien a son propre cri :</p>';
        echo '<a href="?" class="btn btn-secondary mb-3">← Retour à la liste</a>';
        
        if (empty($chiens)) {
            echo '<div class="alert alert-warning">Aucun chien dans le chenil pour la démonstration.</div>';
        } else {
            echo '<div class="row">';
            foreach ($chiens as $index => $chien) {
                echo '<div class="col-md-6 mb-3">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($chien->getNom()) . '</h5>';
                echo '<p class="card-text">';
                echo '<strong>Type:</strong> ' . get_class($chien) . '<br>';
                echo '<strong>Race:</strong> ' . htmlspecialchars($chien->getRace()) . '<br>';
                echo '<strong>Cri:</strong> <em>' . $chien->crier() . '</em>';
                echo '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        
        echo '</div>';
        $this->afficherPiedDePage();
    }
    
    private function afficherEnTete(): void {
        echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐕 Gestion du Chenil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dog-card { transition: transform 0.2s; }
        .dog-card:hover { transform: translateY(-2px); }
        .surpoids { border-left: 4px solid #dc3545; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="?">🐕 Chenil Manager</a>
            <div class="navbar-nav flex-row">
                <a class="nav-link me-3" href="?">Liste</a>
                <a class="nav-link me-3" href="?action=ajouter">Ajouter</a>
                <a class="nav-link" href="?action=polymorphisme">Démonstration</a>
            </div>
        </div>
    </nav>';
    }
    
    private function afficherBarreRecherche(string $valeur = ''): void {
        echo '<div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form method="GET" action="" class="d-flex">
                        <input type="hidden" name="action" value="rechercher">
                        <input type="text" name="q" class="form-control me-2" 
                               placeholder="Rechercher un chien par nom..." 
                               value="' . htmlspecialchars($valeur) . '">
                        <button type="submit" class="btn btn-outline-primary">🔍</button>
                    </form>
                </div>
            </div>
        </div>';
    }
    
    private function afficherMessages(): void {
        $message = $_GET['message'] ?? '';
        
        switch ($message) {
            case 'ajoute':
                echo '<div class="container mt-3"><div class="alert alert-success alert-dismissible fade show">
                    ✅ Chien ajouté avec succès !
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div></div>';
                break;
            case 'modifie':
                echo '<div class="container mt-3"><div class="alert alert-success alert-dismissible fade show">
                    ✅ Chien modifié avec succès !
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div></div>';
                break;
            case 'supprime':
                echo '<div class="container mt-3"><div class="alert alert-success alert-dismissible fade show">
                    ✅ Chien supprimé avec succès !
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div></div>';
                break;
            case 'erreur':
                echo '<div class="container mt-3"><div class="alert alert-danger alert-dismissible fade show">
                    ❌ Une erreur est survenue !
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div></div>';
                break;
        }
    }
    
    private function afficherBoutonAjouter(): void {
        echo '<div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>🐕 Liste des Chiens</h1>
                <a href="?action=ajouter" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Ajouter un chien
                </a>
            </div>
        </div>';
    }
    
    private function afficherListeChiens(array $chiens): void {
        echo '<div class="container">';
        
        if (empty($chiens)) {
            echo '<div class="text-center py-5">
                <h3>🐕 Aucun chien dans le chenil</h3>
                <p class="text-muted">Commencez par ajouter votre premier compagnon !</p>
                <a href="?action=ajouter" class="btn btn-primary">Ajouter un chien</a>
            </div>';
        } else {
            echo '<div class="row">';
            foreach ($chiens as $index => $chien) {
                $surpoidsClass = $chien->estEnSurpoids() ? 'surpoids' : '';
                echo '<div class="col-md-6 col-lg-4 mb-4">';
                echo '<div class="card dog-card h-100 ' . $surpoidsClass . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($chien->getNom()) . '</h5>';
                echo '<p class="card-text">';
                echo '<strong>Race:</strong> ' . htmlspecialchars($chien->getRace()) . '<br>';
                echo '<strong>Âge:</strong> ' . $chien->getAge() . ' ans (' . $chien->calculerAgeHumain() . ' ans humains)<br>';
                echo '<strong>Couleur:</strong> ' . htmlspecialchars($chien->getCouleur()) . '<br>';
                echo '<strong>Sexe:</strong> ' . htmlspecialchars($chien->getSexe()) . '<br>';
                echo '<strong>Poids:</strong> ' . $chien->getPoids() . ' kg';
                
                if ($chien->estEnSurpoids()) {
                    echo ' <span class="badge bg-warning">⚠️ Surpoids</span>';
                }
                
                if ($chien instanceof ChienDeChasse) {
                    echo '<br><strong>Spécialité:</strong> ' . htmlspecialchars($chien->getSpecialite());
                    echo '<br><span class="badge bg-info">🎯 Chien de chasse</span>';
                }
                
                echo '</p>';
                echo '</div>';
                echo '<div class="card-footer bg-transparent">';
                echo '<div class="btn-group w-100" role="group">';
                echo '<a href="?action=detail&index=' . $index . '" class="btn btn-outline-primary btn-sm">👁️ Voir</a>';
                echo '<a href="?action=modifier&index=' . $index . '" class="btn btn-outline-secondary btn-sm">✏️ Modifier</a>';
                echo '<a href="?action=supprimer&index=' . $index . '" class="btn btn-outline-danger btn-sm" 
                      onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ' . htmlspecialchars($chien->getNom()) . ' ?\')">🗑️ Supprimer</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            
            echo '<div class="row mt-4">';
            echo '<div class="col-12">';
            echo '<div class="card">';
            echo '<div class="card-body text-center">';
            echo '<h5>📊 Statistiques du Chenil</h5>';
            echo '<p><strong>Nombre total de chiens:</strong> ' . count($chiens) . '</p>';
            
            $chiensEnSurpoids = array_filter($chiens, fn($chien) => $chien->estEnSurpoids());
            echo '<p><strong>Chiens en surpoids:</strong> ' . count($chiensEnSurpoids) . '</p>';
            
            $chiensDeChasse = array_filter($chiens, fn($chien) => $chien instanceof ChienDeChasse);
            echo '<p><strong>Chiens de chasse:</strong> ' . count($chiensDeChasse) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
    }
    
    public function afficherErreur(string $message): void {
        echo '<div class="container mt-4">';
        echo '<div class="alert alert-danger">' . htmlspecialchars($message) . '</div>';
        echo '</div>';
    }
    
    private function afficherPiedDePage(): void {
        echo '<footer class="bg-dark text-light text-center py-3 mt-5">
            <div class="container">
                <p>&copy; 2025 Chenil Manager - Gestion des chiens avec POO & MVC</p>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>';
    }
}