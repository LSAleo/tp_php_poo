<?php
class TacheVue {
    public function afficherTaches($taches) {
        echo '<div class="taches-container">';
        
        if (empty($taches)) {
            echo '<div class="aucune-tache">
                    <p>Aucune tâche pour le moment. Ajoutez votre première tâche !</p>
                  </div>';
        } else {
            echo '<ul class="liste-taches">';
            foreach ($taches as $tache) {
                $classeComplete = $tache['completee'] ? 'tache-completee' : '';
                echo '<li class="tache-item ' . $classeComplete . '">';
                echo '<div class="tache-contenu">';
                echo '<h3>' . htmlspecialchars($tache['nom']) . '</h3>';
                echo '<p>' . htmlspecialchars($tache['description']) . '</p>';
                echo '<small>Créée le : ' . $tache['date_creation'] . '</small>';
                echo '</div>';
                echo '<div class="tache-actions">';
                
                $texteBouton = $tache['completee'] ? 'Marquer incomplète' : 'Marquer complète';
                echo '<a href="?action=toggle&id=' . $tache['id'] . '" class="btn btn-toggle">' . $texteBouton . '</a>';
                echo '<a href="?action=modifier&id=' . $tache['id'] . '" class="btn btn-modifier">Modifier</a>';
                echo '<a href="?action=supprimer&id=' . $tache['id'] . '" class="btn btn-supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette tâche ?\')">Supprimer</a>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
        }
        
        echo '</div>';
    }
    
    public function afficherFormulaireAjout() {
        echo '<div class="formulaire-container">
                <h2>Ajouter une nouvelle tâche</h2>
                <form method="POST" action="?action=ajouter" class="formulaire-tache">
                    <div class="champ">
                        <label for="nom">Nom de la tâche :</label>
                        <input type="text" id="nom" name="nom" required maxlength="100">
                    </div>
                    <div class="champ">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" rows="3" maxlength="255"></textarea>
                    </div>
                    <button type="submit" class="btn btn-ajouter">Ajouter la tâche</button>
                </form>
              </div>';
    }
    
    public function afficherFormulaireModification($tache) {
        echo '<div class="formulaire-container">
                <h2>Modifier la tâche</h2>
                <form method="POST" action="?action=modifier&id=' . $tache['id'] . '" class="formulaire-tache">
                    <div class="champ">
                        <label for="nom">Nom de la tâche :</label>
                        <input type="text" id="nom" name="nom" value="' . htmlspecialchars($tache['nom']) . '" required maxlength="100">
                    </div>
                    <div class="champ">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" rows="3" maxlength="255">' . htmlspecialchars($tache['description']) . '</textarea>
                    </div>
                    <button type="submit" class="btn btn-modifier">Modifier la tâche</button>
                    <a href="?" class="btn btn-annuler">Annuler</a>
                </form>
              </div>';
    }
    
    public function afficherMessage($message, $type = 'success') {
        echo '<div class="message ' . $type . '">' . htmlspecialchars($message) . '</div>';
    }
}