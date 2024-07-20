<?php

require_once 'Character.php';

class Beast extends Character {
    public function __construct() {
        $name = "Beast";
        $health = mt_rand(60, 90);
        $strength = mt_rand(60, 90);
        $defence = mt_rand(40, 60);
        $speed = mt_rand(40, 60);
        $luck = mt_rand(25, 40);
        parent::__construct($name, $health, $strength, $defence, $speed, $luck);
    }
}
?>
