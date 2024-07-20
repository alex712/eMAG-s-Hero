<?php

require_once 'Character.php';
require_once 'Skill.php';

class Orderus extends Character {
    public function __construct() {
        $name = "Orderus";
        $health = mt_rand(70, 100);
        $strength = mt_rand(70, 80);
        $defence = mt_rand(45, 55);
        $speed = mt_rand(40, 50);
        $luck = mt_rand(10, 30);
        parent::__construct($name, $health, $strength, $defence, $speed, $luck);
        // Add skills specific to Orderus
        $this->skills[] = new Skill('Rapid Strike', 'attack', 10, function($damage) {
            return $damage * 2;
        });
        $this->skills[] = new Skill('Magic Shield', 'defense', 20, function($damage) {
            return $damage / 2;
        });
    }
}
?>
