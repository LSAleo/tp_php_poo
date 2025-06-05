<?php
class ChienView {
    public function afficherDetail(Chien $chien, int $index): void {
        $this->afficherEnTete();
        
        echo '<div class="container mt-4">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-8">';
        
        echo '<div class="mb-3">';
        echo '<a href="?" class="btn btn-secondary">← Retour à la liste</a>';
        echo '</div>';
        
        echo '<div class="card">';
        echo '<div class="card-header bg-primary text-white">';
        echo '<h2>🐕 ' . htmlspecialchars($chien->getNom()) . '</h2>';
        echo '</div>';
        echo '<div class="card-body">';
        
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<h4>Informations générales</h4>';
        echo '<table class="table table-borderless">';
        echo '<tr><td><strong>Nom:</strong></td><td>' . htmlspecialchars($chien->getNom()) . '</td></tr>';
        echo '<tr><td><strong>Âge:</strong></td><td>' . $chien->getAge() . ' ans</td></tr>';
        echo '<tr><td><strong>Âge humain:</strong></td><td>' . $chien->calculerAgeHumain() . ' ans</td></tr>';
        echo '<tr><td><strong>Race:</strong></td><td>' . htmlspecialchars($chien->getRace()) . '</td></tr>';
        echo '<tr><td><strong>Couleur:</strong></td><td>' . htmlspecialchars($chien->getCouleur()) . '</td></tr>';
        echo '<tr><td><strong>Sexe:</strong></td><td>' . htmlspecialchars($chien->getSexe()) . '</td></tr>';
        echo '<tr><td><strong>Poids:</strong></td><td>' . $chien->getPoids() . ' kg</td></tr>';
        echo '</table>';
        echo '</div>';
        
        echo '<div class="col-md-6">';
        echo '<h4>Caractéristiques</h4>';
        
        if ($chien instanceof ChienDeChasse) {
            echo '<div class="alert alert-info">';
            echo '<h5>🎯 Chien de chasse</h5>';
            echo '<p><strong>Spécialité:</strong> ' . htmlspecialchars($chien->getSpecialite()) . '</p>';
            echo '</div>';
        }
        
        if ($chien->estEnSurpoids()) {
            echo '<div class="alert alert-warning">';
            echo '<h5>⚠️ Attention</h5>';
            echo '<p>Ce chien est en surpoids (plus de 20 kg)</p>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-success">';
            echo '<h5>✅ Poids normal</h5>';
            echo '<p>Le poids de ce chien est dans la normale</p>';
            echo '</div>';
        }
        
        echo '<div class="card">';
        echo '<div class="card-body text-center">';
        echo '<h5>🔊 Écouter son cri</h5>';
        echo '<p class="lead">"' . $chien->crier() . '"</p>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';
        
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<div class="btn-group w-100">';
        echo '<a href="?action=modifier&index=' . $index . '" class="btn btn-primary">✏️ Modifier</a>';
        echo '<a href="?action=supprimer&index=' . $index . '" class="btn btn-danger" 
              onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ' . htmlspecialchars($chien->getNom()) . ' ?\')">🗑️ Supprimer</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        $this->afficherPiedDePage();
    }
    
    public function afficherFormulaireAjout(): void {
        $this->afficherEnTete();
        $this->afficherFormulaire();
        $this->afficherPiedDePage();
    }
    
    public function afficherFormulaireModification(Chien $chien, int $index): void {
        $this->afficherEnTete();
        $this->afficherFormulaire($chien, $index);
        $this->afficherPiedDePage();
    }
    
