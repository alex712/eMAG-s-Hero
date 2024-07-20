<?php

require_once 'Orderus.php';
require_once 'Beast.php';

class Battle {
    private $orderus;
    private $beast;
    private $maxTurns = 20;

    public function __construct() {
        $this->orderus = new Orderus();
        $this->beast = new Beast();
    }

    // Start the battle simulation
    public function start() {
        // Determine the first attacker based on speed, and if tied, based on luck
        $attacker = $this->determineFirstAttacker();
        $defender = ($attacker === $this->orderus) ? $this->beast : $this->orderus;

        for ($turn = 1; $turn <= $this->maxTurns; $turn++) {
            echo "Turn $turn:\n";
            if ($defender->isLucky()) {
                echo $defender === $this->orderus ? "Orderus got lucky and evaded the attack!\n" : "Beast got lucky and evaded the attack!\n";
            } else {
                $damage = $this->calculateDamage($attacker, $defender);
                $defender->health -= $damage;
                echo "Damage dealt: $damage\n";
                echo "Defender's remaining health: {$defender->health}\n";
            }

            if ($defender->health <= 0) {
                echo $defender === $this->orderus ? "Orderus is defeated!\n" : "Beast is defeated!\n";
                echo $attacker === $this->orderus ? "Orderus wins!\n" : "Beast wins!\n";
                return;
            }

            // Switch roles for the next turn
            list($attacker, $defender) = array($defender, $attacker);
        }
        echo "Max turns reached! It's a draw!\n";
    }

    // Determine the first attacker based on speed and luck
    private function determineFirstAttacker() {
        if ($this->orderus->speed > $this->beast->speed) {
            return $this->orderus;
        } elseif ($this->orderus->speed < $this->beast->speed) {
            return $this->beast;
        } else {
            return $this->orderus->luck > $this->beast->luck ? $this->orderus : $this->beast;
        }
    }

    // Calculate damage considering skills and attributes
    private function calculateDamage($attacker, $defender) {
        $damage = max(0, $attacker->strength - $defender->defence);
        $attackSkill = $attacker->applySkills('attack');
        $defenseSkill = $defender->applySkills('defense');

        if ($attackSkill) {
            $damage = $attackSkill->apply($damage);
            echo "{$attacker->name}'s {$attackSkill->name} activated! Damage: $damage\n";
        }
        if ($defenseSkill) {
            $damage = $defenseSkill->apply($damage);
            echo "{$defender->name}'s {$defenseSkill->name} activated! Damage reduced to: $damage\n";
        }
        return $damage;
    }
}
?>