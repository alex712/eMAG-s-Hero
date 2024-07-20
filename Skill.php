<?php

class Skill {
    public $name;
    public $type; // 'attack' or 'defense'
    public $chance;
    public $effect;

    public function __construct($name, $type, $chance, $effect) {
        $this->name = $name;
        $this->type = $type;
        $this->chance = $chance;
        $this->effect = $effect;
    }

    // Apply the effect of the skill
    public function apply($damage) {
        return call_user_func($this->effect, $damage);
    }
}
?>