    private function afficherFormulaire(?Chien $chien = null, ?int $index = null): void {
        $titre = $chien ? 'Modifier' : 'Ajouter';
        $action = $chien ? "?action=modifier&index=$index" : "?action=ajouter";
        
        echo '<div class="container mt-4">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-8">';
        
        echo '<div class="mb-3">';
        echo '<a href="?" class="btn btn-secondary">← Retour à la liste</a>';
        echo '</div>';
        
        echo '<div class="card">';
        echo '<div class="card-header bg-primary text-white">';
        echo '<h2>🐕 ' . $titre . ' un chien</h2>';
        echo '</div>';
        echo '<div class="card-body">';
        
        echo '<form method="POST" action="' . $action . '">';
        
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        
        echo '<div class="mb-3">';
        echo '<label for="nom" class="form-label">Nom *</label>';
        echo '<input type="text" class="form-control" id="nom" name="nom" required 
              value="' . ($chien ? htmlspecialchars($chien->getNom()) : '') . '">';
        echo '</div>';
        
        echo '<div class="mb-3">';
        echo '<label for="age" class="form-label">Âge (années) *</label>';
        echo '<input type="number" class="form-control" id="age" name="age" required min="0" max="20"
              value="' . ($chien ? $chien->getAge() : '') . '">';
        echo '</div>';
        
        echo '<div class="mb-3">';
        echo '<label for="race" class="form-label">Race *</label>';
        echo '<input type="text" class="form-control" id="race" name="race" required
              value="' . ($chien ? htmlspecialchars($chien->getRace()) : '') . '">';
        echo '</div>';
        
        echo '<div class="mb-3">';
        echo '<label for="couleur" class="form-label">Couleur *</label>';
        echo '<input type="text" class="form-control" id="couleur" name="couleur" required
              value="' . ($chien ? htmlspecialchars($chien->getCouleur()) : '') . '">';
        echo '</div>';
        
        echo '</div>';
        echo '<div class="col-md-6">';
        
        echo '<div class="mb-3">';
        echo '<label for="sexe" class="form-label">Sexe *</label>';
        echo '<select class="form-select" id="sexe" name="sexe" required>';
        echo '<option value="">Choisir...</option>';
        echo '<option value="Mâle"' . ($chien && $chien->getSexe() === 'Mâle' ? ' selected' : '') . '>Mâle</option>';
        echo '<option value="Femelle"' . ($chien && $chien->getSexe() === 'Femelle' ? ' selected' : '') . '>Femelle</option>';
        echo '</select>';
        echo '</div>';
        
        echo '<div class="mb-3">';
        echo '<label for="poids" class="form-label">Poids (kg) *</label>';
        echo '<input type="number" class="form-control" id="poids" name="poids" required min="0.1" step="0.1"
              value="' . ($chien ? $chien->getPoids() : '') . '">';
        echo '</div>';
        
        if (!$chien) {
            echo '<div class="mb-3">';
            echo '<label for="type" class="form-label">Type de chien *</label>';
            echo '<select class="form-select" id="type" name="type" required onchange="toggleSpecialite()">';
            echo '<option value="">Choisir...</option>';
            echo '<option value="normal">Chien normal</option>';
            echo '<option value="chasse">Chien de chasse</option>';
            echo '</select>';
            echo '</div>';
            
            echo '<div class="mb-3" id="specialite-group" style="display:none;">';
            echo '<label for="specialite" class="form-label">Spécialité de chasse</label>';
            echo '<input type="text" class="form-control" id="specialite" name="specialite"
                  placeholder="Ex: Gibier à plumes, Sanglier...">';
            echo '</div>';
        } else if ($chien instanceof ChienDeChasse) {
            echo '<div class="mb-3">';
            echo '<label for="specialite" class="form-label">Spécialité de chasse</label>';
            echo '<input type="text" class="form-control" id="specialite" name="specialite"
                  value="' . htmlspecialchars($chien->getSpecialite()) . '">';
            echo '</div>';
            
            echo '<div class="alert alert-info">';
            echo '🎯 Ce chien est un chien de chasse';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
        
        echo '<div class="text-center mt-4">';
        echo '<button type="submit" class="btn btn-primary btn-lg me-2">💾 ' . $titre . '</button>';
        echo '<a href="?" class="btn btn-secondary btn-lg">❌ Annuler</a>';
        echo '</div>';
        
        echo '</form>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        if (!$chien) {
            echo '<script>
                function toggleSpecialite() {
                    const type = document.getElementById("type").value;
                    const specialiteGroup = document.getElementById("specialite-group");
                    const specialiteInput = document.getElementById("specialite");
                    
                    if (type === "chasse") {
                        specialiteGroup.style.display = "block";
                        specialiteInput.required = true;
                    } else {
                        specialiteGroup.style.display = "none";
                        specialiteInput.required = false;
                        specialiteInput.value = "";
                    }
                }
            </script>';
        }
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