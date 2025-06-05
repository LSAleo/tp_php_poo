<?php
interface Billable {
    public function calculateCost(): float;
}