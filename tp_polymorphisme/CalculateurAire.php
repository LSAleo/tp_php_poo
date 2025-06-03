<?php
class CalculateurAire {
    public function calculerAireTotale($formes) {
        $aireTotal = 0;
        
        foreach ($formes as $forme) {
            $aire = $forme->calculerAire();
            echo $forme . " - Aire: " . round($aire, 2) . "\n";
            $aireTotal += $aire;
        }
        
        return $aireTotal;
    }
}