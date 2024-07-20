<?php

class Character {
    public $health;
    public $strength;
    public $defence;
    public $speed;
    public $luck;
    public $skills = [];
    public $name;

    public function __construct($name, $health, $strength, $defence, $speed, $luck) {
        $this->name = $name;
        $this->health = (int)$health;
        $this->strength = (int)$strength;
        $this->defence = (int)$defence;
        $this->speed = (int)$speed;
        $this->luck = (int)$luck;
    }

    // Check if the character gets lucky in this turn
    public function isLucky() {
        return mt_rand(1, 100) <= $this->luck;
    }

    // Apply skills based on the type ('attack' or 'defense')
    public function applySkills($type) {
        foreach ($this->skills as $skill) {
            if ($skill->type == $type && mt_rand(1, 100) <= $skill->chance) {
                return $skill;
            }
        }
        return null;
    }
}
?>
