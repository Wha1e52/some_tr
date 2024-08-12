<?php
namespace oop\classes;

use oop\traits\TColor;

class Dog extends Animal {

    use TColor;
    public $breed;

    public function __construct($name, $old, $breed) {
        parent::__construct($name, $old);
        $this->breed = $breed;
    }

    public function doSmth() {
        echo 'гав';
    }
}